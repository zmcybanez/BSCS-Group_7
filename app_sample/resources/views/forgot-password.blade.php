<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password - Farm Guide</title>
    <link rel="icon" type="image/png" href="{{ asset('logo2.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;600;500;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="login-container">
        <!-- Left Side -->
        <div class="left-side">
            <div class="left-content">
                <h1>Reset Your Password</h1>
                <p>Forgot your password? No worries! Enter your email address and we'll send you a link to reset it.</p>

                <div class="stats-section">
                    <div class="stats-grid">
                        <div class="stat-item">
                            <span class="stat-number">Secure</span>
                            <span class="stat-label">Password Recovery</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">Quick</span>
                            <span class="stat-label">Reset Process</span>
                        </div>
                    </div>
                </div>

                <div class="benefits-section">
                    <div class="benefits-title">Why reset with us:</div>
                    <div class="benefits-grid">
                        <div class="benefit-card">
                            <div class="benefit-icon">🔒</div>
                            <div class="benefit-title">Secure Reset</div>
                            <div class="benefit-desc">Your account stays protected</div>
                        </div>
                        <div class="benefit-card">
                            <div class="benefit-icon">📧</div>
                            <div class="benefit-title">Email Link</div>
                            <div class="benefit-desc">Receive reset instructions</div>
                        </div>
                        <div class="benefit-card">
                            <div class="benefit-icon">⚡</div>
                            <div class="benefit-title">Fast Process</div>
                            <div class="benefit-desc">Get back to farming quickly</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side -->
        <div class="right-side">
            <div class="auth-header">
                <a href="{{ route('login') }}" class="register-link">Back to Login →</a>
            </div>

            <h2>Forgot Password</h2>
            <p class="welcome-text">Enter your email to receive a reset link</p>

            @if(session('status'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="input-group">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required>
                    @error('email')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit">Send Reset Link</button>
            </form>

            <div class="signup-prompt">
                <span>Remember your password?</span>
                <a href="{{ route('login') }}">Sign in here</a>
            </div>
        </div>
    </div>
</body>
</html>
