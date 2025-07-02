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
<<<<<<< HEAD
Route::post('/forgotpasswords', [UserAuthController::class, 'forgotpasswords'])->name('forgotpasswords');
Route::post('/changepassword', [UserAuthController::class, 'changepassword'])->name('changepassword');
Route::post('/resendotp', [UserAuthController::class, 'resendOtp'])->name('resendotp');
=======

Route::get('/allproduct', [ApiProductController::class, 'allproduct']);
Route::get('/product/{product}', [ApiProductController::class, 'singlepage']);
Route::get('/allcategory', [ApiCategoryController::class, 'allcategory']);
Route::get('/category/{category}', [ApiCategoryController::class, 'singlecategory']);
Route::get('/categorywiseproduct/{category}', [ApiCategoryController::class, 'categorywiseproduct']);
>>>>>>> ea71a7019e9985d9b12439397bcc2481bfaafb48
