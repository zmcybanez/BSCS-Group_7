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

