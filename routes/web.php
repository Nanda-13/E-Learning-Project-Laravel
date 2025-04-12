<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Social\SocialLoginController;

require_once __DIR__.'/user.php';
require_once __DIR__.'/admin.php';

Route::get('/', function () {
    return view('authentication.login');
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

// Social Login
// Redirect
Route::get('/auth/{provider}/redirect', [SocialLoginController::class, 'redirect']);

// CallBack
Route::get('/auth/{provider}/callback', [SocialLoginController::class, 'callback']);
