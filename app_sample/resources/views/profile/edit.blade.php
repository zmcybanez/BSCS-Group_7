<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - Farm Guide</title>
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

        /* Container */
        .container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        /* Welcome Section */
        .welcome-card {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            margin-bottom: 2rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            border-left: 4px solid #4a7c23;
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
            background: white;
            padding: 2rem;
            border-radius: 8px;
            margin-bottom: 2rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .card h2 {
            color: #2d5016;
            font-size: 1.3rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
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
        }

        .profile-pic img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
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
            background: #0f1a0a;
        }

        body.dark-mode .card,
        body.dark-mode .welcome-card,
        body.dark-mode .stat-item {
            background: #2d2d2d;
            color: #e0e0e0;
        }

        body.dark-mode input,
        body.dark-mode textarea,
        body.dark-mode select {
            background: #3d3d3d;
            border-color: #555;
            color: #e0e0e0;
        }

        body.dark-mode h1,
        body.dark-mode h2 {
            color: #90c695;
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

    <!-- Navbar -->
    <nav class="navbar">
        <div class="nav-left">
            <a href="{{ url('/dashboard') }}">
                <img src="{{ asset('logo2.png') }}" alt="Farm Guide Logo" class="logo">
                <span class="nav-title">Farm Guide</span>
            </a>
        </div>
        <div class="nav-right">
            <a href="{{ url('/dashboard') }}" class="nav-button">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
            <button id="darkModeToggle" class="nav-button">
                <i class="fas fa-moon"></i>
                <span>Dark Mode</span>
            </button>
            <span class="nav-button" style="border: none; cursor: default;">
                <i class="fas fa-user"></i>
                <span>{{ Auth::user()->name }}</span>
            </span>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="nav-button logout">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </nav>

    <div class="container">
        <!-- Welcome -->
        <div class="welcome-card">
            <h1>My Profile</h1>
            <p>Manage your account settings and farming information.</p>
        </div>

        <!-- Profile Picture & Stats -->
        <div class="profile-pic-section">
            <div class="profile-pic">
                <i class="fas fa-user"></i>
                <!-- If you have profile pictures: <img src="{{ Auth::user()->profile_picture }}" alt="Profile"> -->
            </div>
            <h2 style="color: #2d5016; margin-bottom: 0.5rem;">{{ Auth::user()->name }}</h2>
            <p style="color: #666;">Member since {{ Auth::user()->created_at->format('F Y') }}</p>
        </div>

        <!-- Profile Stats -->
        <div class="profile-stats">
            <div class="stat-item">
                <span class="stat-number">0</span>
                <div class="stat-label">Questions Asked</div>
            </div>
            <div class="stat-item">
                <span class="stat-number">0</span>
                <div class="stat-label">Answers Given</div>
            </div>
        </div>

        <!-- Profile Information -->
        <div class="card">
            <h2><i class="fas fa-user-edit"></i> Profile Information</h2>
            <form action="{{ route('profile.update') }}" method="POST">
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

        <!-- Change Password -->
        <div class="card">
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
    </script>
</body>
</html>
