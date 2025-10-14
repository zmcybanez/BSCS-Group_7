<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password - Farm Guide</title>
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
        h2 {
            font-size: 2.2rem;
            margin: 0 0 1rem 0;
            color: #24292f;
            font-weight: 700;
            text-align: center;
        }
        .info-text {
            font-size: 1rem;
            color: #656d76;
            text-align: center;
            margin-bottom: 2.5rem;
            font-weight: 400;
            line-height: 1.6;
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
        button[type="submit"].is-disabled,
        button[type="submit"].is-disabled:hover {
            background: #9dbfa7;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }
        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            font-weight: 500;
            text-align: center;
        }
        .alert-status {
            background-color: #d1e7dd;
            border: 1px solid #badbcc;
            color: #0f5132;
        }
        .error-text {
            color: #dc3545;
            font-size: 0.85rem;
            margin-top: 5px;
        }
        .back-link {
            text-align: center;
            margin-top: 2rem;
        }
        .back-link a {
            color: #0969da;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
        }
        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Forgot Your Password?</h2>
        <p class="info-text">No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>

        @if (session('status_html'))
            <div class="alert alert-status">
                {!! session('status_html') !!}
            </div>
        @elseif (session('status'))
            <div class="alert alert-status">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="input-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <div class="error-text">{!! $message !!}</div>
                @enderror
            </div>

            <button type="submit">
                Email Password Reset Link
            </button>
        </form>

        <div class="back-link">
            <a href="{{ route('login') }}">← Back to login</a>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const countdownEl = document.querySelector('.reset-countdown');
            if (!countdownEl) {
                return;
            }

            let remaining = parseInt(countdownEl.dataset.seconds, 10);
            if (Number.isNaN(remaining) || remaining <= 0) {
                countdownEl.textContent = '0';
                return;
            }

            const submitButton = document.querySelector('button[type="submit"]');
            if (submitButton) {
                submitButton.disabled = true;
                submitButton.classList.add('is-disabled');
            }

            const tick = () => {
                if (remaining <= 0) {
                    countdownEl.textContent = '0';
                    if (submitButton) {
                        submitButton.disabled = false;
                        submitButton.classList.remove('is-disabled');
                    }
                    clearInterval(timer);
                    return;
                }

                countdownEl.textContent = remaining;
                remaining -= 1;
            };

            tick();
            const timer = setInterval(tick, 1000);
        });
    </script>
</body>
</html>
