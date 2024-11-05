<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\SuratKeluarController;

// Redirect root URL to the login page


// Authentication Routes
Route::prefix('auth')->group(function () {
    // Register routes
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('auth.register.form'); // Display the registration form
    Route::post('/register', [AuthController::class, 'register'])->name('auth.register'); // Handle the registration

    // Login routes
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('auth.login.form'); // Display the login form
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login'); // Handle the login

    // Logout route
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum')->name('auth.logout');
});

// Ensure the following routes are only accessible to authenticated users
Route::middleware('auth:sanctum')->group(function () {
    // Surat Masuk routes
    Route::resource('suratMasuk', SuratMasukController::class)->names([
        'index' => 'suratMasuk.index',
        'create' => 'suratMasuk.create',
        'store' => 'suratMasuk.store',
        'show' => 'suratMasuk.show',
        'edit' => 'suratMasuk.edit',
        'update' => 'suratMasuk.update',
        'destroy' => 'suratMasuk.destroy',
    ]);

    // Surat Keluar routes
    Route::resource('suratKeluar', SuratKeluarController::class);
});
