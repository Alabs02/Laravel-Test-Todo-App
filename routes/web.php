<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UserManagementController;

// Auth Routes
Route::group([ 'as' => 'user.'], function () {
    Route::get('/login', [AuthController::class, 'showLoginPage'])->name('login');
    Route::get('/register', [AuthController::class, 'showRegisterPage'])->name('register');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::group([
    'middleware' => 'auth',
    'as' => 'user.'
], function () {
    Route::get('/dashboard', [UserManagementController::class, 'showUserDashboard'])->name('dashboard');
});


