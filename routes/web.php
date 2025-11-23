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
Route::post('/visit-requests/{id}/approve', [VisitRequestController::class, 'approve'])->name('visit_requests.approve');
Route::post('/visit-requests/{id}/reject', [VisitRequestController::class, 'reject'])->name('visit_requests.reject');

// Create / store visit request (buyer action)
Route::get('/visit-requests/create', [VisitRequestController::class, 'create'])->name('visit_requests.create')->middleware('auth');
Route::post('/visit-requests', [VisitRequestController::class, 'store'])->name('visit_requests.store')->middleware('auth');

Route::get('/marketplace', [App\Http\Controllers\ProductController::class, 'index'])->name('marketplace');

// Product upload (for Petani)
Route::middleware('auth')->group(function () {
    Route::get('/marketplace/upload', [App\Http\Controllers\ProductController::class, 'create'])->name('marketplace.upload');
    Route::post('/marketplace/upload', [App\Http\Controllers\ProductController::class, 'store'])->name('marketplace.upload.store');
});

Route::get('/marketplace/{id}', function ($id) {
    return view('marketplace.detail', ['id' => $id]);
})->name('marketplace.detail');