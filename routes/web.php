<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ForumThreadController;



Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::post('/logout',[AuthController::class, 'logout'])->name('logout');

Route::middleware('guest')->group(function () {
    Route::get('/register',[AuthController::class, 'showRegister'])->name('show.register');
    Route::get('/login',[AuthController::class, 'showLogin'])->name('show.login');
    Route::post('/register',[AuthController::class, 'register'])->name('register');
    Route::post('/login',[AuthController::class, 'login'])->name('login');
});


Route::get('/forum', [ForumThreadController::class, 'index'])->name('forum.index');
Route::get('/forum/add', [ForumThreadController::class, 'add'])->name('forum.add');
Route::post('/forum/store', [ForumThreadController::class, 'store'])->name('forum.store');