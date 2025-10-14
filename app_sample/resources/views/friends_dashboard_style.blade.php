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
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Open Sans', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            color: #333;
            line-height: 1.6;
            min-height: 100vh;
        }

        /* Navbar */
        .navbar {
            background: linear-gradient(135deg, #2d5016 0%, #4a7c23 100%);
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
            background: linear-gradient(45deg, #90c695, #ffffff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .nav-button {
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.3);
            color: white;
            padding: 0.6rem 1.2rem;
            border-radius: 25px;
            cursor: pointer;
            font-size: 0.9rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .nav-button:hover {
            background: rgba(255,255,255,0.2);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }

        .nav-button.logout {
            background: rgba(215,48,39,0.2);
            border-color: rgba(215,48,39,0.5);
        }

        .nav-button.logout:hover {
            background: #d73027;
        }

        /* Main Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        /* Welcome Section */
        .welcome-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            padding: 2.5rem;
            border-radius: 16px;
            margin-bottom: 2rem;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            border: 1px solid rgba(255,255,255,0.2);
            position: relative;
            overflow: hidden;
        }

        .welcome-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #4a7c23, #90c695, #4a7c23);
        }

        .welcome-card h1 {
            color: #2d5016;
            font-size: 2.2rem;
            margin-bottom: 0.8rem;
            font-weight: 700;
        }

        .welcome-card p {
            color: #666;
            font-size: 1.2rem;
        }

        /* Cards */
        .card {
            background: rgba(255,255,255,0.95);
            padding: 2rem;
            border-radius: 16px;
            margin-bottom: 2rem;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 40px rgba(0,0,0,0.15);
        }

        .card h2 {
            color: #2d5016;
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .card h2 i {
            color: #4a7c23;
            font-size: 1.5rem;
        }

        /* Friend Item */
        .friend-item {
            display: flex;
            align-items: center;
            justify-between;
            padding: 1.2rem;
            background: rgba(74, 124, 35, 0.05);
            border-radius: 12px;
            margin-bottom: 1rem;
            border: 1px solid rgba(74, 124, 35, 0.1);
            transition: all 0.3s ease;
        }

        .friend-item:hover {
            background: rgba(74, 124, 35, 0.1);
            transform: translateX(8px);
        }

        .friend-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .friend-avatar {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #4a7c23, #90c695);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 1.2rem;
        }

        .friend-details h3 {
            color: #2d5016;
            font-size: 1.1rem;
            margin-bottom: 0.3rem;
            font-weight: 600;
        }

        .friend-details p {
            color: #666;
            font-size: 0.9rem;
        }

        .friend-actions button {
            background: linear-gradient(135deg, #4a7c23, #90c695);
            color: white;
            border: none;
            padding: 0.6rem 1.2rem;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            margin-left: 0.5rem;
        }

        .friend-actions button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(74, 124, 35, 0.3);
        }

        .friend-actions button.accept {
            background: linear-gradient(135deg, #28a745, #20c997);
        }

        .friend-actions button.decline {
            background: linear-gradient(135deg, #dc3545, #fd7e14);
        }

        /* Search Section */
        .search-section {
            background: rgba(255,255,255,0.95);
            padding: 2rem;
            border-radius: 16px;
            margin-bottom: 2rem;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
        }

        .search-box {
            display: flex;
            gap: 1rem;
        }

        .search-input {
            flex: 1;
            padding: 1rem 1.5rem;
            border: 2px solid rgba(74, 124, 35, 0.2);
            border-radius: 12px;
            font-size: 1rem;
            background: white;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: #4a7c23;
            box-shadow: 0 0 0 3px rgba(74, 124, 35, 0.1);
        }

        .search-button {
            background: linear-gradient(135deg, #4a7c23, #90c695);
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 12px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .search-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(74, 124, 35, 0.3);
        }

        /* Stats */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .stat-card {
            background: linear-gradient(135deg, #4a7c23, #90c695);
            color: white;
            padding: 1.5rem;
            border-radius: 16px;
            text-align: center;
            box-shadow: 0 8px 32px rgba(74, 124, 35, 0.3);
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 1rem;
            opacity: 0.9;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #666;
        }

        .empty-state i {
            font-size: 4rem;
            color: #ccc;
            margin-bottom: 1rem;
        }

        .empty-state h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: #555;
        }

        /* Two Column Layout */
        .two-columns {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
        }

        @media (max-width: 768px) {
            .two-columns {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="nav-left">
            <a href="{{ route('dashboard') }}">
                <img src="{{ asset('logo2.png') }}" alt="Farm Guide Logo" class="logo">
                <span class="nav-title">Farm Guide</span>
            </a>
        </div>
        <div class="nav-right">
            <a href="{{ route('dashboard') }}" class="nav-button">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <a href="{{ route('profile.edit') }}" class="nav-button">
                <i class="fas fa-user"></i> Profile
            </a>
                <a href="{{ route('logout.get') }}" class="nav-button logout" title="Sign out">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
        </div>
    </nav>

    <div class="container">
        <!-- Welcome Section -->
        <div class="welcome-card">
            <h1><i class="fas fa-users"></i> Friends & Network</h1>
            <p>Connect with fellow farmers, share knowledge, and grow your agricultural network.</p>
        </div>

        <!-- Two Column Layout -->
        <div class="two-columns">
            <!-- My Friends -->
            <div class="card">
                <h2><i class="fas fa-user-friends"></i> My Friends ({{ $friends->count() }})</h2>

                @if($friends->count() > 0)
                    @foreach($friends as $friend)
                    <div class="friend-item">
                        <div class="friend-info">
                            <div class="friend-avatar">
                                {{ strtoupper(substr($friend->name, 0, 1)) }}
                            </div>
                            <div class="friend-details">
                                <h3>{{ $friend->name }}</h3>
                                <p>{{ $friend->farm_type ?? 'Agricultural Enthusiast' }}</p>
                            </div>
                        </div>
                        <div class="friend-actions">
                            <button onclick="startChat('{{ $friend->UserID }}')">
                                <i class="fas fa-comment"></i> Chat
                            </button>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="empty-state">
                        <i class="fas fa-user-plus"></i>
                        <h3>No friends yet</h3>
                        <p>Start connecting with fellow farmers to build your network!</p>
                    </div>
                @endif
            </div>

            <!-- Friend Requests -->
            <div class="card">
                <h2><i class="fas fa-user-clock"></i> Friend Requests ({{ $friendRequests->count() }})</h2>

                @if($friendRequests->count() > 0)
                    @foreach($friendRequests as $request)
                    <div class="friend-item">
                        <div class="friend-info">
                            <div class="friend-avatar">
                                {{ strtoupper(substr($request->name, 0, 1)) }}
                            </div>
                            <div class="friend-details">
                                <h3>{{ $request->name }}</h3>
                                <p>{{ $request->farm_type ?? 'Agricultural Enthusiast' }}</p>
                            </div>
                        </div>
                        <div class="friend-actions">
                            <form method="POST" action="{{ route('friends.accept') }}" style="display: inline;">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $request->UserID }}">
                                <button type="submit" class="accept">
                                    <i class="fas fa-check"></i> Accept
                                </button>
                            </form>
                            <form method="POST" action="{{ route('friends.reject') }}" style="display: inline;">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $request->UserID }}">
                                <button type="submit" class="decline">
                                    <i class="fas fa-times"></i> Decline
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="empty-state">
                        <i class="fas fa-inbox"></i>
                        <h3>No pending requests</h3>
                        <p>You're all caught up!</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Find Friends -->
        <div class="search-section">
            <h2><i class="fas fa-search"></i> Find New Friends</h2>
            <div class="search-box">
                <input type="text" class="search-input" placeholder="Search for farmers, topics, or locations...">
                <button class="search-button">
                    <i class="fas fa-search"></i> Search
                </button>
            </div>
        </div>

        <!-- Network Stats -->
        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-number">{{ $friends->count() }}</div>
                <div class="stat-label">Total Friends</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $friendRequests->count() }}</div>
                <div class="stat-label">Pending Requests</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $friends->count() * 10 }}%</div>
                <div class="stat-label">Network Score</div>
            </div>
        </div>
    </div>

    @if(session('success'))
    <script>
        // Show success notification
        const notification = document.createElement('div');
        notification.innerHTML = '<i class="fas fa-check-circle"></i> {{ session("success") }}';
        notification.style.cssText = `
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(40, 167, 69, 0.3);
            z-index: 1000;
            font-weight: 600;
        `;
        document.body.appendChild(notification);

        setTimeout(() => {
            notification.style.opacity = '0';
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    </script>
    @endif

    <script>
        function startChat(userId) {
            // Chat functionality placeholder
            alert('Chat feature coming soon!');
        }
    </script>
</body>
</html>
