<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('auth.login');
})->name('login');


Route::get('/register',[AuthController::class, 'showRegister'])->name('show.register');
Route::get('/login',[AuthController::class, 'showLogin'])->name('show.login');

Route::post('/register',[AuthController::class, 'register'])->name('register');
Route::post('/login',[AuthController::class, 'login'])->name('login');


