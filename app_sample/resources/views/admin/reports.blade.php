<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports & Analytics - Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
            margin-bottom: 2rem;
        }
        .page-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--accent-green);
        }
        .reports-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }
        .report-card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 1.5rem;
        }
        .report-card.full-width {
            grid-column: 1 / -1;
        }
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        .card-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .card-icon {
            color: var(--accent-green);
        }
        .chart-container {
            position: relative;
            height: 300px;
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
        }
        .data-table th {
            text-align: left;
            padding: 0.75rem;
            color: var(--text-secondary);
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            border-bottom: 2px solid var(--border-color);
        }
        .data-table td {
            padding: 0.75rem;
            border-bottom: 1px solid var(--border-color);
        }
        .data-table tr:hover {
            background: rgba(107, 168, 61, 0.05);
        }
        .user-cell {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .user-avatar {
            width: 40px;
            height: 40px;
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
        .stat-badge {
            background: rgba(107, 168, 61, 0.2);
            color: var(--accent-green);
            padding: 0.25rem 0.75rem;
            border-radius: 12px;
            font-size: 0.85rem;
            font-weight: 600;
        }
        .progress-bar {
            width: 100%;
            height: 8px;
            background: var(--border-color);
            border-radius: 4px;
            overflow: hidden;
            margin-top: 0.5rem;
        }
        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--accent-green), var(--light-green));
            transition: width 0.3s;
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
            .stats-grid {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            }
            .charts-grid {
                grid-template-columns: 1fr;
            }
            .chart-card {
                padding: 1rem;
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
            .stats-grid {
                grid-template-columns: 1fr;
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
            .chart-card {
                padding: 0.75rem;
            }
            .card-title {
                font-size: 1rem;
            }
            .list-item {
                padding: 0.75rem;
            }
            .stat-badge {
                font-size: 0.75rem;
                padding: 0.2rem 0.5rem;
            }
        }

        @media (max-width: 360px) {
            .admin-container {
                padding: 0.5rem;
            }
            .stat-card {
                padding: 0.5rem;
            }
            .stat-value {
                font-size: 1.25rem;
            }
            .chart-card {
                padding: 0.5rem;
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
            <a href="{{ route('admin.categories') }}"><i class="fas fa-tags"></i> Categories</a>
            <a href="{{ route('admin.reports') }}" class="active"><i class="fas fa-chart-line"></i> Reports</a>
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
            <h1 class="page-title"><i class="fas fa-chart-line"></i> Reports & Analytics</h1>
        </div>

        <div class="reports-grid">
            <!-- User Growth Chart -->
            <div class="report-card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-users card-icon"></i>
                        User Growth (Last 12 Months)
                    </h3>
                </div>
                <div class="chart-container">
                    <canvas id="userGrowthChart"></canvas>
                </div>
            </div>

            <!-- Post Activity Chart -->
            <div class="report-card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-file-alt card-icon"></i>
                        Post Activity (Last 30 Days)
                    </h3>
                </div>
                <div class="chart-container">
                    <canvas id="postActivityChart"></canvas>
                </div>
            </div>

            <!-- Top Contributors -->
            <div class="report-card full-width">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-trophy card-icon"></i>
                        Top Contributors
                    </h3>
                </div>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Rank</th>
                            <th>User</th>
                            <th>Posts</th>
                            <th>Comments</th>
                            <th>Total Contributions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($topContributors as $index => $contributor)
                        <tr>
                            <td>
                                @if($index == 0)
                                    <i class="fas fa-crown" style="color: #ffd700; font-size: 1.2rem;"></i>
                                @elseif($index == 1)
                                    <i class="fas fa-crown" style="color: #c0c0c0; font-size: 1.1rem;"></i>
                                @elseif($index == 2)
                                    <i class="fas fa-crown" style="color: #cd7f32; font-size: 1rem;"></i>
                                @else
                                    #{{ $index + 1 }}
                                @endif
                            </td>
                            <td>
                                <div class="user-cell">
                                    @if($contributor->profile_picture)
                                        <img src="{{ asset('storage/' . $contributor->profile_picture) }}" alt="{{ $contributor->name }}" class="user-avatar">
                                    @else
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($contributor->name) }}&background=6ba83d&color=fff" alt="{{ $contributor->name }}" class="user-avatar">
                                    @endif
                                    <div class="user-info">
                                        <span class="user-name">{{ $contributor->name }}</span>
                                        <span class="user-email">{{ $contributor->email }}</span>
                                    </div>
                                </div>
                            </td>
                            <td><span class="stat-badge">{{ $contributor->posts_count }}</span></td>
                            <td><span class="stat-badge">{{ $contributor->comments_count }}</span></td>
                            <td>
                                <strong>{{ $contributor->posts_count + $contributor->comments_count }}</strong>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 2rem; color: var(--text-secondary);">
                                No contributor data available
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Category Distribution -->
            <div class="report-card full-width">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-pie card-icon"></i>
                        Category Distribution
                    </h3>
                </div>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Posts</th>
                            <th>Percentage</th>
                            <th>Activity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalPosts = $categoryDistribution->sum('posts_count');
                        @endphp
                        @forelse($categoryDistribution as $category)
                        <tr>
                            <td><strong>{{ $category->name }}</strong></td>
                            <td><span class="stat-badge">{{ $category->posts_count }}</span></td>
                            <td>{{ $totalPosts > 0 ? number_format(($category->posts_count / $totalPosts) * 100, 1) : 0 }}%</td>
                            <td>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: {{ $totalPosts > 0 ? ($category->posts_count / $totalPosts) * 100 : 0 }}%"></div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="text-align: center; padding: 2rem; color: var(--text-secondary);">
                                No category data available
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // User Growth Chart
        const userGrowthData = @json($userGrowth);
        const userGrowthLabels = userGrowthData.map(item => {
            const [year, month] = item.month.split('-');
            const date = new Date(year, month - 1);
            return date.toLocaleDateString('en-US', { month: 'short', year: 'numeric' });
        });
        const userGrowthCounts = userGrowthData.map(item => item.count);

        new Chart(document.getElementById('userGrowthChart'), {
            type: 'line',
            data: {
                labels: userGrowthLabels,
                datasets: [{
                    label: 'New Users',
                    data: userGrowthCounts,
                    borderColor: '#6ba83d',
                    backgroundColor: 'rgba(107, 168, 61, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { color: '#b0b3b8' },
                        grid: { color: 'rgba(255,255,255,0.1)' }
                    },
                    x: {
                        ticks: { color: '#b0b3b8' },
                        grid: { color: 'rgba(255,255,255,0.1)' }
                    }
                }
            }
        });

        // Post Activity Chart
        const postActivityData = @json($postActivity);
        const postActivityLabels = postActivityData.map(item => {
            const date = new Date(item.date);
            return date.toLocaleDateString('en-US', { month: 'short', day: 'numeric' });
        });
        const postActivityCounts = postActivityData.map(item => item.count);

        new Chart(document.getElementById('postActivityChart'), {
            type: 'bar',
            data: {
                labels: postActivityLabels,
                datasets: [{
                    label: 'Posts',
                    data: postActivityCounts,
                    backgroundColor: '#6ba83d'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#b0b3b8',
                            stepSize: 1
                        },
                        grid: { color: 'rgba(255,255,255,0.1)' }
                    },
                    x: {
                        ticks: {
                            color: '#b0b3b8',
                            maxRotation: 45,
                            minRotation: 45
                        },
                        grid: { display: false }
                    }
                }
            }
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
