<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForumThreadController;
use App\Http\Controllers\VisitRequestController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;

/*
|--------------------------------------------------------------------------
| Authentication via Google
|--------------------------------------------------------------------------
*/
Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);

Route::get('/fpassword', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/fpassword', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/test-api', function () {
    return view('test-api');
})->name('test.api');

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
| Forum (Public Read, Auth for Write)
|--------------------------------------------------------------------------
*/
Route::get('/forum', [ForumThreadController::class, 'index'])->name('forum.index');
Route::get('/forum/{id}', [ForumThreadController::class, 'detail'])->whereNumber('id')->name('forum.detail');

Route::middleware('auth')->group(function () {
    Route::get('/forum/add', [ForumThreadController::class, 'add'])->name('forum.add');
    Route::post('/forum/store', [ForumThreadController::class, 'store'])->name('forum.store');
    Route::get('/forum/{id}/edit', [ForumThreadController::class, 'edit'])->whereNumber('id')->name('forum.edit');
    Route::put('/forum/{id}', [ForumThreadController::class, 'update'])->whereNumber('id')->name('forum.update');
    Route::delete('/forum/{id}', [ForumThreadController::class, 'destroy'])->whereNumber('id')->name('forum.destroy');
    Route::post('/forum/{id}/like', [ForumThreadController::class, 'toggleLike'])->whereNumber('id')->name('forum.toggle-like');
    Route::post('/forum/{id}/dislike', [ForumThreadController::class, 'toggleDislike'])->whereNumber('id')->name('forum.toggle-dislike');
    Route::post('/forum/{id}/toggle-solved', [ForumThreadController::class, 'toggleSolved'])->whereNumber('id')->name('forum.toggle-solved');
    Route::post('/forum/{id}/reply', [ForumThreadController::class, 'storeReply'])->whereNumber('id')->name('forum.reply');
    Route::post('/forum/reply/{id}/toggle-solution', [ForumThreadController::class, 'markAsSolution'])->whereNumber('id')->name('forum.toggle-solution');
});

/*
|--------------------------------------------------------------------------
| Profile (Requires Authentication)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    // API for Indonesia regions
    Route::get('/api/provinces', [ProfileController::class, 'getProvinces'])->name('api.provinces');
    Route::get('/api/regencies/{provinceId}', [ProfileController::class, 'getRegencies'])->name('api.regencies');
    Route::get('/api/districts/{regencyId}', [ProfileController::class, 'getDistricts'])->name('api.districts');
});

/*
|--------------------------------------------------------------------------
| Visit Requests (All Requires Authentication)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/visit-requests', [VisitRequestController::class, 'index'])->name('visit_requests.index');
    Route::get('/visit-requests/create', [VisitRequestController::class, 'create'])->name('visit_requests.create');
    Route::post('/visit-requests', [VisitRequestController::class, 'store'])->name('visit_requests.store');
    Route::get('/visit-requests/{id}', [VisitRequestController::class, 'show'])->whereNumber('id')->name('visit_requests.show');
    Route::post('/visit-requests/{id}/approve', [VisitRequestController::class, 'approve'])->whereNumber('id')->name('visit_requests.approve');
    Route::post('/visit-requests/{id}/reject', [VisitRequestController::class, 'reject'])->whereNumber('id')->name('visit_requests.reject');
    Route::post('/visit-requests/{id}/cancel', [VisitRequestController::class, 'cancel'])->whereNumber('id')->name('visit_requests.cancel');
});

/*
|--------------------------------------------------------------------------
| Notifications
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/unread', [NotificationController::class, 'getUnread'])->name('notifications.unread');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
    Route::delete('/notifications/{id}', [NotificationController::class, 'delete'])->name('notifications.delete');
});

/*
|--------------------------------------------------------------------------
| Marketplace (Public Read, Auth for Write)
|--------------------------------------------------------------------------
*/
Route::get('/marketplace', [ProductController::class, 'index'])->name('marketplace');
Route::get('/marketplace/{id}', [ProductController::class, 'show'])->whereNumber('id')->name('marketplace.detail');

