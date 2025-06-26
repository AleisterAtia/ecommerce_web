<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

use App\Models\Product;

Route::get('/', [ProductController::class, 'index']);



// Route::get('/product/{id}', [ProductController::class, 'show']);
