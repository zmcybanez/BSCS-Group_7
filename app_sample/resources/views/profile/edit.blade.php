<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - Farm Guide</title>
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
            --muted-text: #888;
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
            --muted-text: #718096;
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

        .search-no-results {
            padding: 2rem;
            text-align: center;
            color: var(--empty-state-text);
        }

        .search-no-results i {
            font-size: 2rem;
            color: var(--empty-state-icon);
            margin-bottom: 0.5rem;
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
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.15);
            width: 320px;
            max-height: 400px;
            overflow-y: auto;
            z-index: 1000;
            display: none;
            margin-top: 0.5rem;
            backdrop-filter: blur(20px);
        }

        .notifications-dropdown.show {
            display: block;
        }

        .notifications-header {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--card-border);
            font-weight: 600;
            color: var(--heading-color);
            font-size: 1.1rem;
        }

        .notification-item {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--card-border);
            transition: background 0.2s ease;
            cursor: pointer;
        }

        .notification-item:hover {
            background: var(--post-hover-bg);
        }

        .notification-item:last-child {
            border-bottom: none;
        }

        .notification-content {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
        }

        .notification-icon {
            color: var(--subheading-color);
            font-size: 1.2rem;
            margin-top: 0.2rem;
        }

        .notification-text {
            flex: 1;
        }

        .notification-title {
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 0.25rem;
        }

        .notification-description {
            color: var(--secondary-text);
            font-size: 0.9rem;
            line-height: 1.4;
        }

        .notification-time {
            color: var(--muted-text);
            font-size: 0.8rem;
            margin-top: 0.5rem;
        }

        .empty-notifications {
            text-align: center;
            padding: 2rem 1.5rem;
            color: var(--empty-state-text);
        }

        .empty-notifications i {
            font-size: 2rem;
            color: var(--empty-state-icon);
            margin-bottom: 0.5rem;
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
        .card, .welcome-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 8px 32px var(--card-shadow);
            backdrop-filter: blur(20px);
            margin-bottom: 2rem;
            transition: all 0.3s ease;
        }

        .card:hover, .welcome-card:hover {
            box-shadow: 0 12px 48px var(--card-hover-shadow);
            transform: translateY(-2px);
        }

        .welcome-card {
            background: var(--welcome-bg);
            text-align: center;
            padding: 3rem 2rem 2rem;
        }

        .welcome-card h1 {
            color: var(--welcome-text);
            font-size: 2.5rem;
            margin-bottom: 1rem;
            font-weight: 700;
        }

        .welcome-card p {
            color: var(--welcome-subtext);
            font-size: 1.2rem;
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

        /* Forms */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--heading-color);
            font-weight: 600;
        }

        input, textarea, select {
            width: 100%;
            padding: 0.8rem 1rem;
            border: 2px solid var(--input-border);
            border-radius: 8px;
            background: var(--input-bg);
            color: var(--input-text);
            font-size: 1rem;
            transition: all 0.3s ease;
            font-family: 'Open Sans', sans-serif;
        }

        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: var(--subheading-color);
            box-shadow: 0 0 0 3px rgba(74, 124, 35, 0.1);
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        .btn {
            background: var(--btn-primary-bg);
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            text-decoration: none;
            justify-content: center;
        }

        .btn:hover {
            background: var(--btn-primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(74, 124, 35, 0.3);
        }

        .btn.secondary {
            background: var(--btn-secondary-bg);
        }

        .btn.secondary:hover {
            background: var(--btn-secondary-hover);
        }

        /* Profile Specific */
        .profile-header {
            background: var(--welcome-bg);
            padding: 2rem;
            border-radius: 16px;
            text-align: center;
            margin-bottom: 2rem;
            box-shadow: 0 8px 32px var(--card-shadow);
        }

        .profile-pic {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: var(--subheading-color);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            color: white;
            font-size: 3rem;
            cursor: pointer;
            position: relative;
            transition: all 0.3s ease;
            border: 4px solid var(--card-border);
        }

        .profile-pic:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 24px rgba(74, 124, 35, 0.3);
        }

        .profile-pic img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }

        .profile-pic-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .profile-pic:hover .profile-pic-overlay {
            opacity: 1;
        }

        .profile-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            margin: 2rem 0;
        }

        .stat-item {
            background: var(--card-bg);
            padding: 1.5rem;
            border-radius: 12px;
            text-align: center;
            border: 2px solid var(--card-border);
            transition: all 0.3s ease;
        }

        .stat-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 16px var(--card-shadow);
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--heading-color);
            display: block;
        }

        .stat-label {
            color: var(--welcome-subtext);
            font-size: 0.9rem;
            margin-top: 0.5rem;
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

        /* Alerts */
        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .alert-success {
            background: rgba(72, 187, 120, 0.1);
            border: 1px solid rgba(72, 187, 120, 0.3);
            color: #2f855a;
        }

        .alert-error {
            background: rgba(245, 101, 101, 0.1);
            border: 1px solid rgba(245, 101, 101, 0.3);
            color: #c53030;
        }

        #profile-picture-input {
            display: none;
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

            .profile-stats {
                grid-template-columns: 1fr;
            }

            .welcome-card h1 {
                font-size: 2rem;
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

        .card, .sidebar-card, .welcome-card, .profile-header {
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
                                <div class="search-result-title">Water Conservation Tips</div>
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
                        <div class="search-section-header">Quick Actions</div>
                        <div class="search-result-item" onclick="window.location.href='{{ route('dashboard') }}'">
                            <i class="fas fa-home search-result-icon"></i>
                            <div class="search-result-content">
                                <div class="search-result-title">Dashboard</div>
                                <div class="search-result-description">View your farming dashboard</div>
                            </div>
                        </div>
                        <div class="search-result-item" onclick="window.location.href='{{ route('friends') }}'">
                            <i class="fas fa-users search-result-icon"></i>
                            <div class="search-result-content">
                                <div class="search-result-title">Friends & Network</div>
                                <div class="search-result-description">Connect with other farmers</div>
                            </div>
                        </div>
                    </div>
                    <div class="search-section">
                        <div class="search-section-header">Profile Settings</div>
                        <div class="search-result-item" onclick="document.getElementById('profileForm').scrollIntoView({behavior: 'smooth'})">
                            <i class="fas fa-user-edit search-result-icon"></i>
                            <div class="search-result-content">
                                <div class="search-result-title">Edit Profile</div>
                                <div class="search-result-description">Update your personal information</div>
                            </div>
                        </div>
                        <div class="search-result-item" onclick="document.getElementById('passwordForm').scrollIntoView({behavior: 'smooth'})">
                            <i class="fas fa-key search-result-icon"></i>
                            <div class="search-result-content">
                                <div class="search-result-title">Change Password</div>
                                <div class="search-result-description">Update your account security</div>
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
            <a href="{{ route('logout.get') }}" class="nav-button logout" title="Sign out">
                <i class="fas fa-sign-out-alt"></i>
            </a>
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
        <a href="{{ route('friends') }}" class="nav-button">
            <i class="fas fa-users"></i>
            <span>Friends</span>
        </a>
        <a href="{{ route('profile.edit') }}" class="nav-button active">
            <i class="fas fa-user"></i>
            <span>Profile</span>
        </a>
    </div>

    <div class="container">
        <div class="main-content">
            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error') || $errors->any())
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    @if(session('error'))
                        {{ session('error') }}
                    @else
                        @foreach($errors->all() as $error)
                            {{ $error }}<br>
                        @endforeach
                    @endif
                </div>
            @endif

            <!-- Profile Header -->
            <div class="profile-header">
                <div class="profile-pic" onclick="document.getElementById('profile-picture-input').click();">
                    @if(Auth::user()->profile_picture)
                        <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile Picture">
                    @else
                        <i class="fas fa-user"></i>
                    @endif
                    <div class="profile-pic-overlay">
                        <i class="fas fa-camera"></i>
                    </div>
                </div>
                <h2 style="color: var(--welcome-text); margin-bottom: 0.5rem; font-size: 1.8rem;">{{ Auth::user()->name }}</h2>
                <p style="color: var(--welcome-subtext);">Member since {{ Auth::user()->created_at->format('F Y') }}</p>
                <p style="color: var(--welcome-subtext); font-size: 0.9rem; margin-top: 0.5rem; cursor: pointer;" onclick="document.getElementById('profile-picture-input').click();">
                    <i class="fas fa-camera"></i> Click to change profile picture
                </p>
            </div>

            <!-- Profile Stats -->
            <div class="profile-stats">
                <div class="stat-item">
                    <span class="stat-number">{{ $questionsAsked ?? 0 }}</span>
                    <div class="stat-label">Questions Asked</div>
                </div>
                <div class="stat-item">
                    <span class="stat-number">{{ $answersGiven ?? 0 }}</span>
                    <div class="stat-label">Answers Given</div>
                </div>
            </div>

            <!-- Profile Information -->
            <div class="card">
                <h2><i class="fas fa-user-edit"></i> Profile Information</h2>

                <!-- Hidden file input for profile picture -->
                <input type="file" id="profile-picture-input" name="profile_picture" accept="image/*" onchange="handleProfilePictureChange(this)">

                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" id="profile-form">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" value="{{ Auth::user()->name }}" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" value="{{ Auth::user()->email }}" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Farm Location (Optional)</label>
                        <input type="text" name="location" value="{{ Auth::user()->location ?? '' }}" placeholder="e.g., Iowa, USA">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Farm Type (Optional)</label>
                        <select name="farm_type">
                            <option value="">Select your farm type</option>
                            <option value="crop" {{ Auth::user()->farm_type == 'crop' ? 'selected' : '' }}>Crop Farming</option>
                            <option value="livestock" {{ Auth::user()->farm_type == 'livestock' ? 'selected' : '' }}>Livestock</option>
                            <option value="mixed" {{ Auth::user()->farm_type == 'mixed' ? 'selected' : '' }}>Mixed Farming</option>
                            <option value="organic" {{ Auth::user()->farm_type == 'organic' ? 'selected' : '' }}>Organic Farming</option>
                            <option value="hobby" {{ Auth::user()->farm_type == 'hobby' ? 'selected' : '' }}>Hobby Farm</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">About Me (Optional)</label>
                        <textarea name="bio" rows="4" placeholder="Tell other farmers about yourself and your farming experience...">{{ Auth::user()->bio ?? '' }}</textarea>
                    </div>

                    <button type="submit" class="btn">
                        <i class="fas fa-save"></i>
                        Save Changes
                    </button>
                </form>
            </div>

            <!-- Password Management -->
            <div class="card">
                @if(!Auth::user()->has_password ?? false)
                    <!-- Set Password for Google Users -->
                    <h2><i class="fas fa-key"></i> Set Password for Manual Login</h2>
                    <p style="color: var(--welcome-subtext); margin-bottom: 1rem;">
                        <i class="fas fa-info-circle"></i> You signed up with Google. Set a password to enable manual login with email and password.
                    </p>
                    <form action="{{ route('profile.set-password') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label class="form-label">New Password</label>
                            <input type="password" name="password" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" required>
                        </div>

                        <button type="submit" class="btn">
                            <i class="fas fa-key"></i>
                            Set Password
                        </button>
                    </form>
                @else
                    <!-- Change Password for Regular Users -->
                    <h2><i class="fas fa-lock"></i> Change Password</h2>
                    <form action="{{ route('password.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label class="form-label">Current Password</label>
                            <input type="password" name="current_password" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">New Password</label>
                            <input type="password" name="password" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Confirm New Password</label>
                            <input type="password" name="password_confirmation" required>
                        </div>

                        <button type="submit" class="btn">
                            <i class="fas fa-key"></i>
                            Update Password
                        </button>
                    </form>
                @endif
            </div>

            <!-- Account Settings -->
            <div class="card">
                <h2><i class="fas fa-cog"></i> Account Settings</h2>
                <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                    <button class="btn secondary" onclick="alert('Export feature coming soon!')">
                        <i class="fas fa-download"></i>
                        Export My Data
                    </button>
                    <button class="btn secondary" onclick="if(confirm('Are you sure you want to delete your account? This cannot be undone.')) { alert('Account deletion feature coming soon!'); }">
                        <i class="fas fa-trash"></i>
                        Delete Account
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Quick Actions -->
            <div class="sidebar-card">
                <h3><i class="fas fa-rocket"></i> Quick Actions</h3>
                <ul class="sidebar-list">
                    <li><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li><a href="{{ route('friends') }}"><i class="fas fa-users"></i> My Friends</a></li>
                </ul>
            </div>

            <!-- Help & Support -->
            <div class="sidebar-card">
                <h3><i class="fas fa-question-circle"></i> Help & Support</h3>
                <ul class="sidebar-list">
                    <li><a href="#" onclick="alert('Help feature coming soon!')"><i class="fas fa-book"></i> User Guide</a></li>
                    <li><a href="#" onclick="alert('Contact feature coming soon!')"><i class="fas fa-envelope"></i> Contact Support</a></li>
                    <li><a href="#" onclick="alert('FAQ feature coming soon!')"><i class="fas fa-question"></i> FAQ</a></li>
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

        // Profile picture change handler
        function handleProfilePictureChange(input) {
            if (input.files && input.files[0]) {
                const formData = new FormData();
                formData.append('profile_picture', input.files[0]);
                formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
                formData.append('_method', 'PUT');
                formData.append('ajax_upload', '1'); // Indicate this is an AJAX upload

                // Show loading state
                const profilePic = document.querySelector('.profile-pic');
                const originalContent = profilePic.innerHTML;
                profilePic.innerHTML = '<i class="fas fa-spinner fa-spin" style="font-size: 2rem;"></i>';

                fetch('{{ route("profile.update") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(data => {
                            throw new Error(data.message || `HTTP error! status: ${response.status}`);
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        // Reload the page to show the new image
                        location.reload();
                    } else {
                        let errorMessage = data.message || 'Unknown error';
                        if (data.errors) {
                            errorMessage = Object.values(data.errors).flat().join(', ');
                        }
                        alert('Error updating profile picture: ' + errorMessage);
                        profilePic.innerHTML = originalContent;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error uploading image: ' + error.message);
                    profilePic.innerHTML = originalContent;
                });
            }
        }

        // Notifications dropdown functionality
        const notificationsToggle = document.getElementById('notificationsToggle');
        const notificationsDropdown = document.getElementById('notificationsDropdown');

        notificationsToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            notificationsDropdown.classList.toggle('show');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!notificationsToggle.contains(e.target) && !notificationsDropdown.contains(e.target)) {
                notificationsDropdown.classList.remove('show');
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
