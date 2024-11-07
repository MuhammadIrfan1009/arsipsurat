<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\HomeController;


Route::redirect('/', '/home');

Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::controller(AuthController::class)->group(function () {
    Route::get('/auth/login', 'showLoginForm')->name('login')->middleware('guest'); // Ubah nama rute menjadi 'login'
    Route::post('/auth/login', 'login')->name('auth.login');
    Route::get('/auth/register', 'showRegisterForm')->name('auth.register.form');
    Route::post('/auth/register', 'register')->name('auth.register');
    Route::post('/logout', 'logout')->name('auth.logout');
});


Route::middleware('auth')->group(function () {
    Route::resource('suratMasuk', SuratMasukController::class);

});
