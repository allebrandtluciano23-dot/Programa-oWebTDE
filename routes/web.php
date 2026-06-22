<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;

Route::get('/', [PageController::class, 'home']);
Route::get('/busca', [PageController::class, 'search']);
Route::get('/p/{name}/{id}', [PageController::class, 'product']);
Route::get('/carrinho', [PageController::class, 'cart']);
Route::get('/checkout', [PageController::class, 'checkout'])->middleware('auth');
Route::get('/favoritos', [PageController::class, 'favorites']);

Route::middleware('guest')->group(function () {
    Route::get('/login', [PageController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [PageController::class, 'register']);
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/meus-pedidos', [OrderController::class, 'index']);
    Route::get('/meus-pedidos/{id}', [OrderController::class, 'show']);
    Route::post('/orders', [OrderController::class, 'store']);
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index']);
    Route::get('/produtos/criar', [AdminController::class, 'create']);
    Route::post('/produtos', [AdminController::class, 'store']);
    Route::get('/produtos/{id}/editar', [AdminController::class, 'edit']);
    Route::put('/produtos/{id}', [AdminController::class, 'update']);
    Route::delete('/produtos/{id}', [AdminController::class, 'destroy']);
});