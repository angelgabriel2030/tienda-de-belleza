<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\HeroImageController;
use App\Http\Controllers\Api\SiteTextController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::get('/products',    [ProductController::class, 'index']);
Route::get('/categories',  [CategoryController::class, 'index']);
Route::get('/hero-images', [HeroImageController::class, 'index']);
Route::get('/site-texts',  [SiteTextController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me',      [AuthController::class, 'me']);

    Route::post('/products',         [ProductController::class, 'store']);
    Route::post('/products/{product}', [ProductController::class, 'update']);
    Route::delete('/products/{product}', [ProductController::class, 'destroy']);

    Route::post('/categories/{category}', [CategoryController::class, 'update']);

    Route::post('/hero-images/{slot}', [HeroImageController::class, 'update']);

    Route::put('/site-texts/{key}', [SiteTextController::class, 'update']);
});
