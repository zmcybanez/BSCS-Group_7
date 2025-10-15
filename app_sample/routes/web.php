<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/welcome', function () {
    \Log::info("Request received: " . request()->method() . " " . request()->path());
    return response()->json(['message' => 'Welcome to the Laravel API Service!']);
});

// Contact form route (public, no auth required)
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Use auth routes in routes/auth.php (Breeze Auth controllers)
// The POST /login route is registered in routes/auth.php and handled by
// App\Http\Controllers\Auth\AuthenticatedSessionController@store

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/set-password', [ProfileController::class, 'setPassword'])->name('profile.set-password');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.redirect');
// Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');

Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');


use App\Http\Controllers\PostController;
use App\Http\Controllers\FriendsController;
use App\Http\Controllers\MessagesController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::post('/posts/{post}/comment', [\App\Http\Controllers\DashboardController::class, 'comment'])->name('posts.comment');
    Route::post('/posts/{post}/toggle-solved', [\App\Http\Controllers\DashboardController::class, 'toggleSolved'])->name('posts.toggle-solved');
    Route::get('/my-questions', [\App\Http\Controllers\DashboardController::class, 'myQuestions'])->name('my-questions');
    Route::get('/topics/{slug}', [TopicController::class, 'show'])->name('topics.show');

    // Friends routes
    Route::get('/friends', [FriendsController::class, 'index'])->name('friends');
    Route::post('/friends/request', [FriendsController::class, 'sendRequest'])->name('friends.request');
    Route::post('/friends/accept', [FriendsController::class, 'acceptRequest'])->name('friends.accept');
    Route::post('/friends/reject', [FriendsController::class, 'rejectRequest'])->name('friends.reject');

    // Messages routes
    Route::post('/messages/send', [MessagesController::class, 'sendMessage'])->name('messages.send');
    Route::get('/messages/conversation/{user}', [MessagesController::class, 'getConversation'])->name('messages.conversation');
    Route::get('/messages/unread-count', [MessagesController::class, 'getUnreadCount'])->name('messages.unread-count');

    // Debug route for logout
    Route::get('/debug-logout', function() {
        return response()->json([
            'user' => auth()->user() ? auth()->user()->name : 'Not logged in',
            'csrf_token' => csrf_token(),
            'session_id' => session()->getId()
        ]);
    });
});

// Local-only debug route to test authentication and inspect password hashes.
// Only enabled when APP_ENV=local to avoid exposing sensitive info.
if (app()->environment('local')) {
    Route::get('/debug-login', function () {
        $email = 'bypass@example.com';
        $password = 'BypassPass123!';

        $hash = \Illuminate\Support\Facades\DB::table('users')->where('email', $email)->value('password');
        $attempt = \Illuminate\Support\Facades\Auth::attempt(['email' => $email, 'password' => $password]);

        return response()->json([
            'email' => $email,
            'attempt' => $attempt,
            'hash_prefix' => $hash ? substr($hash, 0, 6) : null,
            'hash_length' => $hash ? strlen($hash) : 0,
            'hash_info' => $hash ? \Illuminate\Support\Facades\Hash::driver()->info($hash) : null,
        ]);
    });
}
