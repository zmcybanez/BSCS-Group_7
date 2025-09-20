<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - Farm Guide</title>
    <link rel="icon" type="image/png" href="{{ asset('logo2.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;600;500;400&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Montserrat', Arial, sans-serif;
            background-image: url('{{ asset('bg.png') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 2rem 0;
        }

        .register-container {
            display: flex;
            width: 1300px;
            max-width: 95%;
            min-height: 700px;
            background: transparent;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 25px 60px rgba(0,0,0,0.25);
        }

        .left-side {
            flex: 1.1;
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            border-radius: 20px 0 0 20px;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            padding: 4rem;
            position: relative;
            border: 1px solid rgba(255, 255, 255, 0.12);
        }

        .left-content {
            z-index: 2;
            max-width: 500px;
            width: 100%;
            text-align: left;
        }

        .left-side h1 {
            font-size: 3.2rem;
            font-weight: 700;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, #ffffff 0%, #e8f5e8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .left-side p {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.9);
            line-height: 1.7;
            margin-bottom: 3rem;
            font-weight: 400;
        }

        .stats-section {
            margin: 2.5rem 0;
            padding: 2.5rem 0;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .stats-grid {
            display: flex;
            gap: 4rem;
            justify-content: flex-start;
        }

        .stat-item {
            text-align: left;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: #4bbf6b;
            margin-bottom: 0.5rem;
            display: block;
        }

        .stat-label {
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.8);
            font-weight: 500;
        }

        .benefits-section {
            margin-top: 3rem;
        }

        .benefits-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.95);
            margin-bottom: 2rem;
        }

        .benefits-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            margin-bottom: 2.5rem;
        }

        .benefit-card {
            padding: 1.5rem;
            background: rgba(255, 255, 255, 0.06);
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .benefit-card:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .benefit-icon {
            font-size: 1.8rem;
            margin-bottom: 0.8rem;
            display: block;
        }

        .benefit-title {
            font-size: 1rem;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.95);
            margin-bottom: 0.5rem;
        }

        .benefit-desc {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.75);
            line-height: 1.5;
        }

        .learn-more {
            color: #4bbf6b;
            text-decoration: none;
            font-size: 1rem;
            font-weight: 500;
            border-bottom: 1px solid transparent;
            transition: all 0.2s ease;
        }

        .learn-more:hover {
            border-bottom-color: #4bbf6b;
        }

        /* RIGHT SIDE - MUCH MORE BREATHING ROOM */
        .right-side {
            flex: 0.9;
            background: #ffffff;
            padding: 4rem 3.5rem;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: stretch;
            border-radius: 0 20px 20px 0;
            position: relative;
            overflow-y: auto;
        }

        .auth-header {
            margin-bottom: 2.5rem;
            position: relative;
        }

        .sign-in-link {
            position: absolute;
            top: 0;
            right: 0;
            color: #0969da;
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .sign-in-link:hover {
            color: #0550ae;
            text-decoration: underline;
        }

        .right-side h2 {
            font-size: 2rem;
            margin: 1.5rem 0 2.5rem 0;
            color: #24292f;
            font-weight: 600;
            text-align: center;
        }

        .google-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            background: #ffffff;
            color: #24292f;
            padding: 15px 20px;
            border: 1.5px solid #d0d7de;
            border-radius: 10px;
            text-decoration: none;
            font-family: 'Montserrat', Arial, sans-serif;
            font-weight: 500;
            font-size: 15px;
            width: 100%;
            box-sizing: border-box;
            transition: all 0.2s ease;
            margin-bottom: 2rem;
        }

        .google-btn:hover {
            background: #f6f8fa;
            border-color: #8c959f;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .google-btn img {
            width: 18px;
            height: 18px;
        }

        .divider {
            text-align: center;
            margin: 2rem 0;
            position: relative;
            color: #656d76;
            font-size: 0.95rem;
            font-weight: 500;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #d0d7de;
            z-index: 1;
        }

        .divider span {
            background: white;
            padding: 0 1.5rem;
            position: relative;
            z-index: 2;
        }

        .right-side form {
            display: flex;
            flex-direction: column;
            gap: 1.8rem;
        }

        .input-group {
            margin-bottom: 0;
            width: 100%;
        }

        .input-group label {
            display: block;
            font-size: 0.95rem;
            font-weight: 600;
            color: #24292f;
            margin-bottom: 0.8rem;
            letter-spacing: 0.01em;
        }

        .input-row {
            display: flex;
            gap: 1.5rem;
            align-items: stretch;
            width: 100%;
        }

        .input-row .input-group {
            flex: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
        }

        .input-group input,
        .input-group select {
            width: 100%;
            height: 48px;
            box-sizing: border-box;
            padding: 0 16px;
            border: 1.5px solid #d0d7de;
            border-radius: 8px;
            font-size: 15px;
            line-height: 22px;
            background: #ffffff;
            transition: all 0.2s ease;
            font-family: 'Montserrat', Arial, sans-serif;
            font-weight: 400;
        }

        .input-group input:focus,
        .input-group select:focus {
            border-color: #0969da;
            outline: none;
            box-shadow: 0 0 0 3px rgba(9, 105, 218, 0.1);
            transform: translateY(-1px);
        }

        .input-group select {
            cursor: pointer;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 12px center;
            background-repeat: no-repeat;
            background-size: 16px;
            padding-right: 40px;
            appearance: none;
        }

        .checkbox-group {
            display: flex;
            align-items: flex-start;
            gap: 0.8rem;
            margin: 2rem 0;
            padding: 1.2rem;
            background: #f6f8fa;
            border-radius: 8px;
            border: 1px solid #d0d7de;
        }

        .checkbox-group input[type="checkbox"] {
            width: 18px;
            height: 18px;
            margin-top: 0.2rem;
            cursor: pointer;
        }

        .checkbox-group label {
            font-size: 0.95rem;
            color: #24292f;
            line-height: 1.5;
            cursor: pointer;
            font-weight: 400;
        }

        .checkbox-group a {
            color: #0969da;
            text-decoration: none;
            font-weight: 500;
        }

        .checkbox-group a:hover {
            text-decoration: underline;
        }

        .error-text {
            color: #dc3545;
            font-size: 12px;
            margin-top: 4px;
            display: block;
        }

        button[type="submit"] {
            width: 100%;
            box-sizing: border-box;
            padding: 16px 24px;
            background: linear-gradient(135deg, #2da44e 0%, #2c974b 100%);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 1.5rem;
            transition: all 0.2s ease;
            font-family: 'Montserrat', Arial, sans-serif;
            letter-spacing: 0.01em;
        }

        button[type="submit"]:hover {
            background: linear-gradient(135deg, #2c974b 0%, #2a8f47 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(45, 164, 78, 0.3);
        }

        .password-strength {
            font-size: 0.85rem;
            margin-top: 0.5rem;
            color: #656d76;
            font-weight: 500;
        }

        .strength-weak { color: #cf222e; }
        .strength-medium { color: #fb8500; }
        .strength-strong { color: #2da44e; }

        .error-list {
            color: #cf222e;
            margin-bottom: 2rem;
            background: #fff8f8;
            border: 1.5px solid #ffb3ba;
            border-radius: 8px;
            padding: 1.5rem;
        }

        .error-list ul {
            margin: 0;
            padding-left: 1.5rem;
        }

        .error-list li {
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .register-container {
                width: 95%;
                max-width: 1000px;
            }
            .right-side {
                padding: 3rem 2.5rem;
            }
        }

        @media (max-width: 968px) {
            .register-container {
                flex-direction: column;
                width: 95%;
                max-width: 600px;
                min-height: auto;
            }

            .left-side {
                padding: 3rem 2.5rem;
                text-align: center;
                align-items: center;
                border-radius: 20px 20px 0 0;
            }

            .left-content {
                max-width: none;
            }

            .left-side h1 {
                font-size: 2.5rem;
            }

            .right-side {
                border-radius: 0 0 20px 20px;
                padding: 2.5rem 2rem;
            }

            .stats-grid {
                justify-content: center;
                gap: 3rem;
            }

            .benefits-grid {
                grid-template-columns: 1fr 1fr;
                gap: 1rem;
            }
        }

        @media (max-width: 768px) {
            body {
                padding: 1rem 0;
            }

            .register-container {
                margin: 0 1rem;
            }

            .left-side {
                padding: 2rem 1.5rem;
            }

            .left-side h1 {
                font-size: 2.2rem;
            }

            .right-side {
                padding: 2rem 1.5rem;
            }

            .right-side h2 {
                font-size: 1.8rem;
            }

            .input-row {
                flex-direction: column;
                gap: 1.8rem;
            }

            .stats-grid {
                flex-direction: column;
                gap: 1.5rem;
                align-items: center;
            }

            .stat-item {
                text-align: center;
            }

            .benefits-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
        }
    </style>
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
