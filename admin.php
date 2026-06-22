<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GuitHub - Admin</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="chatbot.css">
    <link rel="stylesheet" href="admin.css">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="nav-logo">
            <img src="img/logo.png" alt="Guitar Icon" class="logo">
            <a href="#">Guit<span style="color: #FF6B00;">Hub.</span></a>
        </div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="products.php">Products</a></li>
            <li><a href="about.php">About</a></li>
        </ul>
        <a href="" class="admin-btn" id="admin-active">
            <img src="img/settings.svg" alt="Settings icon" class="admin-icon">
            Admin
        </a>
        <!-- Hamburger injected by script.js -->
    </nav>

    <div class="admin-page">

        <div class="admin-header">
            <h1>Chatbot Admin Panel</h1>
            <p>Manage your chatbot knowledge base with full CRUD operations</p>
        </div>

        <!-- Stats -->
        <div class="stats-row">
            <div class="stat-card">
                <p>Total Entries</p>
                <div class="stat-value orange" id="totalCount">—</div>
            </div>
            <div class="stat-card">
                <p>Filtered Results</p>
                <div class="stat-value blue" id="filteredCount">—</div>
            </div>
            <div class="stat-card">
                <p>Database Status</p>
                <div class="stat-value green" id="dbStatus">Checking...</div>
            </div>
        </div>

        <!-- Toolbar -->
        <div class="toolbar">
            <div class="search-wrap">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <input type="text" id="searchInput" placeholder="Search keywords or replies...">
            </div>
            <button class="add-btn" onclick="openAddModal()">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                </svg>
                Add New Entry
            </button>
        </div>

        <!-- Table -->
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th style="width:70px">ID</th>
                        <th style="width:200px">Keyword</th>
                        <th>Reply</th>
                        <th style="width:110px;text-align:right">Actions</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <tr><td colspan="4"><div class="empty-state"><p>Loading entries...</p></div></td></tr>
                </tbody>
            </table>
        </div>

    </div>

    <!-- Add / Edit Modal -->
    <div class="modal-overlay" id="entryModal">
        <div class="modal">
            <h2 id="modalTitle">Add New Entry</h2>
            <input type="hidden" id="entryId">

            <div class="form-group">
                <label>Keyword</label>
                <input type="text" id="entryKeyword" placeholder="e.g. hello, shipping, electric">
                <small>Lowercase, no special characters. The chatbot matches user messages against this keyword.</small>
            </div>

            <div class="form-group">
                <label>Reply</label>
                <textarea id="entryReply" placeholder="What should the chatbot say when this keyword is matched?"></textarea>
            </div>

            <div class="modal-actions">
                <button class="cancel-btn" onclick="closeModal()">Cancel</button>
                <button class="save-btn"   onclick="saveEntry()">Save Entry</button>
            </div>
        </div>
    </div>

    <!-- Delete Confirm Modal -->
    <div class="modal-overlay" id="deleteModal">
        <div class="del-modal">
            <div class="del-icon">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2">
                    <polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/>
                    <path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4h6v2"/>
                </svg>
            </div>
            <h2>Delete Entry?</h2>
            <p>This keyword and its reply will be permanently removed from the chatbot. This action cannot be undone.</p>
            <div style="display:flex;gap:14px;justify-content:center">
                <button class="cancel-btn"     onclick="closeDeleteModal()">Cancel</button>
                <button class="del-confirm-btn" onclick="confirmDelete()">Yes, Delete</button>
            </div>
        </div>
    </div>

    <!-- Toast -->
    <div class="toast" id="toast"></div>

    <!-- Chat Widget -->
    <?php include 'chatbot_widget.php'; ?>

    <!-- Unified JS (hamburger + product filter + admin) -->
    <script src="script.js" defer></script>

</body>
</html>
