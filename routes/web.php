<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/register', [AuthController::])->name('show.register');
