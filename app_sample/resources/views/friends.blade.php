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
    <link rel="stylesheet" href="{{ asset('css/friends.css') }}">

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
