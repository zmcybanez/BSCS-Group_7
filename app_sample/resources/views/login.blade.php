<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Farm Guide</title>
    <link rel="icon" type="image/png" href="{{ asset('logo2.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;600;500;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

</head>
<body>
    <div class="login-container">
        <!-- Left Side -->
        <div class="left-side">
            <div class="left-content">

                <h1>Welcome back to Farm Guide</h1>
                <p>Connect with thousands of farmers and access expert resources to grow your agricultural business.</p>

                <div class="stats-section">
                    <div class="stats-grid">
                        <div class="stat-item">
                            <span class="stat-number">15K+</span>
                            <span class="stat-label">Active Farmers</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">850+</span>
                            <span class="stat-label">Expert Articles</span>
                        </div>
                    </div>
                </div>

                <div class="benefits-section">
                    <div class="benefits-title">What you'll get:</div>
                    <div class="benefits-grid">
                        <div class="benefit-card">
                            <div class="benefit-icon">🌱</div>
                            <div class="benefit-title">Sustainable Practices</div>
                            <div class="benefit-desc">Learn eco-friendly farming methods</div>
                        </div>
                        <div class="benefit-card">
                            <div class="benefit-icon">👥</div>
                            <div class="benefit-title">Expert Network</div>
                            <div class="benefit-desc">Connect with experienced farmers</div>
                        </div>
                        <div class="benefit-card">
                            <div class="benefit-icon">📊</div>
                            <div class="benefit-title">Management Tools</div>
                            <div class="benefit-desc">Track and optimize your farm</div>
                        </div>
                        <div class="benefit-card">
                            <div class="benefit-icon">📈</div>
                            <div class="benefit-title">Business Growth</div>
                            <div class="benefit-desc">Scale your farm business</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side -->
        <div class="right-side">
            <div class="auth-header">
                <a href="{{ route('register') }}" class="register-link">New to Farm Guide? Sign up →</a>
            </div>

            <h2>Welcome Back</h2>
            <p class="welcome-text">Sign in to your Farm Guide account</p>

            <a href="{{ route('google.redirect') }}" class="google-btn">
                <img src="https://developers.google.com/identity/images/g-logo.png" alt="Google">
                Continue with Google
            </a>

            <div class="divider">
                <span>or</span>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-group">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required>
                    @error('email')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required>
                    @error('password')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-footer">
                    <div class="remember-me">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Remember me</label>
                    </div>
                    <a href="{{ route('password.request') }}" class="forgot-password">Forgot password?</a>
                </div>

                <button type="submit">Sign In</button>
            </form>

            <div class="signup-prompt">
                <span>Don't have an account?</span>
                <a href="{{ route('register') }}">Create your Farm Guide account</a>
            </div>
        </div>
    </div>
</body>
</html>
