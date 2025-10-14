<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $category->name }} - Farm Guide</title>
    <link rel="icon" type="image/png" href="{{ asset('logo2.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            /* Light theme variables */
            --bg-color: #f5f7fa;
            --bg-gradient: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            --navbar-bg: linear-gradient(135deg, #2d5016 0%, #4a7c23 100%);
            --text-color: #333;
            --card-bg: rgba(255,255,255,0.95);
            --card-border: rgba(255,255,255,0.2);
            --card-shadow: rgba(0,0,0,0.1);
            --card-hover-shadow: rgba(0,0,0,0.15);
            --welcome-bg: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            --welcome-text: #2d5016;
            --welcome-subtext: #666;
            --heading-color: #2d5016;
            --subheading-color: #4a7c23;
            --input-bg: #fff;
            --input-border: #ddd;
            --input-text: #333;
            --post-border: #f0f0f0;
            --post-hover-bg: rgba(74, 124, 35, 0.02);
            --post-meta-bg: rgba(74, 124, 35, 0.1);
            --post-meta-hover-bg: rgba(74, 124, 35, 0.15);
            --empty-state-color: #888;
            --empty-state-heading: #666;
            --empty-state-text: #999;
            --empty-state-icon: #ccc;
        }

        [data-theme="dark"] {
            /* Dark theme variables */
            --bg-color: #1a1a1a;
            --bg-gradient: linear-gradient(135deg, #1a1a1a 0%, #2d3748 100%);
            --navbar-bg: linear-gradient(135deg, #1a202c 0%, #2d3748 100%);
            --text-color: #e2e8f0;
            --card-bg: rgba(45, 55, 72, 0.9);
            --card-border: rgba(255,255,255,0.1);
            --card-shadow: rgba(0,0,0,0.3);
            --card-hover-shadow: rgba(0,0,0,0.4);
            --welcome-bg: linear-gradient(135deg, #2d3748 0%, #4a5568 100%);
            --welcome-text: #90c695;
            --welcome-subtext: #a0aec0;
            --heading-color: #90c695;
            --subheading-color: #a5d6aa;
            --input-bg: #2d3748;
            --input-border: #4a5568;
            --input-text: #e2e8f0;
            --post-border: #4a5568;
            --post-hover-bg: rgba(144, 198, 149, 0.05);
            --post-meta-bg: rgba(144, 198, 149, 0.15);
            --post-meta-hover-bg: rgba(144, 198, 149, 0.25);
            --empty-state-color: #a0aec0;
            --empty-state-heading: #cbd5e0;
            --empty-state-text: #718096;
            --empty-state-icon: #4a5568;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Open Sans', sans-serif;
            background: var(--bg-gradient);
            color: var(--text-color);
            line-height: 1.6;
            min-height: 100vh;
        }

        /* Navbar */
        .navbar {
            background: var(--navbar-bg);
            color: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav-left {
            display: flex;
            align-items: center;
        }

        .nav-left a {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: white;
        }

        .logo {
            height: 40px;
            margin-right: 10px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        }

        .nav-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .nav-button {
            background: rgba(255,255,255,0.15);
            border: 2px solid rgba(255,255,255,0.2);
            color: white;
            padding: 0.6rem 1.2rem;
            border-radius: 12px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            cursor: pointer;
        }

        .nav-button:hover {
            background: rgba(255,255,255,0.25);
            border-color: rgba(255,255,255,0.4);
            transform: translateY(-2px);
        }

        .nav-button.logout {
            background: rgba(220,53,69,0.2);
            border-color: rgba(220,53,69,0.3);
        }

        .nav-button.logout:hover {
            background: rgba(220,53,69,0.3);
            border-color: rgba(220,53,69,0.5);
        }

        /* Container */
        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 2rem;
            display: grid;
            grid-template-columns: 1fr 300px;
            gap: 2rem;
        }

        /* Cards */
        .card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 8px 32px var(--card-shadow);
            backdrop-filter: blur(20px);
            margin-bottom: 2rem;
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 12px 48px var(--card-hover-shadow);
            transform: translateY(-2px);
        }

        .card h2 {
            color: var(--heading-color);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1.4rem;
            font-weight: 700;
        }

        /* Topic Header */
        .topic-header {
            background: var(--welcome-bg);
            border: 1px solid var(--card-border);
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 8px 32px var(--card-shadow);
            backdrop-filter: blur(20px);
            margin-bottom: 2rem;
        }

        .topic-header h1 {
            color: var(--welcome-text);
            font-size: 2rem;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .topic-header p {
            color: var(--welcome-subtext);
            font-size: 1.1rem;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--subheading-color);
            text-decoration: none;
            margin-bottom: 1rem;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .back-link:hover {
            color: var(--heading-color);
        }

        /* Posts */
        .post {
            padding: 1.5rem 0;
            border-bottom: 2px solid var(--post-border);
            transition: all 0.3s ease;
        }

        .post:last-child {
            border-bottom: none;
        }

        .post:hover {
            background: var(--post-hover-bg);
            padding: 1.5rem;
            margin: 0 -1.5rem;
            border-radius: 12px;
        }

        .post-title {
            color: var(--heading-color);
            font-size: 1.2rem;
            margin-bottom: 0.75rem;
            font-weight: 600;
        }

        .post-content {
            color: var(--text-color);
            margin-bottom: 1rem;
            line-height: 1.7;
        }

        .post-images {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1rem;
            flex-wrap: wrap;
        }

        .post-image {
            width: 120px;
            height: 90px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid var(--card-border);
            transition: transform 0.3s ease;
        }

        .post-image:hover {
            transform: scale(1.05);
        }

        .post-meta {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            font-size: 0.9rem;
        }

        .post-meta span {
            color: var(--subheading-color);
            background: var(--post-meta-bg);
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            display: flex;
            align-items: center;
            gap: 0.3rem;
            font-weight: 500;
            transition: background 0.3s ease;
        }

        .post-meta span:hover {
            background: var(--post-meta-hover-bg);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem 2rem;
            color: var(--empty-state-color);
        }

        .empty-state i {
            font-size: 4rem;
            color: var(--empty-state-icon);
            margin-bottom: 1rem;
        }

        .empty-state h3 {
            color: var(--empty-state-heading);
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            color: var(--empty-state-text);
        }

        /* Sidebar */
        .sidebar-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 8px 32px var(--card-shadow);
            backdrop-filter: blur(20px);
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }

        .sidebar-card:hover {
            box-shadow: 0 12px 48px var(--card-hover-shadow);
            transform: translateY(-2px);
        }

        .sidebar-card h3 {
            color: var(--heading-color);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1.1rem;
            font-weight: 600;
        }

        .sidebar-list {
            list-style: none;
        }

        .sidebar-list li {
            margin-bottom: 0.5rem;
        }

        .sidebar-list a {
            color: var(--text-color);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .sidebar-list a:hover {
            background: var(--post-hover-bg);
            color: var(--subheading-color);
        }

        /* Pagination */
        .pagination-wrapper {
            margin-top: 2rem;
            display: flex;
            justify-content: center;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .container {
                grid-template-columns: 1fr;
                margin: 1rem auto;
                padding: 0 1rem;
                gap: 1rem;
            }

            .navbar {
                padding: 1rem;
                flex-direction: column;
                gap: 1rem;
            }

            .nav-right {
                width: 100%;
                justify-content: center;
            }

            .topic-header h1 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="nav-left">
            <a href="{{ route('dashboard') }}">
                <img src="{{ asset('logo2.png') }}" alt="Farm Guide Logo" class="logo">
                <span class="nav-title">Farm Guide</span>
            </a>
        </div>

        <div class="nav-right">
            <a href="{{ route('logout.get') }}" class="nav-button logout" title="Sign out">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </div>
    </nav>

    <div class="container">
        <div class="main-content">
            <!-- Back Link -->
            <a href="{{ route('dashboard') }}" class="back-link">
                <i class="fas fa-arrow-left"></i>
                Back to Dashboard
            </a>

            <!-- Topic Header -->
            <div class="topic-header">
                <h1><i class="fas fa-seedling"></i> {{ $category->name }}</h1>
                <p>Explore questions and discussions about {{ $category->name }}</p>
            </div>

            <!-- Posts -->
            <div class="card">
                <h2><i class="fas fa-comments"></i> Questions in {{ $category->name }}</h2>

                @forelse($posts as $post)
                    <div class="post">
                        <h3 class="post-title">{{ $post->title }}</h3>
                        <p class="post-content">{{ Str::limit($post->content, 200) }}</p>

                        @if($post->imgSrc && count(json_decode($post->imgSrc, true)) > 0)
                            <div class="post-images">
                                @foreach(array_slice(json_decode($post->imgSrc, true), 0, 3) as $image)
                                    <img src="{{ asset('storage/' . $image) }}" alt="Post image" class="post-image">
                                @endforeach
                            </div>
                        @endif

                        <div class="post-meta">
                            <span><i class="fas fa-user"></i> {{ $post->user->name }}</span>
                            <span><i class="fas fa-comments"></i> {{ $post->comments->count() }} answers</span>
                            <span><i class="fas fa-clock"></i> {{ $post->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <i class="fas fa-seedling"></i>
                        <h3>No questions yet in {{ $category->name }}</h3>
                        <p>Be the first to ask a question about {{ $category->name }}!</p>
                        <br>
                        <a href="{{ route('dashboard') }}" class="nav-button">
                            <i class="fas fa-plus"></i>
                            Ask the First Question
                        </a>
                    </div>
                @endforelse

                @if($posts->hasPages())
                    <div class="pagination-wrapper">
                        {{ $posts->links() }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Related Topics -->
            <div class="sidebar-card">
                <h3><i class="fas fa-list"></i> Other Topics</h3>
                <ul class="sidebar-list">
                    @foreach($categories->where('CategoryID', '!=', $category->CategoryID)->take(6) as $otherCategory)
                        <li><a href="{{ route('topics.show', \Illuminate\Support\Str::slug($otherCategory->name)) }}"><i class="fas fa-seedling"></i> {{ $otherCategory->name }}</a></li>
                    @endforeach
                </ul>
            </div>

            <!-- Quick Actions -->
            <div class="sidebar-card">
                <h3><i class="fas fa-link"></i> Quick Actions</h3>
                <ul class="sidebar-list">
                    <li><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li><a href="{{ route('profile.edit') }}"><i class="fas fa-user"></i> My Profile</a></li>
                    <li><a href="{{ route('friends') }}"><i class="fas fa-users"></i> Friends</a></li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        // Load saved theme preference and apply it immediately
        const savedTheme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-theme', savedTheme);

        // Listen for storage changes from other tabs/pages
        window.addEventListener('storage', function(e) {
            if (e.key === 'theme') {
                document.documentElement.setAttribute('data-theme', e.newValue);
            }
        });
    </script>
</body>
</html>
