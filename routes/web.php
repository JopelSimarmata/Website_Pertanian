<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForumThreadController;
use App\Http\Controllers\VisitRequestController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('pages.home');
})->name('home');

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('show.register');
    Route::get('/login', [AuthController::class, 'showLogin'])->name('show.login');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

/*
|--------------------------------------------------------------------------
| Forum
|--------------------------------------------------------------------------
*/
Route::get('/forum', [ForumThreadController::class, 'index'])->name('forum.index');
Route::get('/forum/add', [ForumThreadController::class, 'add'])->name('forum.add');
Route::post('/forum/store', [ForumThreadController::class, 'store'])->name('forum.store');
Route::get('/forum/{id}', [ForumThreadController::class, 'detail'])->name('forum.detail');

/*
|--------------------------------------------------------------------------
| Profile
|--------------------------------------------------------------------------
*/
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

/*
|--------------------------------------------------------------------------
| Visit Requests
|--------------------------------------------------------------------------
*/
Route::get('/visit-requests', [VisitRequestController::class, 'index'])->name('visit_requests.index');

// Create & store (requires login)
Route::middleware('auth')->group(function () {
    Route::get('/visit-requests/create', [VisitRequestController::class, 'create'])->name('visit_requests.create');
    Route::post('/visit-requests', [VisitRequestController::class, 'store'])->name('visit_requests.store');
    Route::post('/visit-requests/{id}/cancel', [VisitRequestController::class, 'cancel'])
        ->whereNumber('id')
        ->name('visit_requests.cancel');
});

// Show / Approve / Reject
Route::get('/visit-requests/{id}', [VisitRequestController::class, 'show'])
    ->whereNumber('id')->name('visit_requests.show');
Route::post('/visit-requests/{id}/approve', [VisitRequestController::class, 'approve'])
    ->whereNumber('id')->name('visit_requests.approve');
Route::post('/visit-requests/{id}/reject', [VisitRequestController::class, 'reject'])
    ->whereNumber('id')->name('visit_requests.reject');

/*
|--------------------------------------------------------------------------
| Payments
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/payments/create', [PaymentsController::class, 'create'])->name('payments.create');
    Route::post('/payments', [PaymentsController::class, 'store'])->name('payments.store');
});

/*
|--------------------------------------------------------------------------
| Marketplace
|--------------------------------------------------------------------------
*/
Route::get('/marketplace', [ProductController::class, 'index'])->name('marketplace');
Route::get('/marketplace/{id}', [ProductController::class, 'show'])->name('marketplace.detail');

// Product upload (only for logged-in farmers)
Route::middleware('auth')->group(function () {
    Route::get('/marketplace/upload', [ProductController::class, 'create'])->name('marketplace.upload');
    Route::post('/marketplace/upload', [ProductController::class, 'store'])->name('marketplace.upload.store');
});

/*
|--------------------------------------------------------------------------
| Farmer Dashboard
|--------------------------------------------------------------------------
*/
Route::get('/dashboard/farmer', [DashboardController::class, 'farmer'])
    ->middleware('auth')
    ->name('dashboard.farmer');


Route::get('payment/success',function(){
    echo "Payment success page";
});

Route::get('/orders/{order:invoice_number}', [OrderController::class, 'show'])->name('orders.show');

