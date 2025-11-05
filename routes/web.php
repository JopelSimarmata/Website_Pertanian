<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Homepage (named so `route('home')` works)
Route::get('/', function () {
    return view('pages.home');
})->name('home');

// Simple stubs for pages referenced in the navbar. Replace with real controllers/views later.
Route::get('/forum', function () {
    return view('pages.forum');
})->name('forum.index');

Route::get('/marketplace', function () {
    return view('pages.market');
})->name('market.index');

// Authentication pages (use existing AuthController if implemented). Name routes to match navbar helpers.
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');


 