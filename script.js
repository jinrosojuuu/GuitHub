/* ==========================================================
   script.js — GuitHub unified JavaScript
   Covers: hamburger nav, product filtering, admin CRUD,
           and chatbot widget helpers
   ========================================================== */

/* ── Hamburger Navigation ──────────────────────────────── */
document.addEventListener('DOMContentLoaded', function () {

    // Inject hamburger button into every navbar that doesn't already have one
    const navbar = document.querySelector('.navbar');
    if (navbar && !document.getElementById('hamburgerBtn')) {
        const btn = document.createElement('button');
        btn.id          = 'hamburgerBtn';
        btn.className   = 'hamburger';
        btn.setAttribute('aria-label', 'Toggle navigation');
        btn.setAttribute('aria-expanded', 'false');
        btn.innerHTML   = `
            <span class="ham-line"></span>
            <span class="ham-line"></span>
            <span class="ham-line"></span>`;
        navbar.appendChild(btn);

        btn.addEventListener('click', function () {
            const navLinks = document.querySelector('.nav-links');
            const open     = navLinks.classList.toggle('nav-open');
            btn.classList.toggle('ham-active', open);
            btn.setAttribute('aria-expanded', open);
        });

        // Close menu when a link is tapped (mobile UX)
        document.querySelectorAll('.nav-links a').forEach(function (a) {
            a.addEventListener('click', function () {
                document.querySelector('.nav-links').classList.remove('nav-open');
                document.getElementById('hamburgerBtn').classList.remove('ham-active');
            });
        });
    }

    // ── Product Filtering (products.php) ───────────────
    const searchInput    = document.getElementById('searchFilter');
    const categorySelect = document.getElementById('categoryFilter');
    const priceSelect    = document.getElementById('priceFilter');
    const productCount   = document.getElementById('productCount');
    const noResults      = document.getElementById('noResults');
    const guitarGrid     = document.getElementById('guitarGrid');

    if (searchInput && categorySelect && priceSelect) {
        const totalProducts = document.querySelectorAll('.product-card').length;

        function applyFilters() {
            const search   = searchInput.value.toLowerCase().trim();
            const category = categorySelect.value;
            const price    = priceSelect.value;

            const [priceMin, priceMax] = price === 'all'
                ? [0, Infinity]
                : price.split('-').map(Number);

            let visible = 0;

            document.querySelectorAll('.product-card').forEach(function (card) {
                const name      = card.querySelector('h3').textContent.toLowerCase();
                const cat       = card.dataset.category;
                const cardPrice = parseFloat(card.dataset.price);

                const matchSearch   = !search || name.includes(search) || cat.toLowerCase().includes(search);
                const matchCategory = category === 'all' || cat === category;
                const matchPrice    = cardPrice >= priceMin && cardPrice <= priceMax;

                if (matchSearch && matchCategory && matchPrice) {
                    card.style.display = '';
                    visible++;
                } else {
                    card.style.display = 'none';
                }
            });

            productCount.textContent     = 'Showing ' + visible + ' of ' + totalProducts + ' products';
            noResults.style.display      = visible === 0 ? 'block' : 'none';
            guitarGrid.style.display     = visible === 0 ? 'none'  : 'grid';
        }

        searchInput.addEventListener('input',  applyFilters);
        categorySelect.addEventListener('change', applyFilters);
        priceSelect.addEventListener('change',    applyFilters);

        // Initial count
        productCount.textContent = 'Showing ' + totalProducts + ' of ' + totalProducts + ' products';
    }

    // ── Admin Panel (admin.php) ─────────────────────────
    if (document.getElementById('tableBody')) {
        initAdmin();
    }
});


/* ==========================================================
   ADMIN PANEL LOGIC
   ========================================================== */
