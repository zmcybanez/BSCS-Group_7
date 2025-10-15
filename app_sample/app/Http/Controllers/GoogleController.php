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
        try {
            return Socialite::driver('google')->redirect();
        } catch (\Exception $e) {
            \Log::error('Google OAuth redirect failed: ' . $e->getMessage());
            return redirect()->route('login')->withErrors(['google' => 'Unable to connect to Google. Please check your configuration.']);
        }
    }

    // Handle callback from Google
    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Find existing user or create new one
            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                // User exists - update their Google info if they signed up via email originally
                if ($user->auth_provider === 'email') {
                    $user->update([
                        'google_id' => $googleUser->getId(),
                        'auth_provider' => 'google', // Switch to Google auth
                        'has_password' => false, // They'll need to set a password for manual login
                    ]);
                }
            } else {
                // Create new user
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'auth_provider' => 'google',
                    'has_password' => false,
                    'password' => null, // No password for Google users initially
                ]);
            }

            Auth::login($user);

            return redirect('/dashboard');
        } catch (\Exception $e) {
            \Log::error('Google OAuth callback failed: ' . $e->getMessage());
            return redirect()->route('login')->withErrors(['google' => 'Authentication failed. Please try again.']);
        }
    }
}

