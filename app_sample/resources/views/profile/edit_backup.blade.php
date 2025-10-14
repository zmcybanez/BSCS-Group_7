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
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Open Sans', sans-serif;
            background: #f5f7fa;
            color: #333;
            line-height: 1.6;
        }

        /* Navbar */
        .navbar {
            background: #2d5016;
            color: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
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
            border-radius: 4px;
        }

        .nav-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: white;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .nav-button {
            background: none;
            border: 1px solid #4a7c23;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.9rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: background 0.3s;
        }

        .nav-button:hover {
            background: #4a7c23;
        }

        .nav-button.logout {
            border-color: #d73027;
            color: #ffcdd2;
        }

        .nav-button.logout:hover {
            background: #d73027;
            color: white;
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
            padding: 0.8rem 1.2rem 0.8rem 3rem;
            border: 2px solid rgba(255,255,255,0.2);
            border-radius: 25px;
            background: rgba(255,255,255,0.1);
            color: white;
            font-size: 0.95rem;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            outline: none;
        }

        .search-bar:focus {
            background: rgba(255,255,255,0.9);
            color: #333;
            border-color: #90c695;
        }

        .search-bar::placeholder {
            color: rgba(255,255,255,0.7);
        }

        .search-bar:focus::placeholder {
            color: #888;
        }

        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255,255,255,0.7);
            transition: color 0.3s ease;
            pointer-events: none;
        }

        .search-container:focus-within .search-icon {
            color: #4a7c23;
        }

        /* Search Dropdown */
        .search-dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border: 2px solid #e1e5e9;
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.15);
            z-index: 1000;
            display: none;
            max-height: 300px;
            overflow-y: auto;
        }

        .search-dropdown-header {
            padding: 1rem;
            border-bottom: 1px solid #e1e5e9;
            font-weight: 600;
            color: #333;
            background: #f8f9fa;
            border-radius: 10px 10px 0 0;
        }

        /* Secondary Navbar */
        .secondary-navbar {
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            padding: 1rem 2rem;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 1rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0,0,0,0.06);
            position: sticky;
            top: 0;
            z-index: 999;
            flex-wrap: wrap;
        }

        .secondary-navbar .nav-button {
            background: #ffffff;
            border: 1px solid rgba(77, 124, 35, 0.15);
            color: #4a7c23;
            padding: 0.7rem 1.5rem;
            border-radius: 30px;
            cursor: pointer;
            font-size: 0.85rem;
            font-weight: 600;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            transition: all 0.3s ease;
            position: relative;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            min-width: 120px;
            justify-content: center;
            white-space: nowrap;
        }

        .secondary-navbar .nav-button:hover {
            background: rgba(77, 124, 35, 0.08);
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(0,0,0,0.12);
            border-color: rgba(77, 124, 35, 0.3);
        }

        .secondary-navbar .nav-button.active {
            background: rgba(77, 124, 35, 0.12);
            border-color: rgba(77, 124, 35, 0.4);
            color: #2d5016;
            font-weight: 700;
        }

        .secondary-navbar .nav-button i {
            font-size: 0.9rem;
        }

        /* Container */
        .container {
            max-width: 800px;
            margin: 1rem auto;
            padding: 2rem 2rem 0 2rem;
        }

        /* Welcome Section */
        .welcome-card {
            background: linear-gradient(145deg, #ffffff 0%, #f8f9fa 100%);
            padding: 2rem;
            border-radius: 20px;
            margin-bottom: 2rem;
            box-shadow: 0 12px 40px rgba(0,0,0,0.08), 0 4px 16px rgba(0,0,0,0.04);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.3);
            border-left: 4px solid #4a7c23;
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            position: relative;
            overflow: hidden;
        }

        .welcome-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #4a7c23, #90c695, #4a7c23);
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .welcome-card:hover::before {
            transform: scaleX(1);
        }

        .welcome-card:hover {
            transform: translateY(-4px) scale(1.01);
            box-shadow: 0 20px 60px rgba(0,0,0,0.12), 0 8px 24px rgba(0,0,0,0.08);
        }

        .welcome-card h1 {
            color: #2d5016;
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .welcome-card p {
            color: #666;
            font-size: 1.1rem;
        }

        /* Cards */
        .card {
            background: linear-gradient(145deg, #ffffff 0%, #f8f9fa 100%);
            padding: 2rem;
            border-radius: 20px;
            margin-bottom: 2rem;
            box-shadow: 0 12px 40px rgba(0,0,0,0.08), 0 4px 16px rgba(0,0,0,0.04);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.3);
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            position: relative;
            overflow: hidden;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #4a7c23, #90c695, #4a7c23);
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .card:hover::before {
            transform: scaleX(1);
        }

        .card:hover {
            transform: translateY(-4px) scale(1.01);
            box-shadow: 0 20px 60px rgba(0,0,0,0.12), 0 8px 24px rgba(0,0,0,0.08);
        }

        .card h2 {
            color: #2d5016;
            font-size: 1.3rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            position: relative;
        }

        .card h2::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 40px;
            height: 2px;
            background: linear-gradient(90deg, #4a7c23, #90c695);
            border-radius: 1px;
        }

        /* Form Elements */
        .form-group {
            margin-bottom: 1.2rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #333;
        }

        input, textarea, select {
            width: 100%;
            padding: 0.8rem;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-family: inherit;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: #4a7c23;
        }

        .btn {
            background: #4a7c23;
            color: white;
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: background 0.3s;
            width: auto;
            display: inline-flex;
        }

        .btn:hover {
            background: #2d5016;
        }

        .btn-danger {
            background: #d73027;
            margin-left: 1rem;
        }

        .btn-danger:hover {
            background: #a02622;
        }

        /* Profile Stats */
        .profile-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .stat-item {
            background: white;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            text-align: center;
            border-left: 4px solid #4a7c23;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: #2d5016;
            display: block;
        }

        .stat-label {
            color: #666;
            font-size: 0.9rem;
            margin-top: 0.5rem;
        }

        /* Profile Picture */
        .profile-pic-section {
            text-align: center;
            margin-bottom: 2rem;
        }

        .profile-pic {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: #4a7c23;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            color: white;
            font-size: 3rem;
            cursor: pointer;
            position: relative;
            transition: all 0.3s ease;
            border: 4px solid transparent;
        }

        .profile-pic:hover {
            border-color: #4a7c23;
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(74, 124, 35, 0.3);
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
            background: rgba(0, 0, 0, 0.5);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .profile-pic:hover .profile-pic-overlay {
            opacity: 1;
        }

        .profile-pic-overlay i {
            color: white;
            font-size: 2rem;
        }

        #profile-picture-input {
            display: none;
        }

        .upload-hint {
            color: #666;
            font-size: 0.9rem;
            margin-top: 0.5rem;
        }

        /* Success/Error Messages */
        .alert {
            padding: 1rem;
            border-radius: 5px;
            margin-bottom: 1rem;
        }

        .alert-success {
            background: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
        }

        .alert-error {
            background: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }

        /* Dark Mode */
        body.dark-mode {
            background: #1a1a1a;
            color: #e0e0e0;
        }

                body.dark-mode .navbar {
            background: linear-gradient(135deg, #0f1a0a 0%, #1a2e0f 100%);
        }

        body.dark-mode .search-bar {
            background: rgba(45, 45, 45, 0.8);
            border-color: rgba(144, 198, 149, 0.3);
            color: #e0e0e0;
        }

        body.dark-mode .search-bar::placeholder {
            color: rgba(224, 224, 224, 0.6);
        }

        body.dark-mode .search-bar:focus {
            background: rgba(45, 45, 45, 0.95);
            border-color: #90c695;
            color: #e0e0e0;
        }

        body.dark-mode .search-bar:focus::placeholder {
            color: rgba(224, 224, 224, 0.4);
        }

        body.dark-mode .search-icon {
            color: rgba(144, 198, 149, 0.7);
        }

        body.dark-mode .search-container:focus-within .search-icon {
            color: #90c695;
        }

        body.dark-mode .search-dropdown {
            background: #2d2d2d;
            border-color: rgba(144, 198, 149, 0.3);
        }

        body.dark-mode .search-dropdown-header {
            background: #3d3d3d;
            color: #90c695;
            border-bottom-color: rgba(144, 198, 149, 0.2);
        }

        body.dark-mode .card,
        body.dark-mode .welcome-card,
        body.dark-mode .stat-item {
            background: linear-gradient(145deg, #1e293b 0%, #334155 100%);
            border: 1px solid rgba(148, 163, 184, 0.1);
            box-shadow: 0 12px 40px rgba(0,0,0,0.3), 0 4px 16px rgba(0,0,0,0.2);
            color: #f0f0f0;
        }

        body.dark-mode .card:hover,
        body.dark-mode .welcome-card:hover {
            box-shadow: 0 20px 60px rgba(0,0,0,0.4), 0 8px 24px rgba(0,0,0,0.3);
        }

        body.dark-mode .card h2,
        body.dark-mode .welcome-card h1 {
            color: #e2e8f0;
        }

        body.dark-mode .card h2::after {
            background: linear-gradient(90deg, #90c695, #4a7c23);
        }

        body.dark-mode input,
        body.dark-mode textarea,
        body.dark-mode select {
            background: #3d3d3d;
            border-color: #555;
            color: #f0f0f0;
        }

        body.dark-mode h1,
        body.dark-mode h2 {
            color: #a5d6aa;
        }

        body.dark-mode .upload-hint {
            color: #e0e0e0;
        }

        body.dark-mode p,
        body.dark-mode .form-label,
        body.dark-mode label,
        body.dark-mode span {
            color: #e0e0e0;
        }

        body.dark-mode .profile-pic:hover {
            border-color: #90c695;
        }

        body.dark-mode .stat-number {
            color: #90c695;
        }

        body.dark-mode .alert-success {
            background: #155724;
            border-color: #1e7e34;
            color: #d4edda;
        }

        body.dark-mode .alert-error {
            background: #721c24;
            border-color: #a71d2a;
            color: #f8d7da;
        }

        body.dark-mode .secondary-navbar {
            background: linear-gradient(135deg, #2d2d2d 0%, #1a1a1a 100%);
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        body.dark-mode .secondary-navbar .nav-button {
            background: #3d3d3d;
            border-color: rgba(144, 198, 149, 0.3);
            color: #90c695;
        }

        body.dark-mode .secondary-navbar .nav-button:hover {
            background: rgba(144, 198, 149, 0.15);
            border-color: rgba(144, 198, 149, 0.5);
        }

        body.dark-mode .secondary-navbar .nav-button.active {
            background: rgba(144, 198, 149, 0.25);
            border-color: rgba(144, 198, 149, 0.6);
            color: #a5d6aa;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 0 1rem;
            }

            .navbar {
                padding: 1rem;
                flex-direction: column;
                gap: 1rem;
            }

            .nav-right {
                flex-wrap: wrap;
                gap: 0.5rem;
            }

            .nav-button span {
                display: none;
            }

            .profile-stats {
                grid-template-columns: 1fr 1fr;
            }
        }
    </style>
</head>
<body>

    <!-- FIXED NAVBAR -->
    <nav class="navbar">
        <div class="nav-left">
            <a href="{{ url('/dashboard') }}">
                <img src="{{ asset('logo2.png') }}" alt="Farm Guide Logo" class="logo">
                <span class="nav-title">Farm Guide</span>
            </a>
        </div>

        <div class="nav-right">
            <!-- Search Bar moved to nav-right -->
            <div class="search-container">
                <i class="fas fa-search search-icon"></i>
                <input type="text" class="search-bar" id="searchInput" placeholder="Search farmers, topics, or questions...">

                <!-- Search Dropdown -->
                <div class="search-dropdown" id="searchDropdown">
                    <div class="search-dropdown-header">Farmers & Experts</div>
                    <div id="searchDropdownResults">
                        <!-- Search results will be populated here -->
                    </div>
                </div>
            </div>

            @auth
                <a href="{{ route('logout.get') }}" class="nav-button logout" title="Sign out">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            @endauth
        </div>
    </nav>

    <!-- Secondary Navbar -->
    <div class="secondary-navbar">
        <a href="{{ url('/dashboard') }}" class="nav-button">
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
        <a href="{{ url('/profile') }}" class="nav-button active">
            <i class="fas fa-user"></i>
            <span>Profile</span>
        </a>
    </div>

    <div class="container">
        <!-- Success/Error Messages -->
        @if (session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i>
                <ul style="margin: 0.5rem 0 0 1.5rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Welcome -->
        <div class="welcome-card">
            <h1>My Profile</h1>
            <p>Manage your account settings and farming information.</p>
        </div>

        <!-- Profile Picture & Stats -->
        <div class="profile-pic-section">
            <div class="profile-pic" onclick="document.getElementById('profile-picture-input').click();">
                <!-- DEBUG: Profile picture value: {{ Auth::user()->profile_picture ?? 'NULL' }} -->
                @if(Auth::user()->profile_picture)
                    <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile Picture">
                    <!-- DEBUG: Image URL: {{ asset('storage/' . Auth::user()->profile_picture) }} -->
                @else
                    <i class="fas fa-user"></i>
                @endif
                <div class="profile-pic-overlay">
                    <i class="fas fa-camera"></i>
                </div>
            </div>
            <div class="upload-hint">Click to change profile picture</div>
            <h2 style="color: #2d5016; margin-bottom: 0.5rem;">{{ Auth::user()->name }}</h2>
            <p style="color: #666;">Member since {{ Auth::user()->created_at->format('F Y') }}</p>
        </div>

        <!-- Profile Stats -->
        <div class="profile-stats">
            <div class="stat-item">
                <span class="stat-number">{{ $questionsAsked }}</span>
                <div class="stat-label">Questions Asked</div>
            </div>
            <div class="stat-item">
                <span class="stat-number">{{ $answersGiven }}</span>
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
            @if(!Auth::user()->has_password)
                <!-- Set Password for Google Users -->
                <h2><i class="fas fa-key"></i> Set Password for Manual Login</h2>
                <p style="color: #666; margin-bottom: 1rem;">
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

            <div class="form-group">
                <label class="form-label">Email Notifications</label>
                <select name="email_notifications">
                    <option value="all">All notifications</option>
                    <option value="important">Important only</option>
                    <option value="none">None</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Privacy Setting</label>
                <select name="profile_privacy">
                    <option value="public">Public (visible to all farmers)</option>
                    <option value="private">Private</option>
                </select>
            </div>

            <button type="button" class="btn">
                <i class="fas fa-save"></i>
                Save Settings
            </button>

            @include('profile.partials.delete-user-form')
        </div>
    </div>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        const darkModeToggle = document.getElementById('darkModeToggle');
        const body = document.body;

        // Load saved preference
        if (localStorage.getItem('darkMode') === 'true') {
            body.classList.add('dark-mode');
            darkModeToggle.innerHTML = '<i class="fas fa-sun"></i> <span>Light Mode</span>';
        }

        darkModeToggle.addEventListener('click', function() {
            body.classList.toggle('dark-mode');

            if (body.classList.contains('dark-mode')) {
                localStorage.setItem('darkMode', 'true');
                this.innerHTML = '<i class="fas fa-sun"></i> <span>Light Mode</span>';
            } else {
                localStorage.setItem('darkMode', 'false');
                this.innerHTML = '<i class="fas fa-moon"></i> <span>Dark Mode</span>';
            }
        });

        // Form validation
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function(e) {
                const requiredFields = form.querySelectorAll('input[required]');
                let isValid = true;

                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        isValid = false;
                        field.style.borderColor = '#d73027';
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                }
            });
        });

        // Profile picture upload handling
        function handleProfilePictureChange(input) {
            if (input.files && input.files[0]) {
                const file = input.files[0];

                // Validate file size (max 5MB)
                if (file.size > 5 * 1024 * 1024) {
                    alert('File size must be less than 5MB');
                    input.value = '';
                    return;
                }

                // Validate file type
                if (!file.type.match('image.*')) {
                    alert('Please select an image file');
                    input.value = '';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    const profilePic = document.querySelector('.profile-pic');
                    profilePic.innerHTML = `
                        <img src="${e.target.result}" alt="Profile Picture">
                        <div class="profile-pic-overlay">
                            <i class="fas fa-camera"></i>
                        </div>
                    `;
                };
                reader.readAsDataURL(file);

                // Auto-submit the form to upload the picture
                setTimeout(() => {
                    document.getElementById('profile-form').submit();
                }, 100);
            }
        }
    </script>
</body>
</html>
