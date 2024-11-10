<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserApprovalController;
use App\Http\Middleware\AdminMiddleware;


// Redirect root to landing page
Route::redirect('/', '/landing'); // Mengarahkan root ke halaman /landing

// Halaman landing page yang bisa diakses tanpa login
Route::get('/landing', function () {
    return view('landing'); // Menampilkan view landing
})->name('landing');

// Rute untuk halaman home setelah login
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Authentication routes
Route::controller(AuthController::class)->group(function () {
    Route::get('/auth/login', 'showLoginForm')->name('login')->middleware('guest'); // Ubah nama rute menjadi 'login'
    Route::post('/auth/login', 'login')->name('auth.login');
    Route::get('/auth/register', 'showRegisterForm')->name('auth.register.form');
    Route::post('/auth/register', 'register')->name('auth.register');
    Route::post('/logout', 'logout')->name('auth.logout');
});

// Admin routes with AdminMiddleware
Route::middleware([AdminMiddleware::class])->group(function () {
    // User approval routes
    Route::get('/user-approval', [UserApprovalController::class, 'index'])->name('user_approval.index');
    Route::post('/user-approval/{id}/approve', [UserApprovalController::class, 'approve'])->name('user_approval.approve');
});
// Authenticated user routes
Route::middleware('auth')->group(function () {
    // Surat Masuk routes
    Route::resource('suratMasuk', SuratMasukController::class);
});
