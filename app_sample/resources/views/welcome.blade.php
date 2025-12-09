<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farm Guide - Homepage</title>
    <link rel="icon" type="image/png" href="{{ asset('logo2.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
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

                <form class="contact-form" id="contactForm">
                    @csrf
                    <div class="form-row">
                        <input type="text" name="name" placeholder="Your Name" required>
                        <input type="email" name="email" placeholder="Your Email" required>
                    </div>
                    <input type="text" name="subject" placeholder="Subject" required>
                    <textarea name="message" placeholder="Your Message" rows="5" required></textarea>
                    <button type="submit" class="contact-btn" id="submitBtn">
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
        document.getElementById('contactForm').addEventListener('submit', async function(event) {
            event.preventDefault();

            const submitBtn = document.getElementById('submitBtn');
            const originalText = submitBtn.innerHTML;

            // Show loading state
            submitBtn.innerHTML = '<span>Sending...</span>';
            submitBtn.disabled = true;

            // Get form data
            const formData = new FormData(this);

            try {
                const response = await fetch('{{ route("contact.store") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                    }
                });

                const data = await response.json();

                if (data.success) {
                    // Show success message
                    showNotification('Thank you for your message! We\'ll get back to you soon.', 'success');
                    // Reset form
                    this.reset();
                } else {
                    // Show error message
                    if (data.errors) {
                        const errorMessages = Object.values(data.errors).flat().join('\n');
                        showNotification('Please fix the following errors:\n' + errorMessages, 'error');
                    } else {
                        showNotification(data.message || 'There was an error sending your message.', 'error');
                    }
                }
            } catch (error) {
                console.error('Error:', error);
                showNotification('There was an error sending your message. Please try again.', 'error');
            } finally {
                // Restore button state
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }
        });

        // Notification system
        function showNotification(message, type = 'success') {
            // Remove existing notifications
            const existingNotifications = document.querySelectorAll('.notification');
            existingNotifications.forEach(n => n.remove());

            // Create notification element
            const notification = document.createElement('div');
            notification.className = `notification notification-${type}`;
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                padding: 15px 20px;
                border-radius: 8px;
                color: white;
                font-weight: 600;
                z-index: 10000;
                max-width: 400px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                transform: translateX(100%);
                transition: transform 0.3s ease;
                ${type === 'success' ? 'background: linear-gradient(135deg, #4CAF50, #45a049);' : 'background: linear-gradient(135deg, #f44336, #da190b);'}
            `;
            notification.textContent = message;

            // Add to page
            document.body.appendChild(notification);

            // Animate in
            setTimeout(() => {
                notification.style.transform = 'translateX(0)';
            }, 100);

            // Auto remove after 5 seconds
            setTimeout(() => {
                notification.style.transform = 'translateX(100%)';
                setTimeout(() => notification.remove(), 300);
            }, 5000);
        }
    </script>
</body>
</html>
