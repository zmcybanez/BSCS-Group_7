<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - Farm Guide</title>
    <link rel="icon" type="image/png" href="{{ asset('logo2.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;600;500;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">

</head>
<body>
    <div class="register-container">
        <!-- Left Side -->
        <div class="left-side">
            <div class="left-content">
                <h1>Join Farm Guide</h1>
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
                            <div class="benefit-desc">Scale your agricultural business</div>
                        </div>
                    </div>
                    <a href="#" class="learn-more">Learn more about Farm Guide →</a>
                </div>
            </div>
        </div>

        <!-- Right Side -->
        <div class="right-side">
            <div class="auth-header">
                <a href="{{ route('login') }}" class="sign-in-link">Already have an account? Sign in →</a>
            </div>

            <h2>Sign up for Farm Guide</h2>

            <a href="{{ route('google.redirect') }}" class="google-btn">
                <img src="https://developers.google.com/identity/images/g-logo.png" alt="Google">
                Continue with Google
            </a>

            <div class="divider">
                <span>or</span>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="input-group">
                    <label for="email">Email<sup>*</sup></label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required>
                    @error('email')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-row">
                    <div class="input-group">
                        <label for="first_name">First Name<sup>*</sup></label>
                        <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" required>
                        @error('first_name')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-group">
                        <label for="last_name">Last Name<sup>*</sup></label>
                        <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" required>
                        @error('last_name')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="input-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" name="phone" id="phone">
                </div>

                <div class="input-row">
                    <div class="input-group">
                        <label for="farm_type">Farm Type<sup>*</sup></label>
                        <select name="farm_type" id="farm_type" required>
                            <option value="">Select Farm Type</option>
                            <option value="crops">Crop Farming</option>
                            <option value="livestock">Livestock</option>
                            <option value="mixed">Mixed Farming</option>
                            <option value="organic">Organic Farming</option>
                            <option value="aquaculture">Aquaculture</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <label for="experience_level">Experience Level<sup>*</sup></label>
                        <select name="experience_level" id="experience_level" required>
                            <option value="">Experience Level</option>
                            <option value="beginner">Beginner</option>
                            <option value="intermediate">Intermediate</option>
                            <option value="advanced">Advanced</option>
                            <option value="expert">Expert</option>
                        </select>
                    </div>
                </div>

                <div class="input-group">
                    <label for="location">Farm Location (City, State)</label>
                    <input type="text" name="location" id="location">
                </div>

                <div class="input-group">
                    <label for="password">Password<sup>*</sup></label>
                    <input type="password" name="password" id="password" required onkeyup="checkPasswordStrength()">
                    <div id="password-strength" class="password-strength"></div>
                    @error('password')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group">
                    <label for="password_confirmation">Confirm Password<sup>*</sup></label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required>
                    @error('password_confirmation')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms">
                        I agree to the <a href="#" target="_blank">Terms of Service</a> and <a href="#" target="_blank">Privacy Policy</a>
                    </label>
                </div>

                <button type="submit">Create account</button>
            </form>
        </div>
    </div>

    <script>
        function checkPasswordStrength() {
            const password = document.getElementById('password').value;
            const strengthDiv = document.getElementById('password-strength');

            let strength = 0;
            let feedback = [];

            if (password.length >= 8) strength += 1;
            else feedback.push('At least 8 characters');

            if (/[A-Z]/.test(password)) strength += 1;
            else feedback.push('One uppercase letter');

            if (/[a-z]/.test(password)) strength += 1;
            else feedback.push('One lowercase letter');

            if (/[0-9]/.test(password)) strength += 1;
            else feedback.push('One number');

            if (/[^A-Za-z0-9]/.test(password)) strength += 1;
            else feedback.push('One special character');

            if (password.length === 0) {
                strengthDiv.textContent = '';
                strengthDiv.className = 'password-strength';
            } else if (strength < 3) {
                strengthDiv.textContent = 'Weak - Need: ' + feedback.slice(0, 2).join(', ');
                strengthDiv.className = 'password-strength strength-weak';
            } else if (strength < 4) {
                strengthDiv.textContent = 'Medium - Need: ' + feedback.join(', ');
                strengthDiv.className = 'password-strength strength-medium';
            } else {
                strengthDiv.textContent = 'Strong password!';
                strengthDiv.className = 'password-strength strength-strong';
            }
        }
    </script>
</body>
</html>
