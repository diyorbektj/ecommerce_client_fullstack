<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductCommentsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AuthController::class)->prefix('auth')->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout');
    Route::get('/logined', 'logined');
});

//User Service
Route::controller(UserController::class)->prefix('users')->group(function () {
    Route::delete('/{id}', 'destory');
    Route::get('/profile', 'profile');
});

Route::controller(ProductController::class)->prefix('product')->group(function () {
    Route::get('/', 'index');
    Route::get('/filter', 'filterProduct');
    Route::post('/create', 'store');
    Route::patch('/update/{id}', 'update');
    Route::delete('/{id}', 'destroy');
    Route::get('/search', 'SearchProduct');
    Route::get('/{id}', 'show');
});

Route::controller(OrderController::class)->prefix('order')->group(function () {
    Route::get('/', 'index');
    Route::post('/store', 'store');
    Route::put('/user/{id}', 'update');
    Route::delete('/user/{id}', 'destroy');
    Route::get('/buyproduct/{hash}', 'buyproduct');
    Route::get('/myorders', 'myorders');
    Route::get('/{id}', 'show');
});

Route::controller(\App\Http\Controllers\CategoryController::class)->prefix('category')->group(function () {
    Route::get('/', 'index');
    Route::post('/create', 'store');
    Route::put('/update/{id}', 'update');
    Route::delete('/{id}', 'destroy');
    Route::get('/{id}', 'show');
    Route::get('/products/{id}', 'category');
});

Route::resource('/brands', \App\Http\Controllers\BrandController::class);

Route::controller(ProductCommentsController::class)->prefix('comments')->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/add/{id}', 'store');
        Route::post('/like/{id}', 'like');
        Route::get('/likes/{id}', 'getlikes');
    });
    Route::get('/get/{id}', 'show');
});

Route::controller(\App\Http\Controllers\FavoritController::class)->prefix('favorite')->group(function () {
    Route::get('/create', 'store');
    Route::get('/get', 'show');
    Route::delete('/clean_favorite', 'destroy');
});

Route::controller(\App\Http\Controllers\BasketController::class)->prefix('basket')->group(function () {
    Route::get('/create', 'store');
    Route::get('/get', 'show');
    Route::get('/decrement', 'decrement');
    Route::delete('/delete', 'destroy');
    Route::delete('/clean_basket', 'clear_product');
});

Route::controller(\App\Http\Controllers\AddressController::class)->prefix('addresses')->middleware('auth:sanctum')->group(function () {
    Route::post('/create', 'store');
    Route::get('/get', 'show');
    Route::get('/decrement', 'decrement');
    Route::post('/delete', 'destroy');
});

Route::controller(\App\Http\Controllers\SubCategoryController::class)->prefix('subcategory')->group(function () {
    Route::get('/', 'all');
    Route::get('/category/{id}', 'getCategory');
    Route::get('/{id}', 'edit');
    Route::post('/create', 'store');
    Route::patch('/update/{id}', 'update');
    Route::delete('/{id}', 'destroy');
});

Route::get("/generate-guid", [\App\Http\Controllers\GuidController::class, 'generate']);
