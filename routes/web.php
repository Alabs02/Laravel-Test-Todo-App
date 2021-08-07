<?php

use Illuminate\Support\Facades\Route;

// Auth Routes
Route::group([ 'as' => 'user.'], function () {
    Route::get('/login', [])->name('login');
    Route::get('/register', [])->name('register');
});

