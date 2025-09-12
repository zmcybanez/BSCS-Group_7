<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farm Guide Dashboard</title>
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

        /* Container */
        .container {
            max-width: 1400px;
            margin: 2rem auto;
            padding: 0 2rem;
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
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
            font-size: 1.4rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.8rem;
            font-weight: 700;
        }

        .card h2 i {
            color: #4a7c23;
            font-size: 1.2rem;
        }

        /* Form Elements */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.8rem;
            font-weight: 600;
            color: #333;
            font-size: 1rem;
        }

        input, textarea, select {
            width: 100%;
            padding: 1rem;
            border: 2px solid #e1e5e9;
            border-radius: 12px;
            font-family: inherit;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #fafbfc;
        }

        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: #4a7c23;
            box-shadow: 0 0 0 4px rgba(74, 124, 35, 0.1);
            background: white;
        }

        .btn {
            background: linear-gradient(135deg, #4a7c23 0%, #2d5016 100%);
            color: white;
            padding: 1rem 2rem;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.8rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(74, 124, 35, 0.3);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(74, 124, 35, 0.4);
        }

        /* Posts */
        .post {
            padding: 1.8rem 0;
            border-bottom: 1px solid #f0f0f0;
            transition: all 0.3s ease;
        }

        .post:hover {
            background: rgba(74, 124, 35, 0.02);
            margin: 0 -1rem;
            padding: 1.8rem 1rem;
            border-radius: 12px;
        }

        .post:last-child {
            border-bottom: none;
        }

        .post-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #2d5016;
            margin-bottom: 0.8rem;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .post-title:hover {
            color: #4a7c23;
        }

        .post-content {
            color: #666;
            margin-bottom: 1rem;
            line-height: 1.6;
        }

        .post-meta {
            display: flex;
            gap: 1.5rem;
            font-size: 0.9rem;
            color: #888;
            flex-wrap: wrap;
        }

        .post-meta span {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.3rem 0.8rem;
            background: rgba(74, 124, 35, 0.1);
            border-radius: 20px;
            transition: background 0.3s ease;
        }

        .post-meta span:hover {
            background: rgba(74, 124, 35, 0.15);
        }

        /* Sidebar */
        .sidebar {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .sidebar-card {
            background: rgba(255,255,255,0.95);
            padding: 1.8rem;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
            transition: transform 0.3s ease;
        }

        .sidebar-card:hover {
            transform: translateY(-2px);
        }

        .sidebar-card h3 {
            color: #2d5016;
            font-size: 1.2rem;
            margin-bottom: 1.2rem;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            font-weight: 700;
        }

        .sidebar-card h3 i {
            color: #4a7c23;
        }

        .sidebar-list {
            list-style: none;
        }

        .sidebar-list li {
            margin-bottom: 0.4rem;
        }

        .sidebar-list a {
            color: #666;
            text-decoration: none;
            padding: 0.8rem;
            display: flex;
            align-items: center;
            gap: 0.8rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .sidebar-list a:hover {
            background: linear-gradient(135deg, rgba(74, 124, 35, 0.1), rgba(144, 198, 149, 0.1));
            color: #2d5016;
            transform: translateX(4px);
        }

        .sidebar-list a i {
            width: 16px;
            text-align: center;
        }

        /* Dark Mode */
        body.dark-mode {
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
            color: #e0e0e0;
        }

        body.dark-mode .navbar {
            background: linear-gradient(135deg, #0f1a0a 0%, #1a2e0f 100%);
        }

        body.dark-mode .card,
        body.dark-mode .welcome-card,
        body.dark-mode .sidebar-card {
            background: rgba(45, 45, 45, 0.95);
            color: #e0e0e0;
            border-color: rgba(255,255,255,0.1);
        }

        body.dark-mode input,
        body.dark-mode textarea,
        body.dark-mode select {
            background: #3d3d3d;
            border-color: #555;
            color: #e0e0e0;
        }

        body.dark-mode .post-title,
        body.dark-mode h1,
        body.dark-mode h2,
        body.dark-mode h3 {
            color: #90c695;
        }

        body.dark-mode .post-content {
            color: #ccc;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                grid-template-columns: 1fr;
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

    <!-- Navbar -->
    <nav class="navbar">
        <div class="nav-left">
            <a href="{{ url('/dashboard') }}">
                <img src="{{ asset('logo2.png') }}" alt="Farm Guide Logo" class="logo">
                <span class="nav-title">Farm Guide</span>
            </a>
        </div>
        <div class="nav-right">
            <button id="darkModeToggle" class="nav-button">
                <i class="fas fa-moon"></i>
                <span>Dark Mode</span>
            </button>
            <a href="{{ url('/profile') }}" class="nav-button">
                <i class="fas fa-user"></i>
                <span>{{ Auth::user()->name }}</span>
            </a>
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
        <div class="main-content">
            <!-- Welcome -->
            <div class="welcome-card">
                <h1>Welcome, {{ Auth::user()->name }}!</h1>
                <p>Connect with experts across all agricultural sectors - from traditional farming to modern aquaponics and everything in between.</p>
            </div>

            <!-- Ask Question Form -->
            <div class="card">
                <h2><i class="fas fa-question-circle"></i> Ask a Question</h2>
                <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Your Question</label>
                        <input type="text" name="title" placeholder="What agricultural challenge can we help you solve?" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Details</label>
                        <textarea name="content" rows="4" placeholder="Provide specific details about your farming situation, location, current methods, or any other relevant information..." required></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Add Photo (Optional)</label>
                        <input type="file" name="image" accept="image/*">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Category</label>
                        <select name="category" required>
                            <option value="">Choose your agricultural focus</option>
                            <option value="aeroponics">Aeroponics & Aquaponics</option>
                            <option value="hydroponics">Hydroponics</option>
                            <option value="azolla">Azolla Farming</option>
                            <option value="bangus-tilapia">Bangus and Tilapia Farming</option>
                            <option value="cacao">Cacao Production</option>
                            <option value="catfish">Catfish Production</option>
                            <option value="poultry">Chicken and Layer Poultry</option>
                            <option value="dragon-fruit">Dragon Fruit Farming</option>
                            <option value="duck">Duck Farming</option>
                            <option value="goat">Goat Production</option>
                            <option value="herbs-spices">Herbs and Spices</option>
                            <option value="cattle">Hog and Cattle Raising</option>
                            <option value="horticulture">Horticulture</option>
                            <option value="landscaping">Landscaping</option>
                            <option value="mais">Mais Production</option>
                            <option value="moringa">Moringa</option>
                            <option value="mushroom">Mushroom Farming</option>
                            <option value="rabbit">Rabbit Production</option>
                            <option value="shrimp">Shrimp Production</option>
                            <option value="vegetables-fruits">Vegetables and Fruits</option>
                            <option value="vermiculture">Vermiculture</option>
                            <option value="vermicomposting">Vermicomposting</option>
                            <option value="equipment">Equipment & Tools</option>
                            <option value="soil">Soil & Fertilizer</option>
                            <option value="weather">Weather & Climate</option>
                            <option value="general">General Farming</option>
                        </select>
                    </div>
                    <button type="submit" class="btn">
                        <i class="fas fa-paper-plane"></i>
                        Ask Question
                    </button>
                </form>
            </div>

            <!-- Recent Questions -->
            <div class="card">
                <h2><i class="fas fa-comments"></i> Recent Questions</h2>

                <div class="post">
                    <h3 class="post-title">Best nutrient solution for hydroponic lettuce production?</h3>
                    <p class="post-content">I'm starting a commercial hydroponic lettuce farm and need advice on the optimal nutrient solution mix. What EC and pH levels work best for consistent growth?</p>
                    <div class="post-meta">
                        <span><i class="fas fa-tag"></i> Hydroponics</span>
                        <span><i class="fas fa-thumbs-up"></i> 12 helpful</span>
                        <span><i class="fas fa-comments"></i> 8 answers</span>
                        <span><i class="fas fa-clock"></i> 2 hours ago</span>
                    </div>
                </div>

                <div class="post">
                    <h3 class="post-title">Dragon fruit flowering but no fruit development - help?</h3>
                    <p class="post-content">My dragon fruit plants are 3 years old and flowering regularly, but the fruits drop after a few weeks. Plant looks healthy otherwise. Any ideas what's causing this?</p>
                    <div class="post-meta">
                        <span><i class="fas fa-tag"></i> Dragon Fruit</span>
                        <span><i class="fas fa-thumbs-up"></i> 18 helpful</span>
                        <span><i class="fas fa-comments"></i> 14 answers</span>
                        <span><i class="fas fa-clock"></i> 4 hours ago</span>
                    </div>
                </div>

                <div class="post">
                    <h3 class="post-title">Moringa leaf harvest timing and processing tips?</h3>
                    <p class="post-content">I have 50 moringa trees and want to start commercial leaf powder production. When is the best time to harvest leaves and what's the proper drying process?</p>
                    <div class="post-meta">
                        <span><i class="fas fa-tag"></i> Moringa</span>
                        <span><i class="fas fa-thumbs-up"></i> 25 helpful</span>
                        <span><i class="fas fa-comments"></i> 19 answers</span>
                        <span><i class="fas fa-clock"></i> 8 hours ago</span>
                    </div>
                </div>

                <div class="post">
                    <h3 class="post-title">Vermicomposting setup for small-scale vegetable farm?</h3>
                    <p class="post-content">Looking to set up vermicomposting to improve soil quality on my 2-hectare vegetable farm. What's the ideal worm bin size and setup for this scale?</p>
                    <div class="post-meta">
                        <span><i class="fas fa-tag"></i> Vermicomposting</span>
                        <span><i class="fas fa-thumbs-up"></i> 31 helpful</span>
                        <span><i class="fas fa-comments"></i> 22 answers</span>
                        <span><i class="fas Clock"></i> 1 day ago</span>
                    </div>
                </div>

                <div class="post">
                    <h3 class="post-title">Shrimp pond water quality management in rainy season?</h3>
                    <p class="post-content">My vannamei shrimp ponds are struggling with water quality during heavy rains. Ammonia levels spike and dissolved oxygen drops. Any practical solutions?</p>
                    <div class="post-meta">
                        <span><i class="fas fa-tag"></i> Shrimp Production</span>
                        <span><i class="fas fa-thumbs-up"></i> 28 helpful</span>
                        <span><i class="fas fa-comments"></i> 16 answers</span>
                        <span><i class="fas fa-clock"></i> 2 days ago</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Browse Topics -->
            <div class="sidebar-card">
                <h3><i class="fas fa-list"></i> Browse Topics</h3>
                <ul class="sidebar-list">
                    <li><a href="#"><i class="fas fa-microscope"></i> Aeroponics & Aquaponics</a></li>
                    <li><a href="#"><i class="fas fa-fish"></i> Aquaculture Systems</a></li>
                    <li><a href="#"><i class="fas fa-seedling"></i> Azolla Farming</a></li>
                    <li><a href="#"><i class="fas fa-egg"></i> Poultry Production</a></li>
                    <li><a href="#"><i class="fas fa-coffee"></i> Cacao & Cash Crops</a></li>
                    <li><a href="#"><i class="fas fa-carrot"></i> Dragon Fruit & Exotics</a></li>
                    <li><a href="#"><i class="fas fa-mountain"></i> Mushroom Cultivation</a></li>
                    <li><a href="#"><i class="fas fa-bug"></i> Vermiculture Systems</a></li>
                </ul>
            </div>

            <!-- Quick Links -->
            <div class="sidebar-card">
                <h3><i class="fas fa-link"></i> Quick Actions</h3>
                <ul class="sidebar-list">
                    <li><a href="#"><i class="fas fa-user"></i> My Profile</a></li>
                    <li><a href="#"><i class="fas fa-bookmark"></i> My Questions</a></li>
                    <li><a href="#"><i class="fas fa-heart"></i> Saved Answers</a></li>
                    <li><a href="#"><i class="fas fa-users"></i> Find Local Farmers</a></li>
                    <li><a href="#"><i class="fas fa-calendar"></i> Farm Calendar</a></li>
                    <li><a href="#"><i class="fas fa-chart-line"></i> Market Prices</a></li>
                </ul>
            </div>
        </div>
    </div>

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

        // Add smooth scrolling for internal links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
</body>
</html>
