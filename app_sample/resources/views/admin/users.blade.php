<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>User Management - Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

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
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
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
            min-width: 0;
        }

        @media (max-width: 768px) {
            .filter-input, .filter-select {
                min-width: 100%;
            }
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
            table-layout: auto;
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

        .admin-table td {
            padding: 1rem 0.75rem;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }

        .admin-table tr:hover {
            background: rgba(107, 168, 61, 0.05);
        }

        .user-cell {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            border: 2px solid var(--accent-green);
            object-fit: cover;
        }

        .user-info {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-weight: 600;
            color: var(--text-primary);
        }

        .user-email {
            font-size: 0.85rem;
            color: var(--text-secondary);
        }

        .badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .badge-admin {
            background: rgba(107, 168, 61, 0.2);
            color: var(--accent-green);
        }

        .badge-user {
            background: rgba(23, 162, 184, 0.2);
            color: var(--info);
        }

        .badge-success {
            background: rgba(66, 183, 42, 0.2);
            color: var(--success);
        }

        .badge-danger {
            background: rgba(220, 53, 69, 0.2);
            color: var(--danger);
        }

        .action-btns {
            display: flex;
            gap: 0.5rem;
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

        .btn-warning {
            background: var(--warning);
            color: #000;
        }

        .btn-warning:hover {
            background: #e0a800;
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
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .role-select {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            padding: 0.4rem 0.8rem;
            border-radius: 6px;
            cursor: pointer;
        }

        /* Confirmation Modal */
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
            animation: fadeIn 0.3s ease;
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
            animation: slideUp 0.3s ease;
            border: 1px solid var(--border-color);
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideUp {
            from {
                transform: translateY(50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
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
        }

        .modal-icon.warning {
            background: rgba(255, 193, 7, 0.2);
            color: var(--warning);
        }

        .modal-icon.danger {
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

        .modal-user-info {
            background: rgba(107, 168, 61, 0.1);
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 2rem;
            border: 1px solid var(--border-color);
        }

        .modal-user-name {
            font-weight: 600;
            color: var(--accent-green);
            text-align: center;
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
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
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

        .modal-btn-warning {
            background: var(--warning);
            color: #000;
        }

        .modal-btn-warning:hover {
            background: #e0a800;
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

            .controls-row {
                flex-direction: column;
                align-items: stretch;
            }

            .search-box {
                width: 100%;
            }

            .filter-group {
                flex-wrap: wrap;
            }

            .users-table {
                font-size: 0.9rem;
            }

            .users-table th,
            .users-table td {
                padding: 0.75rem 0.5rem;
            }

            .action-btns {
                flex-direction: column;
            }

            .btn {
                width: 100%;
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

            .stats-row {
                flex-direction: column;
            }

            .stat-card {
                padding: 1rem;
            }

            .stat-value {
                font-size: 1.75rem;
            }

            .stat-icon {
                font-size: 2rem;
            }

            /* Make table scrollable */
            .admin-card {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .admin-table {
                min-width: 900px;
            }

            .admin-table th,
            .admin-table td {
                white-space: normal;
            }

            .user-cell {
                min-width: 180px;
            }

            .user-email {
                display: none;
            }

            .role-select {
                min-width: 110px;
            }

            .action-btns {
                flex-direction: row;
                flex-wrap: wrap;
                gap: 0.5rem;
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
                max-width: 400px;
                padding: 1.25rem;
            }

            .modal h2 {
                font-size: 1.25rem;
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

            .stat-card {
                padding: 0.75rem;
            }

            .stat-value {
                font-size: 1.5rem;
            }

            .stat-icon {
                font-size: 1.75rem;
            }

            .stat-label {
                font-size: 0.85rem;
            }

            .main-card {
                padding: 1rem;
            }

            .card-header h2 {
                font-size: 1rem;
            }

            .search-box input {
                font-size: 0.9rem;
                padding: 0.6rem 0.8rem 0.6rem 2.5rem;
            }

            .filter-group {
                gap: 0.5rem;
            }

            .filter-group select {
                font-size: 0.9rem;
                padding: 0.6rem 2rem 0.6rem 0.8rem;
            }

            .admin-card {
                padding: 1rem;
            }

            .admin-table {
                font-size: 0.8rem;
                min-width: 800px;
            }

            .admin-table th,
            .admin-table td {
                padding: 0.5rem 0.4rem;
            }

            .user-cell {
                min-width: 140px;
            }

            .user-avatar {
                width: 32px;
                height: 32px;
            }

            .user-name {
                font-size: 0.9rem;
            }

            .role-select {
                font-size: 0.85rem;
                padding: 0.4rem;
                min-width: 100px;
            }

            .badge {
                font-size: 0.65rem;
                padding: 0.2rem 0.5rem;
            }

            .action-btns {
                gap: 0.35rem;
            }

            .btn {
                padding: 0.3rem 0.5rem;
                font-size: 0.75rem;
            }

            .modal-content {
                padding: 1rem;
            }

            .modal h2 {
                font-size: 1.1rem;
            }

            .modal-btns {
                flex-direction: column;
            }

            .modal-btn {
                width: 100%;
            }
        }

        @media (max-width: 360px) {
            .admin-container {
                padding: 0.5rem;
            }

            .page-header {
                padding: 0.75rem;
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

            .admin-card {
                padding: 0.75rem;
            }

            .admin-table {
                font-size: 0.75rem;
                min-width: 700px;
            }

            .admin-table th,
            .admin-table td {
                padding: 0.4rem 0.25rem;
            }

            .user-cell {
                min-width: 120px;
            }

            .user-avatar {
                width: 28px;
                height: 28px;
            }

            .user-name {
                font-size: 0.8rem;
            }

            .role-select {
                font-size: 0.75rem;
                padding: 0.3rem;
                min-width: 90px;
            }

            .badge {
                font-size: 0.6rem;
                padding: 0.15rem 0.4rem;
            }

            .btn {
                padding: 0.25rem 0.4rem;
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
            <a href="{{ route('admin.dashboard') }}">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <a href="{{ route('admin.users') }}" class="active">
                <i class="fas fa-users"></i> Users
            </a>
            <a href="{{ route('admin.posts') }}">
                <i class="fas fa-file-alt"></i> Posts
            </a>
            <a href="{{ route('admin.categories') }}">
                <i class="fas fa-tags"></i> Categories
            </a>
            <a href="{{ route('admin.reports') }}">
                <i class="fas fa-chart-line"></i> Reports
            </a>
            <a href="{{ route('dashboard') }}">
                <i class="fas fa-arrow-left"></i> Exit Admin
            </a>
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
            <h1 class="page-title"><i class="fas fa-users"></i> User Management</h1>
        </div>

        <div class="filters">
            <input type="text" class="filter-input" id="searchInput" placeholder="Search users...">
            <select class="filter-select" id="roleFilter">
                <option value="all">All Roles</option>
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>
        </div>

        <div class="admin-card">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Posts</th>
                        <th>Comments</th>
                        <th>Joined</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>
                            <div class="user-cell">
                                @if($user->profile_picture)
                                    <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="{{ $user->name }}" class="user-avatar">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=6ba83d&color=fff" alt="{{ $user->name }}" class="user-avatar">
                                @endif
                                <div class="user-info">
                                    <span class="user-name">{{ $user->name }}</span>
                                    <span class="user-email">{{ $user->email }}</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <select class="role-select" onchange="updateRole({{ $user->UserID }}, this.value)">
                                <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="moderator" {{ $user->role === 'moderator' ? 'selected' : '' }}>Moderator</option>
                            </select>
                        </td>
                        <td>
                            @if($user->status === 'active')
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-danger">Banned</span>
                            @endif
                        </td>
                        <td>{{ $user->posts_count ?? 0 }}</td>
                        <td>{{ $user->comments_count ?? 0 }}</td>
                        <td>{{ $user->created_at->format('M d, Y') }}</td>
                        <td>
                            <div class="action-btns">
                                <button class="btn btn-sm btn-warning" onclick="toggleStatus({{ $user->UserID }})">
                                    <i class="fas fa-ban"></i> {{ $user->status === 'active' ? 'Ban' : 'Unban' }}
                                </button>
                                @if($user->UserID !== auth()->id())
                                <button class="btn btn-sm btn-danger" onclick="deleteUser({{ $user->UserID }})">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="pagination">
                {{ $users->links() }}
            </div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal-overlay" id="confirmModal">
        <div class="modal-content">
            <div class="modal-icon" id="modalIcon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <h2 class="modal-title" id="modalTitle">Confirm Action</h2>
            <p class="modal-message" id="modalMessage">Are you sure you want to proceed?</p>
            <div class="modal-user-info" id="modalUserInfo" style="display: none;">
                <div class="modal-user-name" id="modalUserName"></div>
            </div>
            <div class="modal-actions">
                <button class="modal-btn modal-btn-cancel" onclick="closeModal()">
                    <i class="fas fa-times"></i> Cancel
                </button>
                <button class="modal-btn modal-btn-confirm" id="modalConfirmBtn">
                    <i class="fas fa-check"></i> Confirm
                </button>
            </div>
        </div>
    </div>

    <script>
        let currentAction = null;
        let currentUserId = null;
        let currentUserName = null;

        function showNotification(message, type = 'success') {
            const notification = document.createElement('div');
            notification.className = 'notification';
            notification.textContent = message;
            notification.style.borderLeftColor = type === 'success' ? '#42b72a' : '#dc3545';
            document.body.appendChild(notification);

            setTimeout(() => {
                notification.remove();
            }, 3000);
        }

        function showModal(title, message, userName, actionType, confirmCallback) {
            currentAction = confirmCallback;

            const modal = document.getElementById('confirmModal');
            const modalIcon = document.getElementById('modalIcon');
            const modalTitle = document.getElementById('modalTitle');
            const modalMessage = document.getElementById('modalMessage');
            const modalUserInfo = document.getElementById('modalUserInfo');
            const modalUserName = document.getElementById('modalUserName');
            const confirmBtn = document.getElementById('modalConfirmBtn');

            // Set content
            modalTitle.textContent = title;
            modalMessage.textContent = message;

            if (userName) {
                modalUserName.textContent = userName;
                modalUserInfo.style.display = 'block';
            } else {
                modalUserInfo.style.display = 'none';
            }

            // Set icon and button style
            if (actionType === 'delete') {
                modalIcon.className = 'modal-icon danger';
                modalIcon.innerHTML = '<i class="fas fa-trash-alt"></i>';
                confirmBtn.className = 'modal-btn modal-btn-confirm';
                confirmBtn.innerHTML = '<i class="fas fa-trash"></i> Delete User';
            } else if (actionType === 'ban') {
                modalIcon.className = 'modal-icon warning';
                modalIcon.innerHTML = '<i class="fas fa-ban"></i>';
                confirmBtn.className = 'modal-btn modal-btn-warning';
                confirmBtn.innerHTML = '<i class="fas fa-ban"></i> Ban User';
            } else if (actionType === 'unban') {
                modalIcon.className = 'modal-icon warning';
                modalIcon.innerHTML = '<i class="fas fa-user-check"></i>';
                confirmBtn.className = 'modal-btn modal-btn-warning';
                confirmBtn.innerHTML = '<i class="fas fa-check"></i> Unban User';
            }

            modal.classList.add('active');
        }

        function closeModal() {
            document.getElementById('confirmModal').classList.remove('active');
            currentAction = null;
            currentUserId = null;
            currentUserName = null;
        }

        function confirmAction() {
            if (currentAction) {
                currentAction();
                closeModal();
            }
        }

        // Attach confirm action to button
        document.getElementById('modalConfirmBtn').addEventListener('click', confirmAction);

        // Close modal on overlay click
        document.getElementById('confirmModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        function updateRole(userId, role) {
            fetch(`/admin/users/${userId}/role`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ role })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification(data.message, 'success');
                } else {
                    showNotification(data.message, 'error');
                }
            })
            .catch(error => {
                showNotification('Error updating role', 'error');
            });
        }

        function toggleStatus(userId) {
            // Get user info from the table row
            const row = event.target.closest('tr');
            const userName = row.querySelector('.user-name').textContent;
            const statusBadge = row.querySelector('.badge');
            const isActive = statusBadge.classList.contains('badge-success');

            const action = isActive ? 'ban' : 'unban';
            const title = isActive ? 'Ban User?' : 'Unban User?';
            const message = isActive
                ? 'This user will no longer be able to access the platform. They can be unbanned later.'
                : 'This user will regain access to the platform.';

            showModal(title, message, userName, action, () => {
                fetch(`/admin/users/${userId}/toggle-status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
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
                })
                .catch(error => {
                    showNotification('Error changing status', 'error');
                });
            });
        }

        function deleteUser(userId) {
            // Get user info from the table row
            const row = event.target.closest('tr');
            const userName = row.querySelector('.user-name').textContent;

            showModal(
                'Delete User?',
                'This action cannot be undone! All user data including posts, comments, and images will be permanently deleted.',
                userName,
                'delete',
                () => {
                    fetch(`/admin/users/${userId}`, {
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
                    })
                    .catch(error => {
                        showNotification('Error deleting user', 'error');
                    });
                }
            );
        }

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

        // Close mobile menu when window is resized above mobile breakpoint
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                document.getElementById('adminNav').classList.remove('active');
            }
        });
    </script>
</body>
</html>
