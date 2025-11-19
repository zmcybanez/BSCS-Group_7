<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Posts Management - Admin Panel</title>
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
        .stats-row {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
        }
        .stat-box {
            flex: 1;
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 1rem;
            text-align: center;
            min-width: 120px;
        }
        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--accent-green);
        }
        .stat-label {
            color: var(--text-secondary);
            font-size: 0.85rem;
            margin-top: 0.5rem;
        }
        .filters {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            align-items: center;
        }
        .filter-input, .filter-select {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            padding: 0.75rem 1rem;
            border-radius: 8px;
            font-size: 0.95rem;
            min-width: 200px;
            flex: 1;
        }
        .filter-input:focus, .filter-select:focus {
            outline: none;
            border-color: var(--accent-green);
        }
        .admin-card {
            background: var(--card-bg);
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid var(--border-color);
        }
        .admin-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }
        .admin-table th {
            text-align: left;
            padding: 1rem 0.75rem;
            color: var(--text-secondary);
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            border-bottom: 2px solid var(--border-color);
            white-space: nowrap;
        }
        .admin-table th:nth-child(1) { width: 30%; } /* Post */
        .admin-table th:nth-child(2) { width: 15%; } /* Author */
        .admin-table th:nth-child(3) { width: 12%; } /* Category */
        .admin-table th:nth-child(4) { width: 13%; } /* Engagement */
        .admin-table th:nth-child(5) { width: 12%; } /* Posted */
        .admin-table th:nth-child(6) { width: 18%; } /* Actions */
        .admin-table td {
            padding: 1rem 0.75rem;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }
        .admin-table tr:hover {
            background: rgba(107, 168, 61, 0.05);
        }
        .post-title {
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.25rem;
        }
        .post-preview {
            color: var(--text-secondary);
            font-size: 0.85rem;
        }
        .author-cell {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .author-cell span {
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .author-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            border: 2px solid var(--accent-green);
            flex-shrink: 0;
            object-fit: cover;
        }
        .badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }
        .badge-success {
            background: rgba(66, 183, 42, 0.2);
            color: var(--success);
        }
        .badge-info {
            background: rgba(23, 162, 184, 0.2);
            color: var(--info);
        }
        .badge-warning {
            background: rgba(255, 193, 7, 0.2);
            color: var(--warning);
        }
        .engagement {
            display: flex;
            gap: 0.75rem;
            font-size: 0.9rem;
            white-space: nowrap;
        }
        .engagement span {
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }
        .btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.85rem;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }
        .btn-sm {
            padding: 0.4rem 0.8rem;
            font-size: 0.8rem;
        }
        .btn-danger {
            background: var(--danger);
            color: white;
        }
        .btn-danger:hover {
            background: #c82333;
        }
        .btn-info {
            background: var(--info);
            color: white;
        }
        .btn-info:hover {
            background: #138496;
        }
        .pagination {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 2rem;
        }
        .pagination a, .pagination span {
            padding: 0.5rem 1rem;
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 6px;
            color: var(--text-primary);
            text-decoration: none;
            transition: all 0.3s;
        }
        .pagination a:hover {
            background: var(--accent-green);
            border-color: var(--accent-green);
        }
        .pagination .active {
            background: var(--accent-green);
            border-color: var(--accent-green);
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
            max-width: 440px;
            width: 90%;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.5);
            border: 1px solid var(--border-color);
        }
        .modal-icon {
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
        .modal-title {
            text-align: center;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.75rem;
        }
        .modal-message {
            text-align: center;
            color: var(--text-secondary);
            margin-bottom: 2rem;
            line-height: 1.6;
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
        .modal-btn-confirm {
            background: var(--danger);
            color: white;
        }
        .modal-btn-confirm:hover {
            background: #c82333;
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
            .stats-row {
                flex-wrap: wrap;
            }
            .stat-box {
                min-width: 150px;
            }
            .filters {
                gap: 0.75rem;
            }
            .filter-input, .filter-select {
                min-width: 150px;
            }
            .admin-table {
                font-size: 0.9rem;
            }
            .admin-table th, .admin-table td {
                padding: 0.75rem 0.5rem;
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
            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            .page-header h1 {
                font-size: 1.5rem;
            }
            .stats-row {
                flex-direction: column;
            }
            .stat-card {
                padding: 1rem;
            }
            .stat-value {
                font-size: 1.75rem;
            }
            .filters {
                flex-direction: column;
                width: 100%;
            }
            .filter-input, .filter-select {
                width: 100%;
                min-width: 100%;
            }
            /* Table scrollable */
            .admin-card {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }
            .admin-table {
                min-width: 900px;
                table-layout: auto;
            }
            .admin-table th,
            .admin-table td {
                white-space: normal;
            }
            .author-cell {
                min-width: 130px;
            }
            .post-title {
                font-size: 0.9rem;
            }
            .post-preview {
                font-size: 0.8rem;
            }
            .btn {
                padding: 0.4rem 0.6rem;
                font-size: 0.8rem;
            }
            .btn i {
                font-size: 0.75rem;
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
                padding: 0.75rem;
            }
            .page-header h1 {
                font-size: 1.25rem;
            }
            .stats-row {
                gap: 0.75rem;
            }
            .stat-card {
                padding: 0.75rem;
            }
            .stat-value {
                font-size: 1.5rem;
            }
            .stat-label {
                font-size: 0.8rem;
            }
            .filters {
                gap: 0.5rem;
            }
            .filter-input, .filter-select {
                padding: 0.6rem 0.8rem;
                font-size: 0.9rem;
            }
            .admin-card {
                padding: 1rem;
            }
            .admin-table {
                font-size: 0.8rem;
                min-width: 800px;
            }
            .admin-table th, .admin-table td {
                padding: 0.5rem 0.3rem;
            }
            .author-cell {
                min-width: 110px;
            }
            .author-avatar {
                width: 28px;
                height: 28px;
            }
            .post-title {
                font-size: 0.85rem;
            }
            .post-preview {
                font-size: 0.75rem;
            }
            .badge {
                font-size: 0.65rem;
                padding: 0.2rem 0.5rem;
            }
            .btn {
                padding: 0.3rem 0.5rem;
                font-size: 0.75rem;
            }
            .engagement {
                gap: 0.4rem;
                font-size: 0.75rem;
            }
            .engagement i {
                font-size: 0.7rem;
            }
        }

        @media (max-width: 360px) {
            .admin-container {
                padding: 0.5rem;
            }
            .page-header {
                padding: 0.5rem;
            }
            .page-header h1 {
                font-size: 1.1rem;
            }
            .stats-row {
                gap: 0.5rem;
            }
            .stat-card {
                padding: 0.5rem;
            }
            .stat-value {
                font-size: 1.25rem;
            }
            .stat-label {
                font-size: 0.75rem;
            }
            .filter-input, .filter-select {
                padding: 0.5rem 0.7rem;
                font-size: 0.85rem;
            }
            .admin-card {
                padding: 0.75rem;
            }
            .admin-table {
                font-size: 0.75rem;
                min-width: 700px;
            }
            .admin-table th, .admin-table td {
                padding: 0.4rem 0.2rem;
            }
            .author-cell {
                min-width: 100px;
            }
            .author-avatar {
                width: 24px;
                height: 24px;
            }
            .post-title {
                font-size: 0.8rem;
            }
            .post-preview {
                font-size: 0.7rem;
            }
            .badge {
                font-size: 0.6rem;
                padding: 0.15rem 0.4rem;
            }
            .btn {
                padding: 0.25rem 0.4rem;
                font-size: 0.7rem;
            }
            .engagement {
                gap: 0.3rem;
                font-size: 0.7rem;
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
            <a href="{{ route('admin.posts') }}" class="active"><i class="fas fa-file-alt"></i> Posts</a>
            <a href="{{ route('admin.categories') }}"><i class="fas fa-tags"></i> Categories</a>
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
            <h1 class="page-title"><i class="fas fa-file-alt"></i> Posts Management</h1>
        </div>

        <div class="stats-row">
            <div class="stat-box">
                <div class="stat-value">{{ $posts->total() }}</div>
                <div class="stat-label">Total Posts</div>
            </div>
            <div class="stat-box">
                <div class="stat-value">{{ $posts->sum('likes_count') }}</div>
                <div class="stat-label">Total Likes</div>
            </div>
            <div class="stat-box">
                <div class="stat-value">{{ $posts->sum('comments_count') }}</div>
                <div class="stat-label">Total Comments</div>
            </div>
        </div>

        <form method="GET" action="{{ route('admin.posts') }}">
            <div class="filters">
                <input type="text" name="search" class="filter-input" placeholder="Search posts..." value="{{ request('search') }}">
                <select name="category" class="filter-select" onchange="this.form.submit()">
                    <option value="all">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->CategoryID }}" {{ request('category') == $category->CategoryID ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <select name="status" class="filter-select" onchange="this.form.submit()">
                    <option value="all">All Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
        </form>

        <div class="admin-card">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Post</th>
                        <th>Author</th>
                        <th>Category</th>
                        <th>Engagement</th>
                        <th>Posted</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($posts as $post)
                    <tr>
                        <td>
                            <div class="post-title">{{ Str::limit($post->title, 60) }}</div>
                            <div class="post-preview">{{ Str::limit(strip_tags($post->content), 100) }}</div>
                        </td>
                        <td>
                            <div class="author-cell">
                                @if($post->user->profile_picture)
                                    <img src="{{ asset('storage/' . $post->user->profile_picture) }}" alt="{{ $post->user->name }}" class="author-avatar">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($post->user->name) }}&background=6ba83d&color=fff" alt="{{ $post->user->name }}" class="author-avatar">
                                @endif
                                <span>{{ $post->user->name }}</span>
                            </div>
                        </td>
                        <td>
                            @if($post->category)
                                <span class="badge badge-info">{{ $post->category->name }}</span>
                            @else
                                <span class="badge badge-warning">Uncategorized</span>
                            @endif
                        </td>
                        <td>
                            <div class="engagement">
                                <span><i class="fas fa-thumbs-up" style="color: var(--accent-green);"></i> {{ $post->likes_count }}</span>
                                <span><i class="fas fa-comment" style="color: var(--info);"></i> {{ $post->comments_count }}</span>
                            </div>
                        </td>
                        <td>{{ $post->created_at->diffForHumans() }}</td>
                        <td>
                            <div style="display: flex; gap: 0.5rem;">
                                <a href="{{ route('user.profile', $post->userID) }}" class="btn btn-sm btn-info" target="_blank">
                                    <i class="fas fa-eye"></i> View
                                </a>
                                <button class="btn btn-sm btn-danger" onclick="deletePost({{ $post->PostID }}, '{{ Str::limit($post->title, 50) }}')">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 2rem; color: var(--text-secondary);">
                            <i class="fas fa-inbox" style="font-size: 2rem; margin-bottom: 0.5rem; display: block;"></i>
                            No posts found
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="pagination">
                {{ $posts->links() }}
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal-overlay" id="confirmModal">
        <div class="modal-content">
            <div class="modal-icon">
                <i class="fas fa-trash-alt"></i>
            </div>
            <h2 class="modal-title">Delete Post?</h2>
            <p class="modal-message">Are you sure you want to delete this post? This action cannot be undone!</p>
            <p id="postTitle" style="text-align: center; color: var(--accent-green); font-weight: 600; margin-bottom: 2rem;"></p>
            <div class="modal-actions">
                <button class="modal-btn modal-btn-cancel" onclick="closeModal()">Cancel</button>
                <button class="modal-btn modal-btn-confirm" id="confirmDeleteBtn">Delete Post</button>
            </div>
        </div>
    </div>

    <script>
        let currentPostId = null;

        function showNotification(message, type = 'success') {
            const notification = document.createElement('div');
            notification.className = 'notification';
            notification.textContent = message;
            notification.style.borderLeftColor = type === 'success' ? '#42b72a' : '#dc3545';
            document.body.appendChild(notification);
            setTimeout(() => notification.remove(), 3000);
        }

        function deletePost(postId, postTitle) {
            currentPostId = postId;
            document.getElementById('postTitle').textContent = postTitle;
            document.getElementById('confirmModal').classList.add('active');
        }

        function closeModal() {
            document.getElementById('confirmModal').classList.remove('active');
            currentPostId = null;
        }

        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
            if (!currentPostId) return;

            fetch(`/admin/posts/${currentPostId}`, {
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
                closeModal();
            })
            .catch(error => {
                showNotification('Error deleting post', 'error');
                closeModal();
            });
        });

        document.getElementById('confirmModal').addEventListener('click', function(e) {
            if (e.target === this) closeModal();
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
