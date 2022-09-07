<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;

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


Route::post('/auth/token',[TokenController::class,'store']);

Route::post('/login',[AuthController::class, 'login']);
Route::post('/register',[AuthController::class, 'register']);


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user',[AuthController::class, 'user']);
    Route::post('/logout',[AuthController::class, 'logout']);
    Route::get('/products',[ProductController::class,'getProducts']);
    Route::get('/products/{id}',[ProductController::class,'getProductsByCategory']);
    Route::get('/categories',[CategoryController::class,'getCategories']);
    Route::post('/checkout',[CheckoutController::class,'addProduct']);
    Route::post('/order',[CheckoutController::class,'order']);
    Route::get('/checkout',[CheckoutController::class,'getCheckout']);
});
