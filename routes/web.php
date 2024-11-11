<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    SuratMasukController,
    HomeController,
    UserApprovalController,
    SuratKeluarController,
    NotaDinasController
};
use App\Http\Middleware\AdminMiddleware;


Route::redirect('/', '/landing'); 

// Landing page 
Route::get('/landing', function () {
    return view('landing');
})->name('landing');

// Home 
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Authentication
Route::controller(AuthController::class)->group(function () {
    Route::get('/auth/login', 'showLoginForm')->name('login')->middleware('guest');
    Route::post('/auth/login', 'login')->name('auth.login');
    Route::get('/auth/register', 'showRegisterForm')->name('auth.register.form');
    Route::post('/auth/register', 'register')->name('auth.register');
    Route::post('/logout', 'logout')->name('auth.logout');
});

// admin appprove user
Route::middleware([AdminMiddleware::class])->group(function () {
    Route::get('/user-approval', [UserApprovalController::class, 'index'])->name('user_approval.index');
    Route::post('/user-approval/{id}/approve', [UserApprovalController::class, 'approve'])->name('user_approval.approve');
});


Route::middleware('auth')->group(function () {

    Route::resource('suratMasuk', SuratMasukController::class)->except(['index', 'show']);
    Route::resource('suratKeluar', SuratKeluarController::class)->except(['index', 'show']);
    Route::resource('notaDinas', NotaDinasController::class)->except(['index', 'show']);
});


Route::resource('suratMasuk', SuratMasukController::class)->only(['index', 'show']);
Route::resource('suratKeluar', SuratKeluarController::class)->only(['index', 'show']);
Route::resource('notaDinas', NotaDinasController::class)->only(['index', 'show']);
