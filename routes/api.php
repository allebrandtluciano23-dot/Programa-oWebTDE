<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

Route::get('/health', function () {
    return response()->json(['status' => 'ok']);
});

Route::get('/product/{id}', [ProductController::class, 'show']);
Route::get('/search', [ProductController::class, 'search']);
Route::post('/cart', [CartController::class, 'store']);

Route::middleware('auth.basic')->group(function () {
    Route::post('/products', [ProductController::class, 'store']);
    Route::delete('/product/{id}', [ProductController::class, 'destroy']);
});
