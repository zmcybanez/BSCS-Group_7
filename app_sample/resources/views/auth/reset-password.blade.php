<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password - FarmGuide</title>
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
            padding: 2rem;
            box-sizing: border-box;
        }
        .container {
            width: 100%;
            max-width: 500px;
            background: #ffffff;
            padding: 3rem 2.5rem;
            border-radius: 20px;
            box-shadow: 0 25px 60px rgba(0,0,0,0.15);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: stretch;
        }
        .logo {
            display: block;
            margin: 0 auto 2rem auto;
            width: 80px;
            height: auto;
        }
        h2 {
            font-size: 2.2rem;
            margin: 0 0 2.5rem 0;
            color: #24292f;
            font-weight: 700;
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }
        .input-group {
            width: 100%;
        }
        .input-group label {
            display: block;
            font-size: 0.9rem;
            font-weight: 600;
            color: #24292f;
            margin-bottom: 0.7rem;
        }
        .input-group input {
            width: 100%;
            height: 48px;
            box-sizing: border-box;
            padding: 0 16px;
            border: 1.5px solid #d0d7de;
            border-radius: 8px;
            font-size: 15px;
            background: #ffffff;
            transition: all 0.2s ease;
            font-family: 'Montserrat', Arial, sans-serif;
        }
        .input-group input:focus {
            border-color: #0969da;
            outline: none;
            box-shadow: 0 0 0 3px rgba(9, 105, 218, 0.1);
        }
        button[type="submit"] {
            width: 100%;
            padding: 16px 24px;
            background: linear-gradient(135deg, #2da44e 0%, #2c974b 100%);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            margin-top: 1rem;
            transition: all 0.2s ease;
        }
        button[type="submit"]:hover {
            background: linear-gradient(135deg, #2c974b 0%, #2a8f47 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(45, 164, 78, 0.2);
        }
        .error-text {
            color: #dc3545;
            font-size: 0.85rem;
            margin-top: 5px;
        }
        .show-password {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 1rem;
            font-size: 0.9rem;
            color: #4a5568;
            cursor: pointer;
            user-select: none;
        }
        .show-password input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="{{ asset('logoo.png') }}" alt="FarmGuide Logo" class="logo">
        <h2>Set a New Password</h2>

        <form method="POST" action="{{ route('password.reset.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="input-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}" required readonly>
                @error('email')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-group">
                <label for="password">New Password</label>
                <input id="password" type="password" name="password" required>
                @error('password')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-group">
                <label for="password_confirmation">Confirm New Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required>
            </div>

            <label class="show-password">
                <input type="checkbox" id="show-password-toggle">
                <span>Show Password</span>
            </label>

            <button type="submit">
                Reset Password
            </button>
        </form>
    </div>

    <script>
        document.getElementById('show-password-toggle').addEventListener('change', function() {
            const passwordField = document.getElementById('password');
            const confirmPasswordField = document.getElementById('password_confirmation');

            if (this.checked) {
                passwordField.type = 'text';
                confirmPasswordField.type = 'text';
            } else {
                passwordField.type = 'password';
                confirmPasswordField.type = 'password';
            }
        });
    </script>
</body>
</html>
