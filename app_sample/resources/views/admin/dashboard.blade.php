<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard - Farm Guide</title>
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

        /* Admin Header */
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

        /* Main Container */
        .admin-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: var(--card-bg);
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid var(--border-color);
            transition: transform 0.3s, box-shadow 0.3s;
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.4);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: var(--accent-green);
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .stat-icon {
            font-size: 2.5rem;
            opacity: 0.8;
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--accent-green);
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: var(--text-secondary);
            font-size: 0.95rem;
        }

        /* Content Grid */
        .content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .admin-card {
            background: var(--card-bg);
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid var(--border-color);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border-color);
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .view-all-btn {
            color: var(--accent-green);
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s;
        }

        .view-all-btn:hover {
            color: var(--light-green);
        }

        /* Table Styles */
        .admin-table {
            width: 100%;
            border-collapse: collapse;
        }

        .admin-table th {
            text-align: left;
            padding: 0.75rem;
            color: var(--text-secondary);
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            border-bottom: 2px solid var(--border-color);
        }

        .admin-table td {
            padding: 1rem 0.75rem;
            border-bottom: 1px solid var(--border-color);
        }

        .admin-table tr:hover {
            background: rgba(107, 168, 61, 0.05);
        }

        .user-cell {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .user-avatar-small {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            border: 2px solid var(--accent-green);
            object-fit: cover;
        }

        .user-info-small {
            display: flex;
            flex-direction: column;
        }

        .user-name-small {
            font-weight: 600;
            color: var(--text-primary);
        }

        .user-email-small {
            font-size: 0.85rem;
            color: var(--text-secondary);
        }

        /* Badge Styles */
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

        .badge-danger {
            background: rgba(220, 53, 69, 0.2);
            color: var(--danger);
        }

        .badge-warning {
            background: rgba(255, 193, 7, 0.2);
            color: var(--warning);
        }

        .badge-info {
            background: rgba(23, 162, 184, 0.2);
            color: var(--info);
        }

        .badge-admin {
            background: rgba(107, 168, 61, 0.2);
            color: var(--accent-green);
        }

        /* Action Buttons */
        .action-btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.85rem;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background: var(--accent-green);
            color: white;
        }

        .btn-primary:hover {
            background: var(--light-green);
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

        /* Quick Actions */
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .quick-action-btn {
            background: var(--card-bg);
            border: 2px solid var(--border-color);
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            color: var(--text-primary);
            text-decoration: none;
            transition: all 0.3s;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.75rem;
        }

        .quick-action-btn:hover {
            border-color: var(--accent-green);
            background: rgba(107, 168, 61, 0.1);
            transform: translateY(-3px);
        }

        .quick-action-btn i {
            font-size: 2rem;
            color: var(--accent-green);
        }

        /* Category List */
        .category-list {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            max-height: 400px;
            overflow-y: auto;
        }

        .category-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem;
            background: rgba(107, 168, 61, 0.05);
            border-radius: 8px;
            border: 1px solid var(--border-color);
        }

        .category-name {
            font-weight: 600;
            color: var(--text-primary);
        }

        .category-count {
            color: var(--text-secondary);
            font-size: 0.85rem;
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

        /* Responsive */
        @media (max-width: 1024px) {
            .content-grid {
                grid-template-columns: 1fr;
            }

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

            .stats-grid {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 1rem;
            }

            .stat-card {
                padding: 1rem;
            }

            .stat-value {
                font-size: 2rem;
            }

            .stat-icon {
                font-size: 2rem;
            }

            .admin-table {
                font-size: 0.9rem;
            }

            .admin-table th,
            .admin-table td {
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

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .stat-card {
                padding: 1rem;
            }

            .card-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }

            .quick-actions {
                grid-template-columns: repeat(2, 1fr);
            }

            /* Make tables scrollable on mobile */
            .admin-table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }

            .admin-table thead,
            .admin-table tbody,
            .admin-table tr {
                display: table;
                width: 100%;
                table-layout: fixed;
            }

            .user-cell {
                min-width: 150px;
            }

            .user-email-small {
                display: none;
            }

            .action-btn {
                padding: 0.4rem 0.6rem;
                font-size: 0.8rem;
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

            .stat-card {
                padding: 0.75rem;
            }

            .stat-value {
                font-size: 1.75rem;
            }

            .stat-icon {
                font-size: 1.75rem;
            }

            .stat-label {
                font-size: 0.85rem;
            }

            .admin-card {
                padding: 1rem;
            }

            .card-title {
                font-size: 1rem;
            }

            .quick-actions {
                grid-template-columns: 1fr;
            }

            .quick-action-btn {
                padding: 1rem;
            }

            .quick-action-btn i {
                font-size: 1.5rem;
            }

            .admin-table {
                font-size: 0.8rem;
            }

            .admin-table th,
            .admin-table td {
                padding: 0.5rem 0.25rem;
            }

            .user-avatar-small {
                width: 30px;
                height: 30px;
            }

            .badge {
                font-size: 0.65rem;
                padding: 0.2rem 0.5rem;
            }
        }

        @media (max-width: 360px) {
            .admin-container {
                padding: 0.5rem;
            }

            .stats-grid {
                gap: 0.75rem;
            }

            .stat-card {
                padding: 0.5rem;
            }

            .stat-value {
                font-size: 1.5rem;
            }

            .stat-icon {
                font-size: 1.5rem;
            }

            .admin-card {
                padding: 0.75rem;
            }

            .card-header {
                margin-bottom: 1rem;
                padding-bottom: 0.75rem;
            }

            .admin-table {
                font-size: 0.75rem;
            }

            .action-btn {
                padding: 0.3rem 0.5rem;
                font-size: 0.75rem;
            }
        }

        /* Scrollbar Styling */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--dark-bg);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--accent-green);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--light-green);
        }
    </style>
