<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;
use Throwable;

class GoogleController extends Controller
{
    // Redirect user to Google login
    public function redirect()
    {
        $config = config('services.google');

        if (empty($config['client_id']) || empty($config['client_secret']) || empty($config['redirect'])) {
            Log::error('Google OAuth configuration is incomplete', [
                'config' => $config,
            ]);

            return redirect()->route('login')->withErrors([
                'google' => 'Google sign-in is currently unavailable. Please try again later.',
            ]);
        }

        Log::info('Google OAuth redirect initiated');

        return Socialite::driver('google')->redirect();
    }

    // Handle callback from Google
    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (InvalidStateException $exception) {
            Log::warning('Google OAuth invalid state detected, retrying stateless flow', [
                'message' => $exception->getMessage(),
            ]);

            try {
                $googleUser = Socialite::driver('google')->stateless()->user();
            } catch (GuzzleException $guzzleException) {
                Log::error('Google OAuth stateless flow failed due to network error', [
                    'message' => $guzzleException->getMessage(),
                ]);

                return redirect()->route('login')->withErrors([
                    'google' => 'We could not reach Google to complete the sign-in. Please check your internet connection and try again.',
                ]);
            } catch (Throwable $throwable) {
                Log::error('Google OAuth stateless flow failed', [
                    'message' => $throwable->getMessage(),
                ]);

                return redirect()->route('login')->withErrors([
                    'google' => 'Unable to authenticate with Google at this time. Please try again.',
                ]);
            }
        } catch (GuzzleException $exception) {
            Log::error('Google OAuth network error', [
                'message' => $exception->getMessage(),
            ]);

            return redirect()->route('login')->withErrors([
                'google' => 'We could not reach Google to complete the sign-in. Please check your internet connection and try again.',
            ]);
        } catch (Throwable $exception) {
            Log::error('Google OAuth callback failed', [
                'message' => $exception->getMessage(),
            ]);

            return redirect()->route('login')->withErrors([
                'google' => 'Unable to authenticate with Google at this time. Please try again.',
            ]);
        }

        if (! isset($googleUser)) {
            return redirect()->route('login')->withErrors([
                'google' => 'Unable to authenticate with Google at this time. Please try again.',
            ]);
        }

        // Find existing user or create new one
        $user = User::where('email', $googleUser->getEmail())->first();

        if ($user) {
            // User exists - update their Google info if they signed up via email originally
            if ($user->auth_provider === 'email') {
                $user->update([
                    'google_id' => $googleUser->getId(),
                    'auth_provider' => 'google', // Switch to Google auth
                    'has_password' => false, // They'll need to set a password for manual login
                    'password' => Str::random(40), // Invalidate previous password while satisfying DB constraint
                    'email_verified_at' => $user->email_verified_at ?? now(),
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
                'password' => Str::random(40), // Store random hashed password to satisfy database constraint
                'email_verified_at' => now(),
            ]);
        }

        Auth::login($user);

        return redirect('/dashboard');
    }
}

