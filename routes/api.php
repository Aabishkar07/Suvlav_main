<?php

use App\Http\Controllers\Api\ApiCategoryController;
use App\Http\Controllers\Api\ApiProductController;
use App\Http\Controllers\Api\UserAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/customer/signup', [UserAuthController::class, 'register']);
Route::post('/customer/login', [UserAuthController::class, 'login']);
Route::post('/customer/checkotp/{member}', [UserAuthController::class, 'checkotp']);

Route::get('/allproduct', [ApiProductController::class, 'allproduct']);
Route::get('/product/{product}', [ApiProductController::class, 'singlepage']);
Route::get('/allcategory', [ApiCategoryController::class, 'allcategory']);
Route::get('/category/{category}', [ApiCategoryController::class, 'singlecategory']);
Route::get('/categorywiseproduct/{category}', [ApiCategoryController::class, 'categorywiseproduct']);
