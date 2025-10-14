<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password - Farm Guide</title>
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
        .reset-wrapper {
            width: 100%;
            max-width: 480px;
            background: rgba(255,255,255,0.95);
            border-radius: 20px;
            padding: 3rem 2.5rem;
            box-shadow: 0 25px 60px rgba(0,0,0,0.15);
        }
        .logo {
            display: block;
            margin: 0 auto 1.5rem auto;
            width: 72px;
            height: auto;
        }
        h2 {
            font-size: 2rem;
            margin: 0 0 1rem 0;
            color: #1f2933;
            font-weight: 700;
            text-align: center;
        }
        .subtitle {
            margin-bottom: 2rem;
            color: #52606d;
            font-size: 0.95rem;
            text-align: center;
            line-height: 1.5;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            width: 100%;
        }
        .input-group label {
            display: block;
            font-size: 0.9rem;
            font-weight: 600;
            color: #1f2933;
            margin-bottom: 0.6rem;
        }
        .input-group input {
            width: 100%;
            display: block;
            height: 50px;
            padding: 0 16px;
            border: 1.5px solid #d0d7de;
            border-radius: 10px;
            font-size: 0.95rem;
            font-family: 'Montserrat', Arial, sans-serif;
            transition: all 0.2s ease;
            background: #fff;
            box-sizing: border-box;
        }
        .input-group input:focus {
            border-color: #218338;
            box-shadow: 0 0 0 3px rgba(33, 131, 56, 0.15);
            outline: none;
        }
        .error-text {
            margin-top: 0.4rem;
            font-size: 0.85rem;
            color: #dc3545;
        }
        .toggle-password {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.85rem;
            color: #1f2933;
            cursor: pointer;
            user-select: none;
        }
        button[type="submit"] {
            width: 100%;
            padding: 15px 24px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, #2da44e 0%, #2c974b 100%);
            color: #fff;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-top: 0.5rem;
        }
        button[type="submit"]:hover {
            background: linear-gradient(135deg, #2c974b 0%, #2a8f47 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(45, 164, 78, 0.2);
        }
        .back-link {
            margin-top: 2rem;
            text-align: center;
        }
        .back-link a {
            color: #111827;
            font-weight: 600;
            text-decoration: none;
        }
        .back-link a:hover {
            text-decoration: underline;
        }
        @media (max-width: 600px) {
            .reset-wrapper {
                padding: 2.5rem 1.75rem;
                border-radius: 16px;
            }
            h2 {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>
    <div class="reset-wrapper">
        <img class="logo" src="{{ asset('logoo.png') }}" alt="FarmGuide logo">
        <h2>Set a New Password</h2>
        <p class="subtitle">Choose a secure password to access your FarmGuide account.</p>

    <form method="POST" action="{{ route('password.reset.submit') }}">
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
                <input id="password" type="password" name="password" required autofocus>
                @error('password')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-group">
                <label for="password_confirmation">Confirm New Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required>
            </div>

            <label class="toggle-password">
                <input type="checkbox" id="showPasswordToggle">
                <span>Show passwords</span>
            </label>

            <button type="submit">Reset Password</button>
        </form>

        <div class="back-link">
            <a href="{{ route('login') }}">Back to login</a>
        </div>
    </div>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggle = document.getElementById('showPasswordToggle');
        const passwordFields = [
            document.getElementById('password'),
            document.getElementById('password_confirmation')
        ];

        if (!toggle) {
            return;
        }

        toggle.addEventListener('change', function () {
            const type = this.checked ? 'text' : 'password';
            passwordFields.forEach(function (field) {
                if (field) {
                    field.type = type;
                }
            });
        });
    });
</script>
</html>
