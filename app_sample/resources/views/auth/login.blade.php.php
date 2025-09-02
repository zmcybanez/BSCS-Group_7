<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f7f7f7; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .login-container { background: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); width: 350px; }
        .login-container h1 { text-align: center; margin-bottom: 1.5rem; }
        .input-group { margin-bottom: 1rem; }
        label { display: block; margin-bottom: 0.3rem; }
        input[type="email"], input[type="password"] { width: 100%; padding: 0.5rem; border-radius: 4px; border: 1px solid #ccc; }
        .error { color: red; font-size: 0.9rem; margin-bottom: 1rem; }
        .checkbox { display: flex; align-items: center; margin-bottom: 1rem; }
        button { width: 100%; padding: 0.6rem; background-color: #007BFF; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background-color: #0056b3; }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>

        <!-- Display validation errors -->
        @if ($errors->any())
            <div class="error">
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
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus>
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>

            <div class="checkbox">
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label for="remember" style="margin-left: 0.3rem;">Remember Me</label>
            </div>

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
