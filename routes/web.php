<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ForumThreadController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register',[AuthController::class, 'showRegister'])->name('show.register');
Route::get('/login',[AuthController::class, 'showLogin'])->name('show.login');

Route::post('/register',[AuthController::class, 'showRegister'])->name('register');
Route::post('/login',[AuthController::class, 'showLogin'])->name('login');

Route::get('/forum', [ForumThreadController::class, 'index'])->name('forum.index');
Route::get('/forum/add', [ForumThreadController::class, 'add'])->name('forum.add');
Route::post('/forum/store', [ForumThreadController::class, 'store'])->name('forum.store');