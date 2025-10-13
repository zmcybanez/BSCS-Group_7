<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
// Use fully-qualified names for RateLimiter and ValidationException below to avoid import conflicts

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Preserve rate limiting checks defined on the request
        $request->ensureIsNotRateLimited();

        $credentials = $request->only('email', 'password');

        // Validate credentials without logging in
        if (! Auth::validate($credentials)) {
            // Count this attempt in the rate limiter and return a validation error
            \Illuminate\Support\Facades\RateLimiter::hit($request->throttleKey());

            throw \Illuminate\Validation\ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        // Credentials are valid — log the user in and clear rate limiter
        $user = \App\Models\User::where('email', $request->input('email'))->first();
    Auth::login($user, $request->boolean('remember'));

    \Illuminate\Support\Facades\RateLimiter::clear($request->throttleKey());

        $request->session()->regenerate();

        // Don't force redirect to dashboard — honor intended URL or fallback to dashboard
        return redirect()->intended(route('dashboard'));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
