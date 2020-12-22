<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Route::prefix('product')->group(function(){
    Route::get('index/{category?}', [ProductController::class,'index']);
    Route::get('index/{id:id_product}/show', [ProductController::class,'show']);
});

Route::prefix('kategori')->group(function(){
    Route::get('index', [CategoryController::class, 'index']);
});

Route::prefix('keranjang')->group(function(){
    Route::post('make', [CartController::class, 'make']);
    Route::get('get', [CartController::class, 'getCart']);
    Route::get('hapus/{id}', [CartController::class, 'deleteCart']);
    Route::patch('store', [CartController::class, 'store']);
});

Route::prefix('admin')->group(function(){
    Route::get('getCarts/{id_buyer?}', [AdminController::class, 'getCarts']);
    Route::get('struct/{search?}', [AdminController::class, 'struct']);
    Route::post('make', [AdminController::class, 'make']);
});

Route::prefix('auth')->group(function(){
    Route::get('init', [AuthController::class, 'init']);
    Route::get('logout', [AuthController::class, 'logout']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});
