<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForumThreadController;
use App\Http\Controllers\VisitRequestController;
use App\Http\Controllers\MarketplaceProductController;
use App\Http\Controllers\FavoriteController;


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

Route::get('/visit-requests', [VisitRequestController::class, 'index'])->name('visit_requests.index');

Route::get('/marketplace', function () {
    // Load products from DB (expects table `product` and Product model to be configured)
    // Use the Product model so factories and relationships apply.
    $products = [];
    try {
        $products = \App\Models\Product::where('is_active', true)->get();
    } catch (\Throwable $e) {
        // If DB not available or model/table mismatch, leave products empty.
        $products = collect();
    }

    return view('marketplace.index', compact('products'));
})->name('marketplace');

// Product detail route for marketplace (uses controller we added)
Route::get('/marketplace/{id}', [MarketplaceProductController::class, 'show'])->name('marketplace.show');

// Favorites toggle route (AJAX) - requires auth
Route::post('/favorites/toggle', [FavoriteController::class, 'toggle'])->name('favorites.toggle')->middleware('auth');