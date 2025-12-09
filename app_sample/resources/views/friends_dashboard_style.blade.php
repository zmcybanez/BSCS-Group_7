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
    <link rel="stylesheet" href="{{ asset('css/friends_dashboard_style.css') }}">
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
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="nav-button logout">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
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
