<?php
// chatbot_api.php - Handles all chatbot CRUD and chat operations
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

require_once 'db_config.php';

$method = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'] ?? '';

switch ($action) {

    // ─── GET all entries (with optional search) ───────────────────────────────
    case 'get_all':
        $conn = getDBConnection();
        $search = $_GET['search'] ?? '';
        
        if ($search) {
            $stmt = $conn->prepare(
                "SELECT * FROM chatbot_entries 
                 WHERE keyword LIKE ? OR reply LIKE ? 
                 ORDER BY id ASC"
            );
            $like = "%$search%";
            $stmt->bind_param('ss', $like, $like);
        } else {
            $stmt = $conn->prepare("SELECT * FROM chatbot_entries ORDER BY id ASC");
        }
        
        $stmt->execute();
        $result = $stmt->get_result();
        $entries = [];
        
        while ($row = $result->fetch_assoc()) {
            $entries[] = $row;
        }
        
        // Total count (unfiltered)
        $totalResult = $conn->query("SELECT COUNT(*) as total FROM chatbot_entries");
        $total = $totalResult->fetch_assoc()['total'];
        
        echo json_encode([
            'success'  => true,
            'entries'  => $entries,
            'total'    => (int)$total,
            'filtered' => count($entries)
        ]);
        $conn->close();
        break;

    // ─── GET single entry ─────────────────────────────────────────────────────
    case 'get_one':
        $conn = getDBConnection();
        $id = (int)($_GET['id'] ?? 0);
        
        $stmt = $conn->prepare("SELECT * FROM chatbot_entries WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $entry = $result->fetch_assoc();
        
        if ($entry) {
            echo json_encode(['success' => true, 'entry' => $entry]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Entry not found']);
        }
        $conn->close();
        break;

    // ─── CREATE new entry ─────────────────────────────────────────────────────
    case 'create':
        $conn = getDBConnection();
        $data = json_decode(file_get_contents('php://input'), true);
        
        $keyword = trim(strtolower($data['keyword'] ?? ''));
        $reply   = trim($data['reply'] ?? '');
        
        if (!$keyword || !$reply) {
            echo json_encode(['success' => false, 'message' => 'Keyword and reply are required']);
            break;
        }
        
        // Check for duplicate keyword
        $checkStmt = $conn->prepare("SELECT id FROM chatbot_entries WHERE keyword = ?");
        $checkStmt->bind_param('s', $keyword);
        $checkStmt->execute();
        if ($checkStmt->get_result()->num_rows > 0) {
            echo json_encode(['success' => false, 'message' => 'Keyword already exists']);
            break;
        }
        
        $stmt = $conn->prepare("INSERT INTO chatbot_entries (keyword, reply) VALUES (?, ?)");
        $stmt->bind_param('ss', $keyword, $reply);
        
        if ($stmt->execute()) {
            echo json_encode([
                'success' => true,
                'message' => 'Entry created successfully',
                'id'      => $conn->insert_id
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to create entry']);
        }
        $conn->close();
        break;

    // ─── UPDATE entry ─────────────────────────────────────────────────────────
    case 'update':
        $conn = getDBConnection();
        $data = json_decode(file_get_contents('php://input'), true);
        
        $id      = (int)($data['id'] ?? 0);
        $keyword = trim(strtolower($data['keyword'] ?? ''));
        $reply   = trim($data['reply'] ?? '');
        
        if (!$id || !$keyword || !$reply) {
            echo json_encode(['success' => false, 'message' => 'ID, keyword and reply are required']);
            break;
        }
        
        // Check for duplicate keyword on another row
        $checkStmt = $conn->prepare("SELECT id FROM chatbot_entries WHERE keyword = ? AND id != ?");
        $checkStmt->bind_param('si', $keyword, $id);
        $checkStmt->execute();
        if ($checkStmt->get_result()->num_rows > 0) {
            echo json_encode(['success' => false, 'message' => 'Keyword already exists on another entry']);
            break;
        }
        
        $stmt = $conn->prepare("UPDATE chatbot_entries SET keyword = ?, reply = ? WHERE id = ?");
        $stmt->bind_param('ssi', $keyword, $reply, $id);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Entry updated successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update entry']);
        }
        $conn->close();
        break;

    // ─── DELETE entry ─────────────────────────────────────────────────────────
    case 'delete':
        $conn = getDBConnection();
        $data = json_decode(file_get_contents('php://input'), true);
        $id   = (int)($data['id'] ?? 0);
        
        if (!$id) {
            echo json_encode(['success' => false, 'message' => 'ID is required']);
            break;
        }
        
        $stmt = $conn->prepare("DELETE FROM chatbot_entries WHERE id = ?");
        $stmt->bind_param('i', $id);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Entry deleted successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete entry']);
        }
        $conn->close();
        break;

    // ─── CHAT – match user message to a keyword ───────────────────────────────
    case 'chat':
        $conn = getDBConnection();
        $data    = json_decode(file_get_contents('php://input'), true);
        $message = strtolower(trim($data['message'] ?? ''));
        
        if (!$message) {
            echo json_encode(['success' => false, 'message' => 'Message is required']);
            break;
        }
        
        // Exact keyword match first
        $stmt = $conn->prepare("SELECT reply FROM chatbot_entries WHERE ? LIKE CONCAT('%', keyword, '%') ORDER BY LENGTH(keyword) DESC LIMIT 1");
        $stmt->bind_param('s', $message);
        $stmt->execute();
        $result = $stmt->get_result();
        $row    = $result->fetch_assoc();
        
        if ($row) {
            echo json_encode(['success' => true, 'reply' => $row['reply']]);
        } else {
            // Fallback: keyword contains any word from message
            $words    = explode(' ', $message);
            $fallback = null;
            
            foreach ($words as $word) {
                if (strlen($word) < 3) continue;
                $likeWord = "%$word%";
                $stmt2    = $conn->prepare("SELECT reply FROM chatbot_entries WHERE keyword LIKE ? ORDER BY LENGTH(keyword) DESC LIMIT 1");
                $stmt2->bind_param('s', $likeWord);
                $stmt2->execute();
                $res2 = $stmt2->get_result()->fetch_assoc();
                if ($res2) { $fallback = $res2['reply']; break; }
            }
            
            if ($fallback) {
                echo json_encode(['success' => true, 'reply' => $fallback]);
            } else {
                echo json_encode([
                    'success' => true,
                    'reply'   => "I'm not sure how to help with that yet! Try asking about our guitars, pricing, shipping, warranty, or store hours. You can also reach us at info@guithub.com."
                ]);
            }
        }
        $conn->close();
        break;

    // ─── DB STATUS ────────────────────────────────────────────────────────────
    case 'status':
        $conn = getDBConnection();
        echo json_encode(['success' => true, 'status' => 'Connected']);
        $conn->close();
        break;

    default:
        echo json_encode(['success' => false, 'message' => 'Invalid action']);
}
?>
