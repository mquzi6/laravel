<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/catalog', [ProductController::class, 'index'])->name('products.index');
Route::get('/catalog/{product}', [ProductController::class, 'show'])->name('products.show');

Auth::routes();

Route::middleware('auth')->group(function() {
    Route::get('/cart', [OrderController::class, 'cart'])->name('orders.cart');
    Route::post('/cart/add/{product}', [OrderController::class, 'addToCart'])->name('orders.add');
    Route::delete('/cart/remove/{id}', [OrderController::class, 'remove'])->name('orders.remove');
    Route::get('/payment', [OrderController::class, 'payment'])->name('orders.payment');
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('orders.checkout');
    Route::get('/orders/history', [OrderController::class, 'history'])->name('orders.history');
    Route::post('/catalog/{product}/review', [ReviewController::class, 'store'])->name('reviews.store');
});