<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

//buat untuk / pake route name
Route::get('/welcome', function () {
    return view('pages.welcome');
})->name('welcome');


Route::get('/register',[AuthController::class, 'showRegister'])->name('show.register');

Route::get('/register',[AuthController::class, 'showRegister'])->name('show.register');
Route::get('/login',[AuthController::class, 'showLogin'])->name('show.login');

Route::post('/register',[AuthController::class, 'register'])->name('register');
Route::post('/login',[AuthController::class, 'login'])->name('login');


