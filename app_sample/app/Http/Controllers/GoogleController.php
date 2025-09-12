<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class GoogleController extends Controller
{
    // Redirect user to Google login
    public function redirect()
    {
        // Debug: Check if env() function is working
        $env_test = env('APP_NAME');
        if ($env_test === null) {
            dd('Environment variables are not loading. Check .env file location and syntax.');
        }

        // Debug: Check specific Google env vars
        $client_id = env('GOOGLE_CLIENT_ID');
        $client_secret = env('GOOGLE_CLIENT_SECRET');
        $redirect_uri = env('GOOGLE_REDIRECT_URI');

        if (empty($client_id) || empty($client_secret) || empty($redirect_uri)) {
            dd('Google env vars are null:', [
                'GOOGLE_CLIENT_ID' => $client_id,
                'GOOGLE_CLIENT_SECRET' => $client_secret,
                'GOOGLE_REDIRECT_URI' => $redirect_uri,
            ]);
        }

        // Debug: Check if config is loaded
        $config = config('services.google');
        if (empty($config['client_id'])) {
            dd('Google client_id is missing from config', $config);
        }
        if (empty($config['redirect'])) {
            dd('Google redirect URI is missing from config', $config);
        }

        // Debug: Log the config for troubleshooting
        \Log::info('Google OAuth Config:', $config);

        return Socialite::driver('google')->redirect();
    }

    // Handle callback from Google
    public function callback()
    {
        $googleUser = Socialite::driver('google')->user();

        // Find or create user
        $user = User::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'password' => bcrypt(str()->random(16)),
            ]
        );

        Auth::login($user);

        return redirect('/dashboard');
    }
}

