<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farm Guide - Homepage</title>
    <link rel="icon" type="image/png" href="{{ asset('logo2.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', Arial, sans-serif;
            background: linear-gradient(135deg, #1e4d2b 0%, #2d5233 25%, #4bbf6b 50%, #6ecf87 75%, #8ee5a3 100%);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        /* Animated forest background */
        .forest-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background:
                radial-gradient(circle at 20% 80%, rgba(46, 125, 50, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 60%, rgba(76, 175, 80, 0.2) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(139, 195, 74, 0.1) 0%, transparent 50%);
            z-index: -1;
            animation: forestSway 15s ease-in-out infinite;
        }

        @keyframes forestSway {
            0%, 100% { transform: translateX(0px) scale(1); }
            33% { transform: translateX(10px) scale(1.02); }
            66% { transform: translateX(-5px) scale(0.98); }
        }

        /* Floating particles */
        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 20s infinite linear;
        }

        .particle:nth-child(1) { width: 4px; height: 4px; left: 10%; animation-delay: 0s; }
        .particle:nth-child(2) { width: 6px; height: 6px; left: 20%; animation-delay: 2s; }
        .particle:nth-child(3) { width: 3px; height: 3px; left: 30%; animation-delay: 4s; }
        .particle:nth-child(4) { width: 5px; height: 5px; left: 40%; animation-delay: 6s; }
        .particle:nth-child(5) { width: 4px; height: 4px; left: 50%; animation-delay: 8s; }
        .particle:nth-child(6) { width: 7px; height: 7px; left: 60%; animation-delay: 10s; }
        .particle:nth-child(7) { width: 3px; height: 3px; left: 70%; animation-delay: 12s; }
        .particle:nth-child(8) { width: 5px; height: 5px; left: 80%; animation-delay: 14s; }
        .particle:nth-child(9) { width: 4px; height: 4px; left: 90%; animation-delay: 16s; }

        @keyframes float {
            0% { transform: translateY(100vh) rotate(0deg); opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { transform: translateY(-100px) rotate(360deg); opacity: 0; }
        }

        /* Navigation */
        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            padding: 1rem 2rem;
            background: rgba(30, 77, 43, 0.1);
            backdrop-filter: blur(15px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            z-index: 100;
            transition: all 0.3s ease;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo-nav {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: white;
            font-size: 1.5rem;
            font-weight: 700;
            text-decoration: none;
        }

        .logo-nav img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.15);
            padding: 6px;
            object-fit: contain;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .nav-links a {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-links a:hover {
            color: #b7e4c7;
            transform: translateY(-2px);
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 50%;
            background: #4bbf6b;
            transition: all 0.3s ease;
        }

        .nav-links a:hover::after {
            width: 100%;
            left: 0;
        }

        .login-btn {
            background: linear-gradient(135deg, #4bbf6b, #1e4d2b);
            color: white !important;
            padding: 0.7rem 1.5rem;
            border-radius: 25px;
            border: none;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(75, 191, 107, 0.3);
        }

        .login-btn:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 8px 25px rgba(75, 191, 107, 0.4);
        }

        /* Hero Section */
        .hero {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .hero-content {
            max-width: 800px;
            padding: 2rem;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 30px;
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            animation: heroFloat 6s ease-in-out infinite;
        }

        @keyframes heroFloat {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .hero-logo {
            width: 120px;
            height: 120px;
            margin: 0 auto 2rem;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            animation: logoRotate 20s linear infinite;
        }

        @keyframes logoRotate {
            0% { transform: rotate(0deg) scale(1); }
            25% { transform: rotate(90deg) scale(1.1); }
            50% { transform: rotate(180deg) scale(1); }
            75% { transform: rotate(270deg) scale(1.1); }
            100% { transform: rotate(360deg) scale(1); }
        }

        .hero-logo img {
            width: 80px;
            height: 80px;
            object-fit: contain;
        }

        .hero h1 {
            font-size: 4.5rem;
            font-weight: 800;
            color: white;
            margin-bottom: 1rem;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            background: linear-gradient(135deg, #ffffff 0%, #b7e4c7 50%, #4bbf6b 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: titlePulse 3s ease-in-out infinite;
        }

        @keyframes titlePulse {
            0%, 100% { filter: brightness(1); }
            50% { filter: brightness(1.2); }
        }

        .hero p {
            font-size: 1.4rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 2.5rem;
            font-weight: 300;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            line-height: 1.6;
        }

        .cta-buttons {
            display: flex;
            gap: 1.5rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .cta-btn {
            padding: 1rem 2.5rem;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 30px;
            border: none;
            cursor: pointer;
            transition: all 0.4s ease;
            text-decoration: none;
            display: inline-block;
            position: relative;
            overflow: hidden;
        }

        .cta-btn.primary {
            background: linear-gradient(135deg, #4bbf6b, #1e4d2b);
            color: white;
            box-shadow: 0 6px 20px rgba(75, 191, 107, 0.4);
        }

        .cta-btn.primary:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 12px 30px rgba(75, 191, 107, 0.6);
        }

        .cta-btn.secondary {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
        }

        .cta-btn.secondary:hover {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.6);
            transform: translateY(-5px) scale(1.05);
        }

        .cta-btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            transition: all 0.6s ease;
            transform: translate(-50%, -50%);
        }

        .cta-btn:hover::before {
            width: 300px;
            height: 300px;
        }

        .cta-btn span {
            position: relative;
            z-index: 1;
        }

        /* Features Section */
        .features {
            padding: 5rem 2rem;
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .features h2 {
            text-align: center;
            font-size: 3rem;
            color: white;
            margin-bottom: 3rem;
            font-weight: 700;
            text-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.08);
            border-radius: 25px;
            padding: 2.5rem;
            text-align: center;
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.05), transparent);
            transform: rotate(45deg);
            transition: all 0.6s ease;
            opacity: 0;
        }

        .feature-card:hover::before {
            opacity: 1;
            transform: rotate(45deg) translate(50%, 50%);
        }

        .feature-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
            background: rgba(255, 255, 255, 0.12);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #4bbf6b, #1e4d2b);
            border-radius: 50%;
            margin: 0 auto 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
            box-shadow: 0 8px 25px rgba(75, 191, 107, 0.3);
            transition: all 0.3s ease;
        }

        .feature-card:hover .feature-icon {
            transform: scale(1.1) rotate(10deg);
            box-shadow: 0 12px 35px rgba(75, 191, 107, 0.5);
        }

        .feature-card h3 {
            color: white;
            font-size: 1.5rem;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .feature-card p {
            color: rgba(255, 255, 255, 0.8);
            line-height: 1.6;
            font-size: 1rem;
        }

        /* About Section */
        .about {
            padding: 5rem 2rem;
            position: relative;
            z-index: 1;
        }

        .about-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .about-content {
            background: rgba(255, 255, 255, 0.08);
            border-radius: 30px;
            padding: 3rem;
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
        }

        .about h2 {
            font-size: 3rem;
            color: white;
            margin-bottom: 2rem;
            font-weight: 700;
            text-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }

        .about p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.2rem;
            line-height: 1.8;
            margin-bottom: 3rem;
        }

        .about-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .stat {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            padding: 2rem;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .stat:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.1);
        }

        .stat h3 {
            font-size: 2.5rem;
            color: #ffffff;
            margin-bottom: 0.5rem;
            font-weight: 800;
        }

        .stat p {
            color: #ffffff;
            font-size: 1rem;
            margin: 0;
        }

        .mission {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 2.5rem;
            border: 1px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(15px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .mission h3 {
            color: #ffffff;
            font-size: 2.2rem;
            margin-bottom: 1.5rem;
            font-weight: 700;
            text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        .mission p {
            margin: 0;
            font-size: 1.2rem;
            color: #ffffff;
            line-height: 1.6;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.4);
            font-weight: 500;
        }

        /* Contact Section */
        .contact {
            padding: 5rem 2rem;
            position: relative;
            z-index: 1;
        }

        .contact-container {
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }

        .contact h2 {
            font-size: 3rem;
            color: white;
            margin-bottom: 1rem;
            font-weight: 700;
            text-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }

        .contact > p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.2rem;
            margin-bottom: 3rem;
        }

        .contact-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            align-items: start;
        }

        .contact-info {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 20px;
            padding: 2rem;
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
            text-align: left;
        }

        .contact-item:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.12);
        }

        .contact-icon {
            font-size: 2rem;
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #4bbf6b, #1e4d2b);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 25px rgba(75, 191, 107, 0.3);
        }

        .contact-item h4 {
            color: white;
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .contact-item p {
            color: rgba(255, 255, 255, 0.8);
            margin: 0;
            line-height: 1.6;
        }

        .contact-form {
            background: rgba(255, 255, 255, 0.08);
            border-radius: 25px;
            padding: 2.5rem;
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .contact-form input,
        .contact-form textarea {
            width: 100%;
            padding: 1rem 1.2rem;
            border: 1.5px solid rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            font-size: 1rem;
            font-family: 'Montserrat', Arial, sans-serif;
            transition: all 0.3s ease;
            margin-bottom: 1rem;
        }

        .contact-form input:focus,
        .contact-form textarea:focus {
            outline: none;
            border-color: #4bbf6b;
            background: rgba(255, 255, 255, 0.15);
        }

        .contact-form input::placeholder,
        .contact-form textarea::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .contact-btn {
            width: 100%;
            padding: 1rem 2rem;
            background: linear-gradient(135deg, #4bbf6b, #1e4d2b);
            color: white;
            border: none;
            border-radius: 15px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Montserrat', Arial, sans-serif;
            box-shadow: 0 6px 20px rgba(75, 191, 107, 0.4);
            position: relative;
            overflow: hidden;
        }

        .contact-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(75, 191, 107, 0.6);
        }

        .contact-btn span {
            position: relative;
            z-index: 1;
        }
        .footer {
            background: rgba(30, 77, 43, 0.2);
            backdrop-filter: blur(15px);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding: 2rem;
            text-align: center;
            color: rgba(255, 255, 255, 0.8);
            position: relative;
            z-index: 1;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero h1 { font-size: 3rem; }
            .hero p { font-size: 1.2rem; }
            .cta-buttons { flex-direction: column; align-items: center; }
            .nav-links { display: none; }
            .features h2 { font-size: 2.5rem; }
            .about h2, .contact h2 { font-size: 2.5rem; }
            .contact-content { grid-template-columns: 1fr; }
            .form-row { grid-template-columns: 1fr; }
            .about-stats { grid-template-columns: repeat(2, 1fr); }
        }
    </style>
</head>
<body>
    <div class="forest-bg"></div>

    <div class="particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="#" class="logo-nav">
                <img src="{{ asset('logoo.png') }}" alt="Farm Guide">
                Farm Guide
            </a>
            <div class="nav-links">
                <a href="#features">Features</a>
                <a href="#about">About</a>
                <a href="#contact">Contact</a>
                <button class="login-btn" onclick="window.location.href='{{ route('login') }}'">Login</button>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <div class="hero-logo">
                <img src="{{ asset('logoo.png') }}" alt="Farm Guide Logo">
            </div>
            <h1>Farm Guide</h1>
            <p>A comprehensive learning tool designed for every farmer at every stage of their journey. Cultivate knowledge, grow success.</p>
            <div class="cta-buttons">
                <a href="{{ route('register') }}" class="cta-btn primary">
                    <span>Get Started</span>
                </a>
                <a href="#features" class="cta-btn secondary">
                    <span>Learn More</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" id="features">
        <h2>Why Choose Farm Guide?</h2>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">📚</div>
                <h3>Expert Knowledge</h3>
                <p>Access comprehensive farming guides, tips, and best practices from agricultural experts and experienced farmers worldwide.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🌱</div>
                <h3>Crop Management</h3>
                <p>Learn effective crop rotation, soil management, and sustainable farming techniques to maximize your harvest yield.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">📊</div>
                <h3>Farm Analytics</h3>
                <p>Track your farm's performance with detailed analytics, weather forecasts, and market price predictions.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🤝</div>
                <h3>Community Support</h3>
                <p>Connect with fellow farmers, share experiences, and get advice from a supportive agricultural community.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">📱</div>
                <h3>Mobile Friendly</h3>
                <p>Access Farm Guide anywhere, anytime with our responsive design that works perfectly on all devices.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">💡</div>
                <h3>Smart Solutions</h3>
                <p>Get personalized recommendations and smart farming solutions tailored to your specific crops and location.</p>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about" id="about">
        <div class="about-container">
            <div class="about-content">
                <h2>About Farm Guide</h2>
                <p>Farm Guide was born from a simple belief: every farmer deserves access to the knowledge and tools needed to succeed in modern agriculture. Founded by a team of agricultural experts, tech innovators, and passionate farmers, we've created a comprehensive platform that bridges traditional farming wisdom with cutting-edge technology.</p>

                <div class="about-stats">
                    <div class="stat">
                        <h3>10,000+</h3>
                        <p>Active Farmers</p>
                    </div>
                    <div class="stat">
                        <h3>500+</h3>
                        <p>Expert Guides</p>
                    </div>
                    <div class="stat">
                        <h3>50+</h3>
                        <p>Countries</p>
                    </div>
                    <div class="stat">
                        <h3>24/7</h3>
                        <p>Support</p>
                    </div>
                </div>

                <div class="mission">
                    <h3>Our Mission</h3>
                    <p>To empower farmers worldwide with accessible, practical knowledge and innovative tools that promote sustainable farming practices, increase productivity, and ensure food security for future generations.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact" id="contact">
        <div class="contact-container">
            <h2>Get In Touch</h2>
            <p>Have questions? We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>

            <div class="contact-content">
                <div class="contact-info">
                    <div class="contact-item">
                        <div class="contact-icon">📧</div>
                        <div>
                            <h4>Email Us</h4>
                            <p>glenlaurencelagata@gmail.com</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">📱</div>
                        <div>
                            <h4>Call Us</h4>
                            <p>+63 951 900 4026</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">🌐</div>
                        <div>
                            <h4>Visit Us</h4>
                            <p>123 Agricultural Way<br>Farm City, FC 12345</p>
                        </div>
                    </div>
                </div>

                <form class="contact-form" onsubmit="handleContactForm(event)">
                    <div class="form-row">
                        <input type="text" placeholder="Your Name" required>
                        <input type="email" placeholder="Your Email" required>
                    </div>
                    <input type="text" placeholder="Subject" required>
                    <textarea placeholder="Your Message" rows="5" required></textarea>
                    <button type="submit" class="contact-btn">
                        <span>Send Message</span>
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2025 Farm Guide. Empowering farmers with knowledge and technology.</p>
    </footer>

    <script>
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Navbar transparency on scroll
        window.addEventListener('scroll', () => {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 100) {
                navbar.style.background = 'rgba(30, 77, 43, 0.3)';
            } else {
                navbar.style.background = 'rgba(30, 77, 43, 0.1)';
            }
        });

        // Add entrance animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe feature cards and other animated elements
        document.querySelectorAll('.feature-card, .contact-item, .stat').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(50px)';
            card.style.transition = 'all 0.6s ease';
            observer.observe(card);
        });

        // Contact form handler
        function handleContactForm(event) {
            event.preventDefault();

            // Get form data
            const formData = new FormData(event.target);
            const name = event.target.querySelector('input[type="text"]').value;
            const email = event.target.querySelector('input[type="email"]').value;
            const subject = event.target.querySelectorAll('input[type="text"]')[1].value;
            const message = event.target.querySelector('textarea').value;

            // Simple validation
            if (!name || !email || !subject || !message) {
                alert('Please fill in all fields');
                return;
            }

            // Show success message (in a real app, you'd send this to your backend)
            alert('Thank you for your message! We\'ll get back to you soon.');

            // Reset form
            event.target.reset();

            // In a real application, you would send the data to your backend:
            // fetch('/contact', {
            //     method: 'POST',
            //     headers: {
            //         'Content-Type': 'application/json',
            //     },
            //     body: JSON.stringify({name, email, subject, message})
            // });
        }
    </script>
</body>
</html>