</head>
<body>
    <!-- Admin Header -->
    <header class="admin-header">
        <div class="admin-logo">
            <i class="fas fa-shield-alt"></i>
            <span>Farm Guide Admin</span>
        </div>
        <button class="mobile-menu-toggle" onclick="toggleMobileMenu()">
            <i class="fas fa-bars"></i>
        </button>
        <nav class="admin-nav" id="adminNav">
            <a href="{{ route('admin.dashboard') }}" class="active">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <a href="{{ route('admin.users') }}">
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

    <!-- Main Container -->
    <div class="admin-container">
        <!-- Statistics Grid -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon" style="color: #17a2b8;">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
                <div class="stat-value">{{ number_format($stats['total_users']) }}</div>
                <div class="stat-label">Total Users</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon" style="color: #42b72a;">
                        <i class="fas fa-user-check"></i>
                    </div>
                </div>
                <div class="stat-value">{{ number_format($stats['active_users']) }}</div>
                <div class="stat-label">Active Users (Online Now)</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon" style="color: #ffc107;">
                        <i class="fas fa-file-alt"></i>
                    </div>
                </div>
                <div class="stat-value">{{ number_format($stats['total_posts']) }}</div>
                <div class="stat-label">Total Posts</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon" style="color: #6ba83d;">
                        <i class="fas fa-comment"></i>
                    </div>
                </div>
                <div class="stat-value">{{ number_format($stats['total_comments']) }}</div>
                <div class="stat-label">Total Comments</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon" style="color: #dc3545;">
                        <i class="fas fa-calendar-day"></i>
                    </div>
                </div>
                <div class="stat-value">{{ number_format($stats['posts_today']) }}</div>
                <div class="stat-label">Posts Today</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon" style="color: #9b59b6;">
                        <i class="fas fa-user-plus"></i>
                    </div>
                </div>
                <div class="stat-value">{{ number_format($stats['new_users_this_month']) }}</div>
                <div class="stat-label">New Users This Month</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon" style="color: #e67e22;">
                        <i class="fas fa-tags"></i>
                    </div>
                </div>
                <div class="stat-value">{{ number_format($stats['total_categories']) }}</div>
                <div class="stat-label">Total Categories</div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="admin-card" style="margin-bottom: 2rem;">
            <div class="card-header">
                <h2 class="card-title">
                    <i class="fas fa-bolt"></i> Quick Actions
                </h2>
            </div>
            <div class="quick-actions">
                <a href="{{ route('admin.users') }}" class="quick-action-btn">
                    <i class="fas fa-user-cog"></i>
                    <span>Manage Users</span>
                </a>
                <a href="{{ route('admin.posts') }}" class="quick-action-btn">
                    <i class="fas fa-edit"></i>
                    <span>Manage Posts</span>
                </a>
                <a href="{{ route('admin.categories') }}" class="quick-action-btn">
                    <i class="fas fa-folder-plus"></i>
                    <span>Manage Categories</span>
                </a>
                <a href="{{ route('admin.reports') }}" class="quick-action-btn">
                    <i class="fas fa-chart-bar"></i>
                    <span>View Reports</span>
                </a>
            </div>
        </div>

        <!-- Content Grid -->
        <div class="content-grid">
            <!-- Recent Users -->
            <div class="admin-card">
                <div class="card-header">
                    <h2 class="card-title">
                        <i class="fas fa-user-friends"></i> Recent Users
                    </h2>
                    <a href="{{ route('admin.users') }}" class="view-all-btn">View All →</a>
                </div>
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Role</th>
                            <th>Joined</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentUsers as $user)
                        <tr>
                            <td>
                                <div class="user-cell">
                                    @if($user->profile_picture)
                                        <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="{{ $user->name }}" class="user-avatar-small">
                                    @else
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=6ba83d&color=fff" alt="{{ $user->name }}" class="user-avatar-small">
                                    @endif
                                    <div class="user-info-small">
                                        <span class="user-name-small">{{ $user->name }}</span>
                                        <span class="user-email-small">{{ $user->email }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($user->role === 'admin')
                                    <span class="badge badge-admin">Admin</span>
                                @else
                                    <span class="badge badge-info">User</span>
                                @endif
                            </td>
                            <td>{{ $user->created_at->diffForHumans() }}</td>
                            <td>
                                @if($user->isOnline())
                                    <span class="badge badge-success">Online</span>
                                @else
                                    <span class="badge badge-danger">Offline</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Categories Overview -->
            <div class="admin-card">
                <div class="card-header">
                    <h2 class="card-title">
                        <i class="fas fa-tags"></i> Categories
                    </h2>
                    <a href="{{ route('admin.categories') }}" class="view-all-btn">Manage →</a>
                </div>
                <div class="category-list">
                    @foreach($categories as $category)
                    <div class="category-item">
                        <span class="category-name">{{ $category->name }}</span>
                        <span class="category-count">{{ $category->posts_count }} posts</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Recent Posts -->
        <div class="admin-card">
            <div class="card-header">
                <h2 class="card-title">
                    <i class="fas fa-file-alt"></i> Recent Posts
                </h2>
                <a href="{{ route('admin.posts') }}" class="view-all-btn">View All →</a>
            </div>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Category</th>
                        <th>Engagement</th>
                        <th>Posted</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentPosts as $post)
                    <tr>
                        <td>
                            <strong>{{ Str::limit($post->title, 50) }}</strong>
                        </td>
                        <td>
                            <div class="user-cell">
                                @if($post->user->profile_picture)
                                    <img src="{{ asset('storage/' . $post->user->profile_picture) }}" alt="{{ $post->user->name }}" class="user-avatar-small">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($post->user->name) }}&background=6ba83d&color=fff" alt="{{ $post->user->name }}" class="user-avatar-small">
                                @endif
                                <span class="user-name-small">{{ $post->user->name }}</span>
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
                            <i class="fas fa-thumbs-up" style="color: var(--accent-green);"></i> {{ $post->likes_count }}
                            <i class="fas fa-comment" style="color: var(--info); margin-left: 0.5rem;"></i> {{ $post->comments_count }}
                        </td>
                        <td>{{ $post->created_at->diffForHumans() }}</td>
                        <td>
                            <a href="{{ route('user.profile', $post->userID) }}" class="action-btn btn-info" target="_blank">
                                <i class="fas fa-eye"></i> View
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
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
