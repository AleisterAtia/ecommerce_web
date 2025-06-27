<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;

Route::get('/', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show'])->name('product.show');

Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add')->middleware('auth');

Route::get('/category/{id}', [CategoryController::class, 'show'])->name('product.show');
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

Route::get('/login', function () {
    return redirect('/admin');
})->name('login');

Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store')->middleware('auth');

// Route untuk halaman sukses setelah checkout
Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success')->middleware('auth');

Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
// Route::get('/product/{id}', [ProductController::class, 'show']);
