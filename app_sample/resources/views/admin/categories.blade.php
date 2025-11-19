<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Categories Management - Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --primary-green: #2d5016;
            --light-green: #4a7c2c;
            --accent-green: #6ba83d;
            --dark-bg: #1a1f2e;
            --card-bg: #242b3d;
            --text-primary: #e4e6eb;
            --text-secondary: #b0b3b8;
            --border-color: #3a3f51;
            --success: #42b72a;
            --danger: #dc3545;
            --warning: #ffc107;
            --info: #17a2b8;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #1a1f2e 0%, #2d5016 100%);
            color: var(--text-primary);
            min-height: 100vh;
        }
        .admin-header {
            background: var(--dark-bg);
            border-bottom: 2px solid var(--primary-green);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 4px 6px rgba(0,0,0,0.3);
        }
        .admin-logo {
            display: flex;
            align-items: center;
            gap: 1rem;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--accent-green);
            text-decoration: none;
        }
        .admin-logo i {
            font-size: 2rem;
        }
        .admin-nav {
            display: flex;
            gap: 2rem;
            align-items: center;
        }
        .admin-nav a {
            color: var(--text-secondary);
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .admin-nav a:hover, .admin-nav a.active {
            background: var(--primary-green);
            color: white;
        }
        .admin-user {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .admin-user-info {
            text-align: right;
        }
        .admin-user-name {
            font-weight: 600;
            color: var(--text-primary);
        }
        .admin-user-role {
            font-size: 0.85rem;
            color: var(--accent-green);
        }
        .admin-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            border: 2px solid var(--accent-green);
            object-fit: cover;
        }
        .admin-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
        }
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }
        .page-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--accent-green);
        }
        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.95rem;
            font-weight: 600;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }
        .btn-success {
            background: var(--success);
            color: white;
        }
        .btn-success:hover {
            background: #3ba222;
        }
        .btn-sm {
            padding: 0.4rem 0.8rem;
            font-size: 0.8rem;
        }
        .btn-info {
            background: var(--info);
            color: white;
        }
        .btn-info:hover {
            background: #138496;
        }
        .btn-danger {
            background: var(--danger);
            color: white;
        }
        .btn-danger:hover {
            background: #c82333;
        }
        .categories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        .category-card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 1.5rem;
            transition: all 0.3s;
        }
        .category-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.3);
            border-color: var(--accent-green);
        }
        .category-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
        }
        .category-name {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--accent-green);
        }
        .post-count {
            background: rgba(107, 168, 61, 0.2);
            color: var(--accent-green);
            padding: 0.25rem 0.75rem;
            border-radius: 12px;
            font-size: 0.85rem;
            font-weight: 600;
        }
        .category-description {
            color: var(--text-secondary);
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }
        .category-actions {
            display: flex;
            gap: 0.5rem;
        }
        .notification {
            position: fixed;
            top: 80px;
            right: 20px;
            padding: 1rem 1.5rem;
            background: var(--card-bg);
            border-left: 4px solid var(--accent-green);
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
            z-index: 1000;
            animation: slideIn 0.3s ease;
        }
        @keyframes slideIn {
            from { transform: translateX(400px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        /* Modal styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.7);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 2000;
        }
        .modal-overlay.active {
            display: flex;
        }
        .modal-content {
            background: var(--card-bg);
            border-radius: 16px;
            padding: 2rem;
            max-width: 500px;
            width: 90%;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.5);
            border: 1px solid var(--border-color);
        }
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        .modal-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--accent-green);
        }
        .close-modal {
            background: none;
            border: none;
            color: var(--text-secondary);
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.3s;
        }
        .close-modal:hover {
            background: var(--border-color);
            color: var(--text-primary);
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--text-primary);
            font-weight: 600;
        }
        .form-input, .form-textarea {
            width: 100%;
            background: var(--dark-bg);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            padding: 0.75rem;
            border-radius: 8px;
            font-size: 0.95rem;
            font-family: inherit;
        }
        .form-input:focus, .form-textarea:focus {
            outline: none;
            border-color: var(--accent-green);
        }
        .form-textarea {
            resize: vertical;
            min-height: 100px;
        }
        .modal-actions {
            display: flex;
            gap: 1rem;
        }
        .modal-btn {
            flex: 1;
            padding: 0.875rem 1.5rem;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }
        .modal-btn-cancel {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
        }
        .modal-btn-cancel:hover {
            background: var(--border-color);
        }
        .modal-btn-submit {
            background: var(--accent-green);
            color: white;
        }
        .modal-btn-submit:hover {
            background: var(--light-green);
        }
        .confirm-modal .modal-icon {
            width: 70px;
            height: 70px;
            margin: 0 auto 1.5rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            background: rgba(220, 53, 69, 0.2);
            color: var(--danger);
        }
        .confirm-modal .modal-title {
            text-align: center;
            margin-bottom: 0.75rem;
        }
        .confirm-modal .modal-message {
            text-align: center;
            color: var(--text-secondary);
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        /* Mobile Menu Toggle */
        .mobile-menu-toggle {
            display: none;
            background: none;
            border: none;
            color: var(--accent-green);
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0.5rem;
        }

        /* Responsive Styles */
        @media (max-width: 1024px) {
            .admin-nav {
                gap: 1rem;
            }
            .admin-nav a {
                font-size: 0.9rem;
                padding: 0.4rem 0.8rem;
            }
            .admin-container {
                padding: 1.5rem;
            }
            .categories-grid {
                grid-template-columns: 1fr;
            }
            .categories-table {
                font-size: 0.9rem;
            }
        }

        @media (max-width: 768px) {
            .admin-header {
                padding: 1rem;
                flex-wrap: wrap;
            }
            .admin-logo {
                font-size: 1.2rem;
            }
            .admin-logo i {
                font-size: 1.5rem;
            }
            .mobile-menu-toggle {
                display: block;
                order: 2;
            }
            .admin-nav {
                display: none;
                order: 3;
                width: 100%;
                flex-direction: column;
                gap: 0.5rem;
                margin-top: 1rem;
                padding-top: 1rem;
                border-top: 1px solid var(--border-color);
            }
            .admin-nav.active {
                display: flex;
            }
            .admin-nav a {
                width: 100%;
                justify-content: flex-start;
            }
            .admin-user {
                order: 1;
                margin-left: auto;
            }
            .admin-user-info {
                display: none;
            }
            .admin-container {
                padding: 1rem;
            }
            .page-header h1 {
                font-size: 1.5rem;
            }
            .categories-grid {
                gap: 1rem;
            }
            .form-group input, .form-group textarea {
                font-size: 0.9rem;
            }
            .categories-table-wrapper {
                overflow-x: auto;
            }
            .btn {
                padding: 0.4rem 0.6rem;
                font-size: 0.8rem;
            }
            .modal-content {
                width: 95%;
                padding: 1.25rem;
            }
        }

        @media (max-width: 480px) {
            .admin-header {
                padding: 0.75rem;
            }
            .admin-logo span {
                display: none;
            }
            .admin-container {
                padding: 0.75rem;
            }
            .page-header {
                padding: 1rem;
            }
            .page-header h1 {
                font-size: 1.25rem;
            }
            .card {
                padding: 1rem;
            }
            .card-title {
                font-size: 1rem;
            }
            .form-group label {
                font-size: 0.9rem;
            }
            .categories-table {
                font-size: 0.8rem;
            }
            .categories-table th, .categories-table td {
                padding: 0.5rem 0.25rem;
            }
            .badge {
                font-size: 0.65rem;
                padding: 0.2rem 0.5rem;
            }
            .btn {
                padding: 0.3rem 0.5rem;
                font-size: 0.75rem;
            }
        }

        @media (max-width: 360px) {
            .admin-container {
                padding: 0.5rem;
            }
            .card {
                padding: 0.75rem;
            }
            .categories-table {
                font-size: 0.75rem;
            }
        }
    </style>
</head>
<body>
    <header class="admin-header">
        <div class="admin-logo">
            <i class="fas fa-shield-alt"></i>
            <span>Farm Guide Admin</span>
        </div>
        <button class="mobile-menu-toggle" onclick="toggleMobileMenu()">
            <i class="fas fa-bars"></i>
        </button>
        <nav class="admin-nav" id="adminNav">
            <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i> Dashboard</a>
            <a href="{{ route('admin.users') }}"><i class="fas fa-users"></i> Users</a>
            <a href="{{ route('admin.posts') }}"><i class="fas fa-file-alt"></i> Posts</a>
            <a href="{{ route('admin.categories') }}" class="active"><i class="fas fa-tags"></i> Categories</a>
            <a href="{{ route('admin.reports') }}"><i class="fas fa-chart-line"></i> Reports</a>
            <a href="{{ route('dashboard') }}"><i class="fas fa-arrow-left"></i> Exit Admin</a>
        </nav>
        <div class="admin-user">
            <div class="admin-user-info">
                <div class="admin-user-name">{{ auth()->user()->name }}</div>
                <div class="admin-user-role">Administrator</div>
            </div>
            @if(auth()->user()->profile_picture)
                <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" alt="Admin" class="admin-avatar">
            @else
                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=6ba83d&color=fff" alt="Admin" class="admin-avatar">
            @endif
        </div>
    </header>

    <div class="admin-container">
        <div class="page-header">
            <h1 class="page-title"><i class="fas fa-tags"></i> Categories Management</h1>
            <button class="btn btn-success" onclick="openCreateModal()">
                <i class="fas fa-plus"></i> Create Category
            </button>
        </div>

        <div class="categories-grid">
            @forelse($categories as $category)
            <div class="category-card">
                <div class="category-header">
                    <h3 class="category-name">{{ $category->name }}</h3>
                    <span class="post-count">{{ $category->posts_count }} posts</span>
                </div>
                <p class="category-description">
                    {{ $category->description ?? 'No description provided.' }}
                </p>
                <div class="category-actions">
                    <button class="btn btn-sm btn-info" onclick='openEditModal({{ json_encode($category) }})'>
                        <i class="fas fa-edit"></i> Edit
                    </button>
                    <button class="btn btn-sm btn-danger" onclick="deleteCategory({{ $category->CategoryID }}, '{{ $category->name }}', {{ $category->posts_count }})">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </div>
            </div>
            @empty
            <div style="grid-column: 1/-1; text-align: center; padding: 4rem; color: var(--text-secondary);">
                <i class="fas fa-tags" style="font-size: 3rem; margin-bottom: 1rem; display: block; opacity: 0.5;"></i>
                <h3>No categories yet</h3>
                <p>Click "Create Category" to add your first category</p>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Create/Edit Category Modal -->
    <div class="modal-overlay" id="categoryModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="modalTitle">Create Category</h2>
                <button class="close-modal" onclick="closeModal('categoryModal')">&times;</button>
            </div>
            <form id="categoryForm">
                <input type="hidden" id="categoryId" value="">
                <div class="form-group">
                    <label class="form-label">Category Name *</label>
                    <input type="text" id="categoryName" class="form-input" placeholder="e.g., Crop Management" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea id="categoryDescription" class="form-textarea" placeholder="Brief description of this category"></textarea>
                </div>
                <div class="modal-actions">
                    <button type="button" class="modal-btn modal-btn-cancel" onclick="closeModal('categoryModal')">Cancel</button>
                    <button type="submit" class="modal-btn modal-btn-submit">
                        <i class="fas fa-save"></i> <span id="submitText">Create Category</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal-overlay confirm-modal" id="confirmModal">
        <div class="modal-content">
            <div class="modal-icon">
                <i class="fas fa-trash-alt"></i>
            </div>
            <h2 class="modal-title">Delete Category?</h2>
            <p class="modal-message" id="confirmMessage"></p>
            <div class="modal-actions">
                <button class="modal-btn modal-btn-cancel" onclick="closeModal('confirmModal')">Cancel</button>
                <button class="modal-btn btn-danger" id="confirmDeleteBtn">Delete Category</button>
            </div>
        </div>
    </div>

    <script>
        let currentCategoryId = null;

        function showNotification(message, type = 'success') {
            const notification = document.createElement('div');
            notification.className = 'notification';
            notification.textContent = message;
            notification.style.borderLeftColor = type === 'success' ? '#42b72a' : '#dc3545';
            document.body.appendChild(notification);
            setTimeout(() => notification.remove(), 3000);
        }

        function openCreateModal() {
            document.getElementById('modalTitle').textContent = 'Create Category';
            document.getElementById('submitText').textContent = 'Create Category';
            document.getElementById('categoryId').value = '';
            document.getElementById('categoryName').value = '';
            document.getElementById('categoryDescription').value = '';
            document.getElementById('categoryModal').classList.add('active');
        }

        function openEditModal(category) {
            document.getElementById('modalTitle').textContent = 'Edit Category';
            document.getElementById('submitText').textContent = 'Update Category';
            document.getElementById('categoryId').value = category.CategoryID;
            document.getElementById('categoryName').value = category.name;
            document.getElementById('categoryDescription').value = category.description || '';
            document.getElementById('categoryModal').classList.add('active');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('active');
        }

        document.getElementById('categoryForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const categoryId = document.getElementById('categoryId').value;
            const name = document.getElementById('categoryName').value;
            const description = document.getElementById('categoryDescription').value;

            const url = categoryId ? `/admin/categories/${categoryId}` : '/admin/categories';
            const method = categoryId ? 'PUT' : 'POST';

            fetch(url, {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ name, description })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification(data.message, 'success');
                    setTimeout(() => location.reload(), 1000);
                } else {
                    showNotification(data.message, 'error');
                }
                closeModal('categoryModal');
            })
            .catch(error => {
                showNotification('Error saving category', 'error');
                closeModal('categoryModal');
            });
        });

        function deleteCategory(categoryId, categoryName, postCount) {
            currentCategoryId = categoryId;

            let message = `Are you sure you want to delete "${categoryName}"?`;
            if (postCount > 0) {
                message += ` This category contains ${postCount} post(s). These posts will become uncategorized.`;
            }

            document.getElementById('confirmMessage').textContent = message;
            document.getElementById('confirmModal').classList.add('active');
        }

        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
            if (!currentCategoryId) return;

            fetch(`/admin/categories/${currentCategoryId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification(data.message, 'success');
                    setTimeout(() => location.reload(), 1000);
                } else {
                    showNotification(data.message, 'error');
                }
                closeModal('confirmModal');
            })
            .catch(error => {
                showNotification('Error deleting category', 'error');
                closeModal('confirmModal');
            });
        });

        document.querySelectorAll('.modal-overlay').forEach(modal => {
            modal.addEventListener('click', function(e) {
                if (e.target === this) {
                    this.classList.remove('active');
                }
            });
        });

        // Mobile menu toggle
        function toggleMobileMenu() {
            const nav = document.getElementById('adminNav');
            nav.classList.toggle('active');
        }

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            const nav = document.getElementById('adminNav');
            const toggle = document.querySelector('.mobile-menu-toggle');

            if (nav && toggle && !nav.contains(event.target) && !toggle.contains(event.target)) {
                nav.classList.remove('active');
            }
        });

        // Close mobile menu when window is resized
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                document.getElementById('adminNav').classList.remove('active');
            }
        });
    </script>
</body>
</html>
