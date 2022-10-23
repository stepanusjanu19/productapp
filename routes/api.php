<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', App\Http\Controllers\Api\RegisterController::class)->name('register');

Route::post('/login', App\Http\Controllers\Api\AuthController::class)->name('auth');

Route::middleware('auth:api')->group(function () {
    Route::controller(App\Http\Controllers\Api\AuthController::class)->group(function() {
        Route::get('/logout', 'logout');
    });
});



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->group(function () {
    Route::controller(App\Http\Controllers\Api\CategoryController::class)->group(function() {
        Route::get('/category-products', 'index');
        Route::get('/category-products/{id}', 'show');
        Route::post('/category-products', 'store');
        Route::put('/category-products/{id}', 'update');
        Route::delete('/category-products/{id}', 'delete');
    });
});

Route::middleware('auth:api')->group(function () {
    Route::controller(App\Http\Controllers\Api\ProductController::class)->group(function() {
        Route::get('/products', 'index');
        Route::get('/products/{id}', 'show');
        Route::post('/products', 'store');
        Route::put('/products/{id}', 'update');
        Route::delete('/products/{id}', 'delete');
    });
});
