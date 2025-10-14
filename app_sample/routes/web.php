<?php

use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FriendsController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TopicController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Contact form route (public, no auth required)
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::post('/login', [LoginController::class, 'login'])->name('login.post');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/set-password', [ProfileController::class, 'setPassword'])->name('profile.set-password');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/logout', function (Request $request) {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    })->name('logout.get');
});

require __DIR__.'/auth.php';

Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');
Route::get('/forgot-password', [PasswordResetController::class, 'request'])->middleware('guest')->name('password.request');
Route::post('/forgot-password', [PasswordResetController::class, 'email'])->middleware('guest')->name('password.email');
Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetForm'])->middleware('guest')->name('password.reset');
Route::post('/reset-password', [PasswordResetController::class, 'update'])->middleware('guest')->name('password.reset.submit');

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
    Route::get('/debug-logout', function () {
        return response()->json([
            'user' => auth()->user() ? auth()->user()->name : 'Not logged in',
            'csrf_token' => csrf_token(),
            'session_id' => session()->getId()
        ]);
    });
});
