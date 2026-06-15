<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('/', [PageController::class, 'home']);
Route::get('/busca', [PageController::class, 'search']);
Route::get('/p/{name}/{id}', [PageController::class, 'product']);
Route::get('/carrinho', [PageController::class, 'cart']);
Route::get('/favoritos', [PageController::class, 'favorites']);
Route::get('/login', [PageController::class, 'login']);