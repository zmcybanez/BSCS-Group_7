<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Friends & Network - Farm Guide</title>
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
            --search-bg: rgba(255,255,255,0.2);
            --search-text: #fff;
            --search-placeholder: rgba(255,255,255,0.7);
            --search-focus-bg: rgba(255,255,255,0.3);
            --search-icon: rgba(255,255,255,0.8);
            --heading-color: #2d5016;
            --subheading-color: #4a7c23;
            --input-bg: #fff;
            --input-border: #ddd;
            --input-text: #333;
            --secondary-navbar-bg: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            --secondary-nav-button-bg: #ffffff;
            --secondary-nav-button-border: rgba(77, 124, 35, 0.15);
            --secondary-nav-button-color: #4a7c23;
            --secondary-nav-button-hover-bg: rgba(77, 124, 35, 0.08);
            --secondary-nav-button-active-bg: rgba(77, 124, 35, 0.12);
            --secondary-nav-shadow: rgba(0,0,0,0.08);
            --post-border: #f0f0f0;
            --post-hover-bg: rgba(74, 124, 35, 0.02);
            --post-meta-bg: rgba(74, 124, 35, 0.1);
            --post-meta-hover-bg: rgba(74, 124, 35, 0.15);
            --empty-state-color: #888;
            --empty-state-heading: #666;
            --empty-state-text: #999;
            --empty-state-icon: #ccc;
            --btn-primary-bg: #4a7c23;
            --btn-primary-hover: #3a6319;
            --btn-secondary-bg: #6c757d;
            --btn-secondary-hover: #545b62;
            --secondary-text: #666;
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
            --search-bg: rgba(45, 55, 72, 0.6);
            --search-text: #e2e8f0;
            --search-placeholder: rgba(226, 232, 240, 0.7);
            --search-focus-bg: rgba(45, 55, 72, 0.8);
            --search-icon: rgba(226, 232, 240, 0.8);
            --heading-color: #90c695;
            --subheading-color: #a5d6aa;
            --input-bg: #2d3748;
            --input-border: #4a5568;
            --input-text: #e2e8f0;
            --secondary-navbar-bg: linear-gradient(135deg, #2d3748 0%, #4a5568 100%);
            --secondary-nav-button-bg: #4a5568;
            --secondary-nav-button-border: rgba(144, 198, 149, 0.2);
            --secondary-nav-button-color: #90c695;
            --secondary-nav-button-hover-bg: rgba(144, 198, 149, 0.15);
            --secondary-nav-button-active-bg: rgba(144, 198, 149, 0.25);
            --secondary-nav-shadow: rgba(0,0,0,0.3);
            --post-border: #4a5568;
            --post-hover-bg: rgba(144, 198, 149, 0.05);
            --post-meta-bg: rgba(144, 198, 149, 0.15);
            --post-meta-hover-bg: rgba(144, 198, 149, 0.25);
            --empty-state-color: #a0aec0;
            --empty-state-heading: #cbd5e0;
            --empty-state-text: #718096;
            --empty-state-icon: #4a5568;
            --btn-primary-bg: #90c695;
            --btn-primary-hover: #7ab087;
            --btn-secondary-bg: #4a5568;
            --btn-secondary-hover: #3a424f;
            --secondary-text: #a0aec0;
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

        /* Search Container */
        .search-container {
            position: relative;
            max-width: 400px;
            margin-right: 1rem;
            min-width: 200px;
        }

        .search-bar {
            width: 100%;
            padding: 0.7rem 1rem 0.7rem 2.5rem;
            border: 2px solid var(--search-bg);
            border-radius: 25px;
            background: var(--search-bg);
            color: var(--search-text);
            font-size: 0.95rem;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .search-bar::placeholder {
            color: var(--search-placeholder);
        }

        .search-bar:focus {
            outline: none;
            background: var(--search-focus-bg);
            border-color: rgba(255,255,255,0.4);
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--search-icon);
            font-size: 1rem;
            z-index: 1;
        }

        /* Global Search Dropdown */
        .search-dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.15);
            z-index: 999;
            display: none;
            margin-top: 0.5rem;
            backdrop-filter: blur(20px);
            max-height: 400px;
            overflow-y: auto;
        }

        .search-dropdown.show {
            display: block;
        }

        .search-section {
            border-bottom: 1px solid var(--card-border);
        }

        .search-section:last-child {
            border-bottom: none;
        }

        .search-section-header {
            padding: 0.75rem 1rem;
            background: rgba(74, 124, 35, 0.05);
            font-weight: 600;
            color: var(--subheading-color);
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .search-result-item {
            padding: 0.75rem 1rem;
            cursor: pointer;
            transition: background 0.2s ease;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .search-result-item:hover {
            background: var(--post-hover-bg);
        }

        .search-result-icon {
            color: var(--subheading-color);
            width: 20px;
            text-align: center;
        }

        .search-result-content {
            flex: 1;
        }

        .search-result-title {
            font-weight: 600;
            color: var(--text-color);
            font-size: 0.95rem;
        }

        .search-result-description {
            color: var(--secondary-text);
            font-size: 0.8rem;
            margin-top: 0.2rem;
        }

        /* Notifications Dropdown */
        .notifications-container {
            position: relative;
            display: inline-block;
        }

        .notifications-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.15), 0 0 0 1px rgba(255,255,255,0.1);
            width: 350px;
            max-height: 450px;
            overflow: hidden;
            z-index: 1000;
            display: none;
            margin-top: 0.75rem;
            backdrop-filter: blur(25px);
            transform: translateY(-10px) scale(0.95);
            opacity: 0;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .notifications-dropdown::before {
            content: '';
            position: absolute;
            top: -8px;
            right: 20px;
            width: 16px;
            height: 16px;
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-bottom: none;
            border-right: none;
            transform: rotate(45deg);
            z-index: -1;
        }

        .notifications-dropdown.show {
            display: block;
            transform: translateY(0) scale(1);
            opacity: 1;
        }

        .notifications-header {
            padding: 1.25rem 1.75rem;
            border-bottom: 1px solid var(--card-border);
            font-weight: 700;
            color: var(--heading-color);
            font-size: 1.1rem;
            background: linear-gradient(135deg, var(--card-bg), rgba(74, 124, 35, 0.02));
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .notifications-header i {
            color: var(--subheading-color);
            font-size: 1.2rem;
        }

        .empty-notifications {
            text-align: center;
            padding: 3rem 2rem;
            color: var(--empty-state-text);
        }

        .empty-notifications i {
            font-size: 3rem;
            color: var(--empty-state-icon);
            margin-bottom: 1rem;
            opacity: 0.6;
        }

        .empty-notifications > div:first-child {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 0.6; }
            50% { opacity: 0.3; }
        }

        /* Secondary Navbar */
        .secondary-navbar {
            background: var(--secondary-navbar-bg);
            padding: 1rem 2rem;
            display: flex;
            justify-content: center;
            gap: 1rem;
            box-shadow: 0 2px 16px var(--secondary-nav-shadow);
            border-bottom: 1px solid var(--card-border);
            backdrop-filter: blur(20px);
            position: sticky;
            top: 73px;
            z-index: 999;
        }

        .secondary-navbar .nav-button {
            background: var(--secondary-nav-button-bg);
            border: 2px solid var(--secondary-nav-button-border);
            color: var(--secondary-nav-button-color);
            padding: 0.7rem 1.5rem;
            border-radius: 25px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .secondary-navbar .nav-button:hover {
            background: var(--secondary-nav-button-hover-bg);
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(0,0,0,0.15);
        }

        .secondary-navbar .nav-button.active {
            background: var(--secondary-nav-button-active-bg);
            border-color: var(--subheading-color);
            color: var(--heading-color);
            font-weight: 700;
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

        /* Friends specific styles */
        .friend-item {
            display: flex;
            align-items: center;
            padding: 1rem;
            border-bottom: 1px solid var(--post-border);
            transition: all 0.3s ease;
            border-radius: 8px;
            margin-bottom: 0.5rem;
        }

        .friend-item:hover {
            background: var(--post-hover-bg);
        }

        .friend-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--subheading-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            margin-right: 1rem;
            font-size: 1.2rem;
        }

        .friend-info {
            flex: 1;
        }

        .friend-name {
            font-weight: 600;
            color: var(--heading-color);
            margin-bottom: 0.25rem;
        }

        .friend-status {
            font-size: 0.85rem;
            color: var(--welcome-subtext);
        }

        .friend-actions {
            display: flex;
            gap: 0.5rem;
        }

        .btn {
            background: var(--btn-primary-bg);
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            cursor: pointer;
            font-size: 0.85rem;
            font-weight: 600;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .btn:hover {
            background: var(--btn-primary-hover);
            transform: translateY(-1px);
        }

        .btn.secondary {
            background: var(--btn-secondary-bg);
        }

        .btn.secondary:hover {
            background: var(--btn-secondary-hover);
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

            .secondary-navbar {
                padding: 1rem;
                overflow-x: auto;
                white-space: nowrap;
                top: 120px;
            }

            .nav-right {
                width: 100%;
                justify-content: center;
            }

            .friend-item {
                flex-direction: column;
                text-align: center;
                padding: 1.5rem 1rem;
            }

            .friend-avatar {
                margin: 0 0 1rem 0;
            }

            .friend-actions {
                margin-top: 1rem;
                justify-content: center;
            }
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card, .sidebar-card {
            animation: fadeInUp 0.6s ease forwards;
        }

        .card:nth-child(2) { animation-delay: 0.1s; }
        .card:nth-child(3) { animation-delay: 0.2s; }
        .sidebar-card:nth-child(1) { animation-delay: 0.3s; }
        .sidebar-card:nth-child(2) { animation-delay: 0.4s; }
    </style>
</head>
<body>

    <!-- FIXED NAVBAR -->
    <nav class="navbar">
        <div class="nav-left">
            <a href="{{ route('dashboard') }}">
                <img src="{{ asset('logo2.png') }}" alt="Farm Guide Logo" class="logo">
                <span class="nav-title">Farm Guide</span>
            </a>
        </div>

        <div class="nav-right">
            <!-- Search Bar -->
            <div class="search-container">
                <i class="fas fa-search search-icon"></i>
                <input type="text" class="search-bar" id="searchInput" placeholder="Search anything...">
                <div class="search-dropdown" id="searchDropdown">
                    <div class="search-section">
                        <div class="search-section-header">Search Users</div>
                        <div class="search-result-item">
                            <i class="fas fa-user search-result-icon"></i>
                            <div class="search-result-content">
                                <div class="search-result-title">John Smith</div>
                                <div class="search-result-description">Organic farming specialist • 500+ posts</div>
                            </div>
                        </div>
                        <div class="search-result-item">
                            <i class="fas fa-user search-result-icon"></i>
                            <div class="search-result-content">
                                <div class="search-result-title">Maria Garcia</div>
                                <div class="search-result-description">Sustainable agriculture expert • 320+ posts</div>
                            </div>
                        </div>
                        <div class="search-result-item">
                            <i class="fas fa-user search-result-icon"></i>
                            <div class="search-result-content">
                                <div class="search-result-title">David Chen</div>
                                <div class="search-result-description">Crop rotation specialist • 250+ posts</div>
                            </div>
                        </div>
                    </div>
                    <div class="search-section">
                        <div class="search-section-header">Recent Posts</div>
                        <div class="search-result-item">
                            <i class="fas fa-leaf search-result-icon"></i>
                            <div class="search-result-content">
                                <div class="search-result-title">Best Organic Fertilizers for Tomatoes</div>
                                <div class="search-result-description">By John Smith • 2 hours ago • 15 likes</div>
                            </div>
                        </div>
                        <div class="search-result-item">
                            <i class="fas fa-seedling search-result-icon"></i>
                            <div class="search-result-content">
                                <div class="search-result-title">Water Conservation Tips for Dry Seasons</div>
                                <div class="search-result-description">By Maria Garcia • 5 hours ago • 28 likes</div>
                            </div>
                        </div>
                        <div class="search-result-item">
                            <i class="fas fa-tractor search-result-icon"></i>
                            <div class="search-result-content">
                                <div class="search-result-title">Equipment Maintenance Guide</div>
                                <div class="search-result-description">By David Chen • 1 day ago • 42 likes</div>
                            </div>
                        </div>
                    </div>
                    <div class="search-section">
                        <div class="search-section-header">Navigation</div>
                        <div class="search-result-item" onclick="window.location.href='{{ route('dashboard') }}'">
                            <i class="fas fa-home search-result-icon"></i>
                            <div class="search-result-content">
                                <div class="search-result-title">Dashboard</div>
                                <div class="search-result-description">View your farming dashboard and posts</div>
                            </div>
                        </div>
                        <div class="search-result-item" onclick="window.location.href='{{ route('profile.edit') }}'">
                            <i class="fas fa-user search-result-icon"></i>
                            <div class="search-result-content">
                                <div class="search-result-title">Profile Settings</div>
                                <div class="search-result-description">Manage your account and preferences</div>
                            </div>
                        </div>
                    </div>
                    <div class="search-section">
                        <div class="search-section-header">Friends Actions</div>
                        <div class="search-result-item">
                            <i class="fas fa-user-friends search-result-icon"></i>
                            <div class="search-result-content">
                                <div class="search-result-title">Find Friends</div>
                                <div class="search-result-description">Connect with other farmers</div>
                            </div>
                        </div>
                        <div class="search-result-item">
                            <i class="fas fa-star search-result-icon"></i>
                            <div class="search-result-content">
                                <div class="search-result-title">Expert Farmers</div>
                                <div class="search-result-description">Learn from experienced professionals</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="notifications-container">
                <button type="button" class="nav-button" id="notificationsToggle">
                    <i class="fas fa-bell"></i>
                </button>
                <div class="notifications-dropdown" id="notificationsDropdown">
                    <div class="notifications-header">
                        <i class="fas fa-bell"></i> Notifications
                    </div>
                    <div class="empty-notifications">
                        <div><i class="fas fa-bell-slash"></i></div>
                        <div>No notifications yet</div>
                        <div style="font-size: 0.8rem; margin-top: 0.5rem;">You'll see notifications here when you have them</div>
                    </div>
                </div>
            </div>

            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="nav-button logout">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </form>
        </div>
    </nav>

    <!-- Secondary Navbar -->
    <div class="secondary-navbar">
        <a href="{{ route('dashboard') }}" class="nav-button">
            <i class="fas fa-home"></i>
            <span>Dashboard</span>
        </a>
        <button id="darkModeToggle" class="nav-button">
            <i class="fas fa-moon"></i>
            <span>Dark Mode</span>
        </button>
        <a href="{{ route('friends') }}" class="nav-button active">
            <i class="fas fa-users"></i>
            <span>Friends</span>
        </a>
        <a href="{{ route('profile.edit') }}" class="nav-button">
            <i class="fas fa-user"></i>
            <span>Profile</span>
        </a>
    </div>

    <div class="container">
        <div class="main-content">
            <!-- Page Header -->
            <div class="card">
                <h2><i class="fas fa-users"></i> Friends & Network</h2>
                <p style="color: var(--welcome-subtext); margin-bottom: 1rem;">Connect with fellow farmers and agricultural experts in your community.</p>
            </div>

            <!-- Friend Requests -->
            <div class="card">
                <h2><i class="fas fa-user-plus"></i> Friend Requests</h2>
                @if(isset($friendRequests) && $friendRequests->count() > 0)
                    @foreach($friendRequests as $request)
                        <div class="friend-item">
                            <div class="friend-avatar">
                                {{ substr($request->name ?? 'U', 0, 1) }}
                            </div>
                            <div class="friend-info">
                                <div class="friend-name">{{ $request->name ?? 'Unknown User' }}</div>
                                <div class="friend-status">Sent you a friend request</div>
                            </div>
                            <div class="friend-actions">
                                <form action="{{ route('friends.accept') }}" method="POST" style="display: inline;">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ $request->UserID }}">
                                    <button type="submit" class="btn">
                                        <i class="fas fa-check"></i>
                                        Accept
                                    </button>
                                </form>
                                <form action="{{ route('friends.reject') }}" method="POST" style="display: inline;">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ $request->UserID }}">
                                    <button type="submit" class="btn secondary">
                                        <i class="fas fa-times"></i>
                                        Decline
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="empty-state">
                        <i class="fas fa-user-plus"></i>
                        <h3>No friend requests</h3>
                        <p>You don't have any pending friend requests at the moment.</p>
                    </div>
                @endif
            </div>

            <!-- My Friends -->
            <div class="card">
                <h2><i class="fas fa-user-friends"></i> My Friends</h2>
                @if(isset($friends) && $friends->count() > 0)
                    @foreach($friends as $friend)
                        <div class="friend-item">
                            <div class="friend-avatar">
                                {{ substr($friend->name ?? 'U', 0, 1) }}
                            </div>
                            <div class="friend-info">
                                <div class="friend-name">{{ $friend->name ?? 'Unknown User' }}</div>
                                <div class="friend-status">Connected farmer</div>
                            </div>
                            <div class="friend-actions">
                                <button class="btn" onclick="alert('Messaging feature coming soon!')">
                                    <i class="fas fa-comment"></i>
                                    Message
                                </button>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="empty-state">
                        <i class="fas fa-user-friends"></i>
                        <h3>No friends yet</h3>
                        <p>Start connecting with other farmers in your community!</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Quick Actions -->
            <div class="sidebar-card">
                <h3><i class="fas fa-plus-circle"></i> Find Friends</h3>
                <ul class="sidebar-list">
                    <li><a href="#" onclick="alert('Search feature coming soon!')"><i class="fas fa-search"></i> Search Users</a></li>
                    <li><a href="#" onclick="alert('Suggestions feature coming soon!')"><i class="fas fa-lightbulb"></i> Friend Suggestions</a></li>
                    <li><a href="#" onclick="alert('Invite feature coming soon!')"><i class="fas fa-envelope"></i> Invite Friends</a></li>
                </ul>
            </div>

            <!-- Quick Actions -->
            <div class="sidebar-card">
                <h3><i class="fas fa-link"></i> Quick Actions</h3>
                <ul class="sidebar-list">
                    <li><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li><a href="{{ route('profile.edit') }}"><i class="fas fa-user"></i> My Profile</a></li>
                    <li><a href="#" onclick="alert('Feature coming soon!')"><i class="fas fa-chart-line"></i> Activity Feed</a></li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        const darkModeToggle = document.getElementById('darkModeToggle');

        // Load saved preference
        const savedTheme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-theme', savedTheme);

        // Update toggle button text based on current theme
        if (savedTheme === 'dark') {
            darkModeToggle.innerHTML = '<i class="fas fa-sun"></i> <span>Light Mode</span>';
        } else {
            darkModeToggle.innerHTML = '<i class="fas fa-moon"></i> <span>Dark Mode</span>';
        }

        darkModeToggle.addEventListener('click', function() {
            const currentTheme = document.documentElement.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

            document.documentElement.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);

            if (newTheme === 'dark') {
                this.innerHTML = '<i class="fas fa-sun"></i> <span>Light Mode</span>';
            } else {
                this.innerHTML = '<i class="fas fa-moon"></i> <span>Dark Mode</span>';
            }
        });

        // Notifications dropdown functionality
        const notificationsToggle = document.getElementById('notificationsToggle');
        const notificationsDropdown = document.getElementById('notificationsDropdown');

        notificationsToggle.addEventListener('click', function(e) {
            e.stopPropagation();

            if (notificationsDropdown.classList.contains('show')) {
                // Closing
                notificationsDropdown.style.transform = 'translateY(-10px) scale(0.95)';
                notificationsDropdown.style.opacity = '0';
                setTimeout(() => {
                    notificationsDropdown.classList.remove('show');
                }, 200);
            } else {
                // Opening
                notificationsDropdown.classList.add('show');
                // Trigger reflow
                notificationsDropdown.offsetHeight;
                notificationsDropdown.style.transform = 'translateY(0) scale(1)';
                notificationsDropdown.style.opacity = '1';
            }
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!notificationsToggle.contains(e.target) && !notificationsDropdown.contains(e.target)) {
                if (notificationsDropdown.classList.contains('show')) {
                    notificationsDropdown.style.transform = 'translateY(-10px) scale(0.95)';
                    notificationsDropdown.style.opacity = '0';
                    setTimeout(() => {
                        notificationsDropdown.classList.remove('show');
                    }, 200);
                }
            }
        });

        // Prevent dropdown from closing when clicking inside it
        notificationsDropdown.addEventListener('click', function(e) {
            e.stopPropagation();
        });

        // Global Search functionality
        const searchInput = document.getElementById('searchInput');
        const searchDropdown = document.getElementById('searchDropdown');

        searchInput.addEventListener('focus', function() {
            searchDropdown.classList.add('show');
        });

        searchInput.addEventListener('blur', function() {
            // Delay hiding to allow clicks on dropdown items
            setTimeout(() => {
                searchDropdown.classList.remove('show');
            }, 200);
        });

        searchInput.addEventListener('input', function() {
            const query = this.value.toLowerCase();
            const items = searchDropdown.querySelectorAll('.search-result-item');

            items.forEach(item => {
                const title = item.querySelector('.search-result-title').textContent.toLowerCase();
                const description = item.querySelector('.search-result-description').textContent.toLowerCase();

                if (title.includes(query) || description.includes(query) || query === '') {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            });
        });

        // Close search dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!searchInput.contains(e.target) && !searchDropdown.contains(e.target)) {
                searchDropdown.classList.remove('show');
            }
        });
    </script>
</body>
</html>
