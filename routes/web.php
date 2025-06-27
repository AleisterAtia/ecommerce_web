<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

Route::get('/', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show'])->name('product.show');

Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::get('/category/{id}', [CategoryController::class, 'show'])->name('product.show');


// Route::get('/product/{id}', [ProductController::class, 'show']);
