<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\brandController;
use App\Http\Controllers\api\cartController;
use App\Http\Controllers\api\categoriesController;
use App\Http\Controllers\api\marketPlaceController;
use App\Http\Controllers\api\ordersController;
use App\Http\Controllers\api\productsController;
use Illuminate\Support\Facades\Route;

//User Auth System

Route::group([
    'prefix' => 'auth'
], function ($router) {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api');
    Route::post('/profile', [AuthController::class, 'profile'])->middleware('auth:api');
});

// Categorey Crud
Route::controller(categoriesController::class)->group(function () {
    Route::get('/categories', 'index');
    Route::get('/categories/{id}', 'show');
    Route::get('/categories/{id}/products', 'products');
    Route::post('/categories', 'store');
    Route::post('/categories/{id}', 'update');
    Route::delete('/categories/{id}', 'destroy');
});


// Brands Crud
Route::controller(brandController::class)->group(function () {
    Route::get('/brands', 'index');
    Route::get('/brands/{id}', 'show');
    Route::get('/brands/{id}/products', 'products');
    Route::post('/brands', 'store');
    Route::post('/brands/{id}', 'update');
    Route::delete('/brands/{id}', 'destroy');
});

// Products Crud
Route::controller(productsController::class)->group(function () {
    Route::get('/products', 'index');
    Route::get('/products/{id}', 'show');
    Route::post('/products', 'store');
    Route::post('/products/{id}', 'update');
    Route::delete('/products/{id}', 'destroy');
});

//cart Controller
Route::controller(cartController::class)->group(function () {
    Route::post('/cart','add_to_cart');
    Route::get('/cart','get_cart');
    Route::delete('/cart','remove_from_cart');
    Route::delete('/cartt','clear_cart');
});


// MarketPlace Crud
Route::controller(marketPlaceController::class)->group(function () {
    Route::get('/marketplace', 'index');
    Route::get('/marketplace/{id}', 'show');
    Route::get('/marketplace/{id}/products', 'products');
    Route::post('/marketplace', 'store');
    Route::post('/marketplace/{id}', 'update');
    Route::delete('/marketplace/{id}', 'destroy');
});

// orders System
Route::controller(ordersController::class)->group(function () {
    Route::get('/orders', 'index');
    Route::get('/orders/{id}', 'show');
    Route::post('/orders', 'store');
    Route::get('/orders/{id}/order_items','get_order_items');
    Route::delete('/orders/{id}', 'destroy');
    Route::get('/orders/user_orders/{id}','get_user_orders');
    Route::post('/orders/{id}/status','change_status');
});

