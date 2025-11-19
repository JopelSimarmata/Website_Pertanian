<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForumThreadController;
use App\Http\Controllers\VisitRequestController;


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
Route::get('/forum/{id}', [ForumThreadController::class, 'detail'])->name('forum.detail');

Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
Route::post('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

Route::get('/visit-requests', [VisitRequestController::class, 'index'])->name('visit_requests.index');

Route::get('/marketplace', function () {
    return view('marketplace.index');
})->name('marketplace');

Route::get('/marketplace/{id}', function ($id) {
    return view('marketplace.detail', ['id' => $id]);
})->name('marketplace.detail');