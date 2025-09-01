<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
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
            height: 100vh;
        }
        .login-container {
            display: flex;
            width: 800px;
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
        }
        .right-side form {
            width: 320px;
            display: flex;
            flex-direction: column;
            gap: 1.2rem;
            margin: 0 auto;
        }

            color: #333;
        }
        .right-side p {
            margin-bottom: 1.5rem;
            color: #555;
        }
        .input-group {
            margin-bottom: 1rem;
            width: 100%;
        }
        .input-group input {
            width: 100%;
            box-sizing: border-box;
            padding: 0.9rem 1.1rem;
            border: 1.5px solid #b7e4c7;
            border-radius: 22px;
            font-size: 1.08rem;
            background: rgba(255,255,255,0.7);
            transition: border 0.2s;
        }
        .input-group input:focus {
            border: 1.5px solid #4bbf6b;
            outline: none;
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
        }
        button:hover {
            background: linear-gradient(90deg, #4bbf6b 0%, #1e4d2b 100%);
            transform: translateY(-2px) scale(1.03);
        }
        button:hover {
            background-color: #16381f;
        }
        .socials {
            margin-top: 1.7rem;
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
    </style>
</head>
<body>
<div class="login-container">
    <!-- Left Side -->
    <div class="left-side">
        <div class="logo-wrapper">
            <img src="{{ asset('logo2.png') }}" alt="Farm Guide Logo">
        </div>
        <h1>Farm Guide</h1>
        <p>A learning tool for every farmer at every age.</p>
    </div>

    <!-- Right Side -->
    <div class="right-side">
        <h2>Welcome</h2>
        <p>Log in to your account to continue</p>

        @if ($errors->any())
            <div style="color:red; margin-bottom:1rem;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="input-group">
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
            </div>
            <div class="input-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit">Log In</button>
        </form>

        <div style="width:320px; margin: 0.7rem auto 0; text-align:center;">
            <span style="color:#555; font-size:0.98rem;">Don’t have an account?</span>
            <a href="{{ route('register') }}" style="color:#4bbf6b; font-weight:600; text-decoration:none; margin-left:0.3rem;">Register</a>
        </form>

        <div class="socials">
            <a href="{{ route('google.redirect') }}"><img src="https://developers.google.com/identity/images/g-logo.png" alt="Google"></a>
        </div>
    </div>
</div>
</body>
</html>
