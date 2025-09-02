    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Register - Farm Guide</title>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;400&display=swap" rel="stylesheet">
        <style>
            body {
                margin: 0;
                font-family: 'Montserrat', Arial, sans-serif;
                background: url("{{ asset('bg.png') }}") no-repeat center center fixed;
                background-size: cover;
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
                padding: 2rem 0;
            }
            .register-container {
                display: flex;
                width: 900px;
                max-width: 90%;
                background: rgba(255,255,255,0.18);
                border-radius: 22px;
                overflow: hidden;
                box-shadow: 0 8px 32px 0 rgba(31,38,135,0.37);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
                border: 1px solid rgba(255,255,255,0.18);
            }
            .left-side {
                flex: 1;
                background: linear-gradient(135deg, #1e4d2b 70%, #4bbf6b 100%);
                color: white;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                padding: 2.5rem 2rem;
                box-shadow: 0 0 40px rgba(30,77,43,0.15);
                position: relative;
            }
            .logo-wrapper {
                background: transparent;
                border-radius: 50%;
                margin-bottom: 1.2rem;
                box-shadow: 0 4px 24px rgba(0,0,0,0.10);
                display: flex;
                align-items: center;
                justify-content: center;
                width: 110px;
                height: 110px;
                overflow: hidden;
            }
            .logo-wrapper img {
                width: 90px;
                height: 90px;
                object-fit: contain;
                display: block;
                margin: 0 auto;
            }
            .left-side h1 {
                margin: 0 0 1.2rem;
                font-size: 3.5rem;
                font-family: 'Montserrat', Arial, sans-serif;
                font-weight: 700;
                letter-spacing: 2px;
                text-shadow: 0 4px 24px rgba(0,0,0,0.18), 0 1px 0 #fff;
                background: linear-gradient(90deg, #fff 0%, #b7e4c7 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                text-fill-color: transparent;
            }
            .left-side p {
                font-size: 1.25rem;
                text-align: center;
                font-family: 'Montserrat', Arial, sans-serif;
                font-weight: 400;
                color: #e0ffe6;
                margin-top: 0.5rem;
                margin-bottom: 0;
                text-shadow: 0 2px 12px rgba(0,0,0,0.12);
                letter-spacing: 1px;
            }
            .right-side {
                flex: 1;
                padding: 2.5rem 2rem;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                max-height: 90vh;
                overflow-y: auto;
            }
            .right-side h2 {
                font-size: 2rem;
                margin-bottom: 0.5rem;
                color: #333;
            }
            .right-side form {
                width: 320px;
                display: flex;
                flex-direction: column;
                gap: 1rem;
                margin: 0 auto;
            }
            .right-side p {
                margin-bottom: 1.5rem;
                color: #555;
            }
            .input-group {
                margin-bottom: 0.8rem;
                width: 100%;
            }
            .input-row {
                display: flex;
                gap: 0.8rem;
            }
            .input-row .input-group {
                flex: 1;
                margin-bottom: 0.8rem;
            }
            .input-group input, .input-group select {
                width: 100%;
                box-sizing: border-box;
                padding: 0.9rem 1.1rem;
                border: 1.5px solid #b7e4c7;
                border-radius: 22px;
                font-size: 1.08rem;
                background: rgba(255,255,255,0.7);
                transition: border 0.2s;
                font-family: 'Montserrat', Arial, sans-serif;
            }
            .input-group input:focus, .input-group select:focus {
                border: 1.5px solid #4bbf6b;
                outline: none;
            }
            .input-group select {
                cursor: pointer;
            }
            .checkbox-group {
                display: flex;
                align-items: flex-start;
                gap: 0.5rem;
                margin: 1rem 0;
            }
            .checkbox-group input[type="checkbox"] {
                width: auto;
                margin-top: 0.2rem;
            }
            .checkbox-group label {
                font-size: 0.9rem;
                color: #555;
                line-height: 1.4;
                cursor: pointer;
            }
            .checkbox-group a {
                color: #4bbf6b;
                text-decoration: none;
                font-weight: 600;
            }
            .checkbox-group a:hover {
                text-decoration: underline;
            }
            button {
                width: 100%;
                box-sizing: border-box;
                padding: 0.9rem 1.1rem;
                background: linear-gradient(90deg, #1e4d2b 60%, #4bbf6b 100%);
                color: #fff;
                border: none;
                border-radius: 22px;
                font-size: 1.08rem;
                font-weight: 600;
                cursor: pointer;
                margin-top: 0.5rem;
                box-shadow: 0 2px 8px rgba(30,77,43,0.10);
                transition: background 0.2s, transform 0.15s;
                font-family: 'Montserrat', Arial, sans-serif;
            }
            button:hover {
                background: linear-gradient(90deg, #4bbf6b 0%, #1e4d2b 100%);
                transform: translateY(-2px) scale(1.03);
            }
            .socials {
                margin-top: 1.5rem;
                display: flex;
                justify-content: center;
                width: 320px;
                margin-left: auto;
                margin-right: auto;
            }
            .socials img {
                width: 32px;
                height: 32px;
                cursor: pointer;
                filter: drop-shadow(0 2px 8px rgba(30,77,43,0.10));
            }
            .error-list {
                color: red;
                margin-bottom: 1rem;
            }
            .error-list ul {
                margin: 0;
                padding-left: 1.2rem;
            }
            .login-link {
                width: 320px;
                margin: 0.7rem auto 0;
                text-align: center;
            }
            .login-link span {
                color: #555;
                font-size: 0.98rem;
            }
            .login-link a {
                color: #4bbf6b;
                font-weight: 600;
                text-decoration: none;
                margin-left: 0.3rem;
            }
            .password-strength {
                font-size: 0.8rem;
                margin-top: 0.3rem;
                color: #777;
            }
            .strength-weak { color: #ff4444; }
            .strength-medium { color: #ffaa00; }
            .strength-strong { color: #4bbf6b; }

            /* Responsive */
            @media (max-width: 768px) {
                .register-container {
                    flex-direction: column;
                    width: 95%;
                    max-width: 500px;
                }
                .left-side {
                    padding: 2rem 1.5rem;
                }
                .left-side h1 {
                    font-size: 2.8rem;
                }
                .right-side form {
                    width: 280px;
                    color: #333;
                }
                .input-row {
                    flex-direction: column;
                    gap: 0;
                }
            }
        </style>
    </head>
    <body>
    <div class="register-container">
        <!-- Left Side -->
        <div class="left-side">
            <div class="logo-wrapper">
                <img src="{{ asset('logo2.png') }}" alt="Farm Guide Logo">
            </div>
            <h1>Farm Guide</h1>
            <p>Join thousands of farmers growing their knowledge and success.</p>
        </div>

        <!-- Right Side -->
        <div class="right-side">
            <h2>Create Account</h2>
            <p style="color: #000;">Sign up to start your farming journey</p>

            @if ($errors->any())
                <div class="error-list">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="input-row">
                    <div class="input-group">
                        <input type="text" name="first_name" placeholder="First Name" value="{{ old('first_name') }}" required>
                    </div>
                    <div class="input-group">
                        <input type="text" name="last_name" placeholder="Last Name" value="{{ old('last_name') }}" required>
                    </div>
                </div>

                <div class="input-group">
                    <input type="email" name="email" placeholder="Email Address" value="{{ old('email') }}" required>
                </div>

                <div class="input-group">
                    <input type="tel" name="phone" placeholder="Phone Number" value="{{ old('phone') }}">
                </div>

                <div class="input-row">
                    <div class="input-group">
                        <select name="farm_type" required>
                            <option value="">Select Farm Type</option>
                            <option value="crops" {{ old('farm_type') == 'crops' ? 'selected' : '' }}>Crop Farming</option>
                            <option value="livestock" {{ old('farm_type') == 'livestock' ? 'selected' : '' }}>Livestock</option>
                            <option value="mixed" {{ old('farm_type') == 'mixed' ? 'selected' : '' }}>Mixed Farming</option>
                            <option value="organic" {{ old('farm_type') == 'organic' ? 'selected' : '' }}>Organic Farming</option>
                            <option value="aquaculture" {{ old('farm_type') == 'aquaculture' ? 'selected' : '' }}>Aquaculture</option>
                            <option value="other" {{ old('farm_type') == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <select name="experience_level" required>
                            <option value="">Experience Level</option>
                            <option value="beginner" {{ old('experience_level') == 'beginner' ? 'selected' : '' }}>Beginner</option>
                            <option value="intermediate" {{ old('experience_level') == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                            <option value="advanced" {{ old('experience_level') == 'advanced' ? 'selected' : '' }}>Advanced</option>
                            <option value="expert" {{ old('experience_level') == 'expert' ? 'selected' : '' }}>Expert</option>
                        </select>
                    </div>
                </div>

                <div class="input-group">
                    <input type="text" name="location" placeholder="Farm Location (City, State)" value="{{ old('location') }}">
                </div>

                <div class="input-group">
                    <input type="password" name="password" placeholder="Password" required id="password" onkeyup="checkPasswordStrength()">
                    <div id="password-strength" class="password-strength"></div>
                </div>

                <div class="input-group">
                    <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms">
                        I agree to the <a href="#" target="_blank">Terms of Service</a> and <a href="#" target="_blank">Privacy Policy</a>
                    </label>
                </div>


                <button type="submit">Create Account</button>
            </form>

            <div class="login-link">
                <span>Already have an account?</span>
                <a href="{{ route('login') }}">Sign In</a>
            </div>

            <div class="socials">
                <a href="{{ route('google.redirect') }}"><img src="https://developers.google.com/identity/images/g-logo.png" alt="Google"></a>
            </div>
        </div>
    </div>

    <script>
    function checkPasswordStrength() {
        const password = document.getElementById('password').value;
        const strengthDiv = document.getElementById('password-strength');

        let strength = 0;
        let feedback = [];

        // Length check
        if (password.length >= 8) strength += 1;
        else feedback.push('At least 8 characters');

        // Uppercase check
        if (/[A-Z]/.test(password)) strength += 1;
        else feedback.push('One uppercase letter');

        // Lowercase check
        if (/[a-z]/.test(password)) strength += 1;
        else feedback.push('One lowercase letter');

        // Number check
        if (/[0-9]/.test(password)) strength += 1;
        else feedback.push('One number');

        // Special character check
        if (/[^A-Za-z0-9]/.test(password)) strength += 1;
        else feedback.push('One special character');

        // Display strength
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
