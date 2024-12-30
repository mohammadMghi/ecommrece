<?php

use App\Http\Controllers\V1\BasketController;
use App\Http\Controllers\V1\ProductController;
use App\Http\Controllers\V1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::group(['prefix' => 'v1'], function () {
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/register', [UserController::class, 'register']);
    
    Route::group(['prefix' => 'admin'], function () {
        Route::post('/products' , [ProductController::class , 'create'])->middleware(['auth:sanctum','admin']);
        Route::put('/products/{id}' , [ProductController::class , 'update'])->middleware(['auth:sanctum','admin']);
        Route::delete('/products/{id}' , [ProductController::class , 'delete'])->middleware(['auth:sanctum','admin']);
    });

    Route::group(['prefix' => 'user'], function () {
        Route::post('/basket' , [BasketController::class , 'add'])->middleware(['auth:sanctum','admin']);
        Route::get('/basket' , [BasketController::class , 'list'])->middleware(['auth:sanctum','admin']);
        Route::delete('/basket/{product_id}' , [BasketController::class , 'delete'])->middleware(['auth:sanctum','admin']);
    });

    Route::get('/products' , [ProductController::class , 'list']);
    Route::get('/products/{id}' , [ProductController::class , 'find']);
});