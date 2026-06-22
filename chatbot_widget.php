<!-- chatbot_widget.php — Include this in any page to add the chat widget -->
<div id="chatWidget">

    <!-- Floating Button -->
    <button id="chatToggle" onclick="toggleChat()" aria-label="Open chat">
        <svg id="chatIcon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
        </svg>
        <svg id="closeIcon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="display:none">
            <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
        </svg>
        <span>Chat with us</span>
    </button>

    <!-- Chat Window -->
    <div id="chatWindow" style="display:none">
        <div class="chat-header">
            <div class="chat-header-info">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                </svg>
                <span>GuitHub Support</span>
            </div>
            <button onclick="toggleChat()" class="chat-close-btn" aria-label="Close chat">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>

        <div class="chat-messages" id="chatMessages">
            <!-- Messages are injected here -->
        </div>

        <div class="chat-input-wrap">
            <input type="text" id="chatInput" placeholder="Type your message..." onkeydown="handleChatKey(event)">
            <button onclick="sendMessage()" class="chat-send-btn" aria-label="Send">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <line x1="22" y1="2" x2="11" y2="13"/>
                    <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                </svg>
            </button>
        </div>
    </div>

</div>

<script>
    let chatOpen = false;

    // ── Open/close ────────────────────────────────────────
    function toggleChat() {
        chatOpen = !chatOpen;
        const win       = document.getElementById('chatWindow');
        const chatIcon  = document.getElementById('chatIcon');
        const closeIcon = document.getElementById('closeIcon');

        if (chatOpen) {
            win.style.display = 'flex';
            chatIcon.style.display  = 'none';
            closeIcon.style.display = 'block';
            if (document.getElementById('chatMessages').children.length === 0) {
                addBotMessage("Hello! Welcome to GuitHub. How can I help you today?");
            }
            setTimeout(() => document.getElementById('chatInput').focus(), 100);
        } else {
            win.style.display = 'none';
            chatIcon.style.display  = 'block';
            closeIcon.style.display = 'none';
        }
    }

    // ── Send message ──────────────────────────────────────
    async function sendMessage() {
        const input   = document.getElementById('chatInput');
        const message = input.value.trim();
        if (!message) return;

        addUserMessage(message);
        input.value = '';

        // Typing indicator
        const typingId = addTypingIndicator();

        try {
            const res  = await fetch('chatbot_api.php?action=chat', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ message })
            });
            const data = await res.json();
            removeTypingIndicator(typingId);

            if (data.success) {
                addBotMessage(data.reply);
            } else {
                addBotMessage("Sorry, I encountered an error. Please try again!");
            }
        } catch {
            removeTypingIndicator(typingId);
            addBotMessage("I'm having trouble connecting. Please check your connection and try again.");
        }
    }

    function handleChatKey(e) {
        if (e.key === 'Enter') sendMessage();
    }

    // ── Message helpers ───────────────────────────────────
    function addUserMessage(text) {
        const messages = document.getElementById('chatMessages');
        const div = document.createElement('div');
        div.className = 'chat-msg user-msg';
        div.innerHTML = `
            <div class="msg-bubble user-bubble">${escapeHtml(text)}</div>
            <div class="msg-time">${getTime()}</div>
        `;
        messages.appendChild(div);
        scrollBottom();
    }

    function addBotMessage(text) {
        const messages = document.getElementById('chatMessages');
        const div = document.createElement('div');
        div.className = 'chat-msg bot-msg';
        div.innerHTML = `
            <div class="msg-bubble bot-bubble">${escapeHtml(text)}</div>
            <div class="msg-time">${getTime()}</div>
        `;
        messages.appendChild(div);
        scrollBottom();
    }

    function addTypingIndicator() {
        const messages = document.getElementById('chatMessages');
        const id = 'typing-' + Date.now();
        const div = document.createElement('div');
        div.id = id;
        div.className = 'chat-msg bot-msg';
        div.innerHTML = `
            <div class="msg-bubble bot-bubble typing-bubble">
                <span></span><span></span><span></span>
            </div>
        `;
        messages.appendChild(div);
        scrollBottom();
        return id;
    }

    function removeTypingIndicator(id) {
        const el = document.getElementById(id);
        if (el) el.remove();
    }

    function scrollBottom() {
        const messages = document.getElementById('chatMessages');
        messages.scrollTop = messages.scrollHeight;
    }

    function getTime() {
        return new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
    }

    function escapeHtml(str) {
        const d = document.createElement('div');
        d.textContent = str;
        return d.innerHTML;
    }
</script>
