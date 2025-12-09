<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password - Farm Guide</title>
    <link rel="icon" type="image/png" href="{{ asset('logo2.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;600;500;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="login-container">
        <!-- Left Side -->
        <div class="left-side">
            <div class="left-content">
                <h1>Choose a New Password</h1>
                <p>Create a strong password to secure your Farm Guide account.</p>

                <div class="stats-section">
                    <div class="stats-grid">
                        <div class="stat-item">
                            <span class="stat-number">Secure</span>
                            <span class="stat-label">Account Protection</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">Strong</span>
                            <span class="stat-label">Password Requirements</span>
                        </div>
                    </div>
                </div>

                <div class="benefits-section">
                    <div class="benefits-title">Password tips:</div>
                    <div class="benefits-grid">
                        <div class="benefit-card">
                            <div class="benefit-icon">🔑</div>
                            <div class="benefit-title">Use Strong Password</div>
                            <div class="benefit-desc">Mix letters, numbers, symbols</div>
                        </div>
                        <div class="benefit-card">
                            <div class="benefit-icon">📏</div>
                            <div class="benefit-title">Minimum Length</div>
                            <div class="benefit-desc">At least 8 characters</div>
                        </div>
                        <div class="benefit-card">
                            <div class="benefit-icon">🔄</div>
                            <div class="benefit-title">Unique Password</div>
                            <div class="benefit-desc">Don't reuse old passwords</div>
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

            <h2>Reset Password</h2>
            <p class="welcome-text">Enter your new password below</p>

            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="input-group">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $request->email) }}" required>
                    @error('email')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group">
                    <label for="password">New Password</label>
                    <input type="password" name="password" id="password" required>
                    @error('password')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group">
                    <label for="password_confirmation">Confirm New Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required>
                    @error('password_confirmation')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit">Reset Password</button>
            </form>

            <div class="signup-prompt">
                <span>Remember your password?</span>
                <a href="{{ route('login') }}">Sign in here</a>
            </div>
        </div>
    </div>
</body>
</html>
