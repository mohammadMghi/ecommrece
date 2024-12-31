<?php

use App\Http\Controllers\V1\BasketController;
use App\Http\Controllers\V1\CategoriesController;
use App\Http\Controllers\V1\ProductController;
use App\Http\Controllers\V1\ProductSearchController;
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
        
        //categories

        Route::post('/categories' , [CategoriesController::class , 'add'])->middleware('auth:sanctum','admin');
        Route::delete('/categories/{id}' , [CategoriesController::class , 'delete'])->middleware('auth:sanctum','admin'); 
        Route::put('/categories/{id}' , [CategoriesController::class , 'update'])->middleware('auth:sanctum','admin'); 

        //user managment

        Route::post('/users' , [UserController::class , 'add'])->middleware('auth:sanctum','admin');
        Route::put('/users' , [UserController::class , 'update'])->middleware('auth:sanctum','admin');
        Route::delete('/users' , [UserController::class , 'delete'])->middleware('auth:sanctum','admin');
        Route::get('/users' , [UserController::class , 'list'])->middleware('auth:sanctum','admin');
   
    });

    Route::group(['prefix' => 'user'], function () {
        Route::post('/basket' , [BasketController::class , 'add'])->middleware(['auth:sanctum','admin']);
        Route::get('/basket' , [BasketController::class , 'list'])->middleware(['auth:sanctum','admin']);
        Route::delete('/basket/{product_id}' , [BasketController::class , 'delete'])->middleware(['auth:sanctum','admin']);
    });

    Route::get('/products' , [ProductController::class , 'list']);
    Route::get('/products/{id}' , [ProductController::class , 'find']);
   
    Route::get('/categories' , [CategoriesController::class , 'list']);

    //product recommednations
    
    //make order

    //reward system
 
    //notification system

    //search product

    Route::get('/products/search' , [ProductSearchController::class , 'search']);

});