Route::middleware('auth')->group(function () {
    Route::get('/marketplace/upload', [ProductController::class, 'create'])->name('marketplace.upload');
    Route::post('/marketplace/upload', [ProductController::class, 'store'])->name('marketplace.upload.store');
    Route::post('/marketplace/{id}/review', [ProductController::class, 'storeReview'])->whereNumber('id')->name('marketplace.review.store');
});

/*
|--------------------------------------------------------------------------
| Farmer Dashboard (Requires Authentication & Petani Role)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/dashboard/farmer', [DashboardController::class, 'farmer'])->name('dashboard.farmer');
    Route::get('/dashboard/farmer/product/create', [DashboardController::class, 'createProduct'])->name('dashboard.farmer.product.create');
    Route::post('/dashboard/farmer/product', [DashboardController::class, 'storeProduct'])->name('dashboard.farmer.product.store');
    Route::get('/dashboard/farmer/product/{id}/edit', [DashboardController::class, 'editProduct'])->whereNumber('id')->name('dashboard.farmer.product.edit');
    Route::put('/dashboard/farmer/product/{id}', [DashboardController::class, 'updateProduct'])->whereNumber('id')->name('dashboard.farmer.product.update');
    Route::delete('/dashboard/farmer/product/{id}', [DashboardController::class, 'destroyProduct'])->whereNumber('id')->name('dashboard.farmer.product.destroy');
});

/*
|--------------------------------------------------------------------------
| Orders (Requires Authentication)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/orders/{order:invoice_number}', [OrderController::class, 'show'])->name('orders.show');
});

/*
|--------------------------------------------------------------------------
| Payments (Public callbacks for Midtrans, Auth for user actions)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/payments/create', [PaymentController::class, 'create'])->name('payments.create');
    Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');
    Route::get('/payment/success', [PaymentController::class, 'success'])->name('payments.success');
});


// Public endpoints for Midtrans webhooks
Route::post('/payment/notification', [PaymentController::class, 'handleCallback']);
Route::post('/payment/callback', [PaymentController::class, 'handleCallback'])->name('payment.callback');

/*
|--------------------------------------------------------------------------
| Public API Endpoints
|--------------------------------------------------------------------------
*/
Route::prefix('api')->group(function () {
    // AUTH - API mirror (JSON responses)
    Route::post('/auth/register', [AuthController::class, 'apiRegister'])->name('api.auth.register');
    Route::post('/auth/login', [AuthController::class, 'apiLogin'])->name('api.auth.login');
    Route::post('/auth/logout', [AuthController::class, 'apiLogout'])->name('api.auth.logout');

    // READ - Get all products with pagination and filters
    Route::get('/products', [ProductController::class, 'apiGetProducts'])->name('api.products');
    
    // READ - Get single product by ID
    Route::get('/products/{id}', [ProductController::class, 'apiGetProduct'])->name('api.product');
    
    // READ - Get product prices only (lightweight endpoint)
    Route::get('/prices', [ProductController::class, 'apiGetPrices'])->name('api.prices');
    
    // READ - Get product categories
    Route::get('/categories', [ProductController::class, 'apiGetCategories'])->name('api.categories');
    
    // CREATE - Add new product (for testing)
    Route::post('/products', [ProductController::class, 'apiCreateProduct'])->name('api.products.create');
    
    // UPDATE - Update product (for testing)
    Route::put('/products/{id}', [ProductController::class, 'apiUpdateProduct'])->name('api.products.update');
    Route::patch('/products/{id}', [ProductController::class, 'apiUpdateProduct'])->name('api.products.patch');
    
    // DELETE - Delete product (for testing)
    Route::delete('/products/{id}', [ProductController::class, 'apiDeleteProduct'])->name('api.products.delete');
});