function initAdmin() {
    let deleteTargetId = null;
    let searchTimeout  = null;

    loadEntries();
    checkStatus();

    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', function () {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(loadEntries, 300);
        });
    }

    // Expose functions admin.php calls from onclick attributes
    window.openAddModal    = openAddModal;
    window.openEditModal   = openEditModal;
    window.closeModal      = closeModal;
    window.saveEntry       = saveEntry;
    window.openDeleteModal = openDeleteModal;
    window.closeDeleteModal = closeDeleteModal;
    window.confirmDelete   = confirmDelete;

    // Close modals on overlay click
    const entryModal  = document.getElementById('entryModal');
    const deleteModal = document.getElementById('deleteModal');
    if (entryModal)  entryModal.addEventListener('click',  function (e) { if (e.target === this) closeModal(); });
    if (deleteModal) deleteModal.addEventListener('click', function (e) { if (e.target === this) closeDeleteModal(); });

    // ── DB Status ───────────────────────────────────────
    async function checkStatus() {
        try {
            const res  = await fetch('chatbot_api.php?action=status');
            const data = await res.json();
            const el   = document.getElementById('dbStatus');
            if (data.success) {
                el.textContent  = 'Connected ✓';
                el.style.color  = '#16a34a';
            } else {
                el.textContent  = 'Error';
                el.style.color  = '#ef4444';
            }
        } catch {
            const el = document.getElementById('dbStatus');
            if (el) { el.textContent = 'Offline'; el.style.color = '#ef4444'; }
        }
    }

    // ── Load / render entries ───────────────────────────
    async function loadEntries() {
        const search = (document.getElementById('searchInput') || {}).value || '';
        const url    = 'chatbot_api.php?action=get_all&search=' + encodeURIComponent(search);

        try {
            const res  = await fetch(url);
            const data = await res.json();

            const totalEl    = document.getElementById('totalCount');
            const filteredEl = document.getElementById('filteredCount');
            if (totalEl)    totalEl.textContent    = data.total    ?? 0;
            if (filteredEl) filteredEl.textContent = data.filtered ?? 0;

            const tbody = document.getElementById('tableBody');
            if (!data.entries || data.entries.length === 0) {
                tbody.innerHTML = '<tr><td colspan="4"><div class="empty-state"><p>No entries found.</p></div></td></tr>';
                return;
            }

            tbody.innerHTML = data.entries.map(function (e) {
                return '<tr>' +
                    '<td>' + e.id + '</td>' +
                    '<td><span class="keyword-badge">' + escHtml(e.keyword) + '</span></td>' +
                    '<td class="reply-text">' + escHtml(e.reply) + '</td>' +
                    '<td>' +
                        '<div class="action-btns" style="justify-content:flex-end">' +
                            '<button class="edit-btn" onclick="openEditModal(' + e.id + ')" title="Edit">' +
                                '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">' +
                                    '<path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>' +
                                    '<path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>' +
                                '</svg>' +
                            '</button>' +
                            '<button class="del-btn" onclick="openDeleteModal(' + e.id + ')" title="Delete">' +
                                '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">' +
                                    '<polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/>' +
                                    '<path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4h6v2"/>' +
                                '</svg>' +
                            '</button>' +
                        '</div>' +
                    '</td>' +
                '</tr>';
            }).join('');
        } catch (err) {
            console.error(err);
            showToast('Failed to load entries', 'error');
        }
    }

    // ── Modals ──────────────────────────────────────────
    function openAddModal() {
        document.getElementById('modalTitle').textContent = 'Add New Entry';
        document.getElementById('entryId').value          = '';
        document.getElementById('entryKeyword').value     = '';
        document.getElementById('entryReply').value       = '';
        document.getElementById('entryModal').classList.add('active');
    }

    async function openEditModal(id) {
        try {
            const res  = await fetch('chatbot_api.php?action=get_one&id=' + id);
            const data = await res.json();
            if (!data.success) { showToast('Entry not found', 'error'); return; }

            document.getElementById('modalTitle').textContent = 'Edit Entry';
            document.getElementById('entryId').value          = data.entry.id;
            document.getElementById('entryKeyword').value     = data.entry.keyword;
            document.getElementById('entryReply').value       = data.entry.reply;
            document.getElementById('entryModal').classList.add('active');
        } catch {
            showToast('Failed to load entry', 'error');
        }
    }

    function closeModal() {
        document.getElementById('entryModal').classList.remove('active');
    }

    async function saveEntry() {
        const id      = document.getElementById('entryId').value;
        const keyword = document.getElementById('entryKeyword').value.trim();
        const reply   = document.getElementById('entryReply').value.trim();

        if (!keyword || !reply) {
            showToast('Both keyword and reply are required', 'error');
            return;
        }

        const action  = id ? 'update' : 'create';
        const payload = id ? { id: parseInt(id), keyword, reply } : { keyword, reply };

        try {
            const res  = await fetch('chatbot_api.php?action=' + action, {
                method:  'POST',
                headers: { 'Content-Type': 'application/json' },
                body:    JSON.stringify(payload)
            });
            const data = await res.json();

            if (data.success) {
                showToast(data.message, 'success');
                closeModal();
                loadEntries();
            } else {
                showToast(data.message, 'error');
            }
        } catch {
            showToast('Request failed', 'error');
        }
    }

    function openDeleteModal(id) {
        deleteTargetId = id;
        document.getElementById('deleteModal').classList.add('active');
    }

    function closeDeleteModal() {
        deleteTargetId = null;
        document.getElementById('deleteModal').classList.remove('active');
    }

    async function confirmDelete() {
        if (!deleteTargetId) return;
        try {
            const res  = await fetch('chatbot_api.php?action=delete', {
                method:  'POST',
                headers: { 'Content-Type': 'application/json' },
                body:    JSON.stringify({ id: deleteTargetId })
            });
            const data = await res.json();

            if (data.success) {
                showToast('Entry deleted', 'success');
                closeDeleteModal();
                loadEntries();
            } else {
                showToast(data.message, 'error');
            }
        } catch {
            showToast('Delete failed', 'error');
        }
    }

    // ── Toast ────────────────────────────────────────────
    function showToast(msg, type) {
        type = type || '';
        const t = document.getElementById('toast');
        if (!t) return;
        t.textContent = msg;
        t.className   = 'toast ' + type + ' show';
        setTimeout(function () { t.className = 'toast ' + type; }, 3000);
    }

    // ── HTML escape ──────────────────────────────────────
    function escHtml(str) {
        const d = document.createElement('div');
        d.textContent = str;
        return d.innerHTML;
    }
}


/* ==========================================================
   CHATBOT WIDGET LOGIC  (chatbot_widget.php inline script
   is kept in the widget file; these helpers are shared)
   ========================================================== */
// chatbot functions (toggleChat, sendMessage, etc.) remain in
// chatbot_widget.php because they depend on the widget's DOM
// being present. They are NOT duplicated here.
