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
Route::post('/reset-password', [PasswordResetController::class, 'update'])->middleware('guest')->name('password.reset.update');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit')->missing(function () {
        return response()->json(['success' => false, 'message' => 'Post not found.'], 404);
    });
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update')->missing(function () {
        return response()->json(['success' => false, 'message' => 'Post not found.'], 404);
    });
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy')->missing(function () {
        return response()->json(['success' => false, 'message' => 'Post not found or already deleted.'], 404);
    });
    Route::post('/posts/{post}/comment', [\App\Http\Controllers\DashboardController::class, 'comment'])->name('posts.comment');
    Route::post('/posts/{post}/toggle-solved', [\App\Http\Controllers\DashboardController::class, 'toggleSolved'])->name('posts.toggle-solved');
    Route::post('/posts/{post}/upvote', [\App\Http\Controllers\DashboardController::class, 'upvotePost'])->name('posts.upvote');
    Route::post('/comments/{comment}/upvote', [\App\Http\Controllers\DashboardController::class, 'upvoteComment'])->name('comments.upvote');
    Route::get('/my-questions', [\App\Http\Controllers\DashboardController::class, 'myQuestions'])->name('my-questions');
    Route::get('/topics/{slug}', [TopicController::class, 'show'])->name('topics.show');
    Route::get('/user/{userId}', [\App\Http\Controllers\DashboardController::class, 'userProfile'])->name('user.profile');
    Route::get('/user/{userId}/online-status', [\App\Http\Controllers\DashboardController::class, 'checkOnlineStatus'])->name('user.online-status');

    // Friends routes
    Route::get('/friends', [FriendsController::class, 'index'])->name('friends');
    Route::get('/friends/search', [FriendsController::class, 'search'])->name('friends.search');
    Route::post('/friends/request', [FriendsController::class, 'sendRequest'])->name('friends.request');
    Route::post('/friends/accept', [FriendsController::class, 'acceptRequest'])->name('friends.accept');
    Route::post('/friends/reject', [FriendsController::class, 'rejectRequest'])->name('friends.reject');

    // Messages routes
    Route::post('/messages/send', [MessagesController::class, 'sendMessage'])->name('messages.send');
    Route::get('/messages/conversation/{user}', [MessagesController::class, 'getConversation'])->name('messages.conversation');
    Route::get('/messages/unread-count', [MessagesController::class, 'getUnreadCount'])->name('messages.unread-count');

    // Notifications routes
    Route::get('/notifications', [\App\Http\Controllers\NotificationController::class, 'index'])->name('notifications');
    Route::get('/notifications/unread-count', [\App\Http\Controllers\NotificationController::class, 'getUnreadCount'])->name('notifications.unread-count');
    Route::get('/notifications/recent', [\App\Http\Controllers\NotificationController::class, 'getRecent'])->name('notifications.recent');
    Route::post('/notifications/{id}/mark-read', [\App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notifications.mark-read');
    Route::post('/notifications/mark-all-read', [\App\Http\Controllers\NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-read');
    Route::delete('/notifications/{id}', [\App\Http\Controllers\NotificationController::class, 'destroy'])->name('notifications.delete');

    // Admin routes (requires admin role)
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\AdminController::class, 'index'])->name('dashboard');
        Route::get('/users', [\App\Http\Controllers\AdminController::class, 'users'])->name('users');
        Route::post('/users/{user}/role', [\App\Http\Controllers\AdminController::class, 'updateUserRole'])->name('users.role');
        Route::post('/users/{user}/toggle-status', [\App\Http\Controllers\AdminController::class, 'toggleUserStatus'])->name('users.toggle-status');
        Route::delete('/users/{user}', [\App\Http\Controllers\AdminController::class, 'deleteUser'])->name('users.delete');
        Route::get('/posts', [\App\Http\Controllers\AdminController::class, 'posts'])->name('posts');
        Route::delete('/posts/{post}', [\App\Http\Controllers\AdminController::class, 'deletePost'])->name('posts.delete');
        Route::get('/categories', [\App\Http\Controllers\AdminController::class, 'categories'])->name('categories');
        Route::post('/categories', [\App\Http\Controllers\AdminController::class, 'storeCategory'])->name('categories.store');
        Route::put('/categories/{category}', [\App\Http\Controllers\AdminController::class, 'updateCategory'])->name('categories.update');
        Route::delete('/categories/{category}', [\App\Http\Controllers\AdminController::class, 'deleteCategory'])->name('categories.delete');
        Route::get('/reports', [\App\Http\Controllers\AdminController::class, 'reports'])->name('reports');
    });

    // Debug route for logout
    Route::get('/debug-logout', function () {
        return response()->json([
            'user' => auth()->user() ? auth()->user()->name : 'Not logged in',
            'csrf_token' => csrf_token(),
            'session_id' => session()->getId()
        ]);
    });
});
