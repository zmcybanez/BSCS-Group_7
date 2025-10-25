<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Montserrat', -apple-system, BlinkMacSystemFont, 'Segoe UI', Arial, sans-serif;
            background-color: #f7f9fc;
            padding: 20px 0;
            line-height: 1.6;
        }
        .email-wrapper {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            overflow: hidden;
        }
        .email-header {
            background: linear-gradient(135deg, #2da44e 0%, #248038 100%);
            padding: 40px 30px;
            text-align: center;
            color: white;
        }
        .logo-text {
            font-size: 36px;
            font-weight: 700;
            color: white;
            margin: 0;
            letter-spacing: -0.5px;
        }
        .logo-tagline {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.9);
            margin-top: 8px;
            font-weight: 400;
        }
        .email-body {
            padding: 40px 40px;
            color: #2c3e50;
        }
        .email-body h1 {
            color: #1a1a1a;
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 20px;
        }
        .email-body p {
            font-size: 16px;
            margin-bottom: 18px;
            color: #4a5568;
        }
        .button-container {
            text-align: center;
            margin: 30px 0;
        }
        .button {
            display: inline-block;
            padding: 16px 48px;
            background: linear-gradient(135deg, #2da44e 0%, #248038 100%);
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 16px;
            box-shadow: 0 4px 12px rgba(45, 164, 78, 0.3);
        }
        .button:hover {
            background: linear-gradient(135deg, #26923f 0%, #1f7a32 100%);
        }
        .email-footer {
            background-color: #f8fafb;
            padding: 30px;
            text-align: center;
            font-size: 13px;
            color: #718096;
            border-top: 1px solid #e2e8f0;
        }
        .subcopy {
            margin-top: 25px;
            padding-top: 25px;
            border-top: 1px solid #e2e8f0;
            font-size: 12px;
            color: #a0aec0;
            line-height: 1.5;
        }
        .subcopy a {
            color: #2da44e;
            word-break: break-all;
        }
        .signature {
            margin-top: 30px;
            font-weight: 600;
            color: #2c3e50;
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-header">
            @php
                try {
                    $logoPath = public_path('logoo.png');
                    if (file_exists($logoPath)) {
                        $imageData = base64_encode(file_get_contents($logoPath));
                        $imageSrc = 'data:image/png;base64,' . $imageData;
                    } else {
                        $imageSrc = '';
                    }
                } catch (\Exception $e) {
                    $imageSrc = '';
                }
            @endphp
            @if($imageSrc)
                <img src="{{ $imageSrc }}" alt="FarmGuide Logo" style="width: 100px; height: auto; background: white; padding: 10px; border-radius: 12px;">
            @else
                <h1 style="color: white; font-size: 36px; margin: 0;">🌾 FarmGuide</h1>
            @endif
        </div>
        <div class="email-body">
            {{-- Greeting --}}
            @if (! empty($greeting))
                <h1>{{ $greeting }}</h1>
            @else
                @if ($level === 'error')
                    <h1>Whoops!</h1>
                @else
                    <h1>Hello!</h1>
                @endif
            @endif

            {{-- Intro Lines --}}
            @foreach ($introLines as $line)
                <p>{{ $line }}</p>
            @endforeach

            {{-- Action Button --}}
            @isset($actionText)
                <div class="button-container">
                    <a href="{{ $actionUrl }}" class="button">{{ $actionText }}</a>
                </div>
            @endisset

            {{-- Outro Lines --}}
            @foreach ($outroLines as $line)
                <p>{{ $line }}</p>
            @endforeach

            {{-- Salutation --}}
            <div class="signature">
                @if (! empty($salutation))
                    {{ $salutation }}
                @else
                    Best regards,<br>
                    <strong>FarmGuide Team</strong>
                @endif
            </div>

            {{-- Subcopy --}}
            @isset($actionText)
                <div class="subcopy">
                    <strong>Having trouble?</strong> If you're unable to click the "{{ $actionText }}" button, copy and paste the URL below into your web browser:
                    <br><br>
                    <a href="{{ $actionUrl }}">{{ $actionUrl }}</a>
                </div>
            @endisset
        </div>
        <div class="email-footer">
            <strong>FarmGuide</strong><br>
            Your trusted farming companion<br>
            © {{ date('Y') }} FarmGuide. All rights reserved.
        </div>
    </div>
</body>
</html>
