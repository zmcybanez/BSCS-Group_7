<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\PhotoboothController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');

// Photobooth routes
Route::get('/photobooth', [PhotoboothController::class, 'index'])->name('photobooth');
Route::post('/photobooth/capture', [PhotoboothController::class, 'capture'])->name('photobooth.capture');
Route::get('/photobooth/gallery', [PhotoboothController::class, 'gallery'])->name('photobooth.gallery');
