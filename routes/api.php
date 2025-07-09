<?php

use App\Http\Controllers\Api\ApiCategoryController;
use App\Http\Controllers\Api\ApiProductController;
use App\Http\Controllers\Api\ApiSupoortController;
use App\Http\Controllers\Api\ApiSupportController;
use App\Http\Controllers\Api\UserAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/customer/signup', [UserAuthController::class, 'register']);
Route::post('/customer/login', [UserAuthController::class, 'login']);
Route::post('/customer/checkotp/{member}', [UserAuthController::class, 'checkotp']);
Route::post('/forgotpasswords', [UserAuthController::class, 'forgotpasswords'])->name('forgotpasswords');
Route::post('/changepassword', [UserAuthController::class, 'changepassword'])->name('changepassword');
Route::post('/resendotp', [UserAuthController::class, 'resendOtp'])->name('resendotp');
Route::get('/getuserdata/{id}', [UserAuthController::class, 'getuserdata'])->name('getuserdata');
Route::put('/updateuserdata/{id}', [UserAuthController::class, 'updateuserdata'])->name('updateuserdata');

Route::get('/getsupport', [ApiSupportController::class, 'getsupport'])->name('getsupport');
Route::post('/getemail', [ApiSupportController::class, 'getemail'])->name('getemail');
Route::get('/getprivacypolicy', [ApiSupportController::class, 'getprivacypolicy']);
Route::get('/gettermsandcondition', [ApiSupportController::class, 'gettermsandcondition']);
Route::get('/exchangepolicies', [ApiSupportController::class, 'exchangepolicies']);
Route::get('/aboutus', [ApiSupportController::class, 'aboutus']);

Route::get('/allproduct', [ApiProductController::class, 'allproduct']);
Route::get('/product/{product}', [ApiProductController::class, 'singlepage']);
Route::get('/review/{product}/{user}', [ApiProductController::class, 'productreview']);
Route::post('/review/{product}/{user}', [ApiProductController::class, 'postproductreview']);
Route::post('/wishlist', [ApiProductController::class, 'wishlist'])->name('wishlist');
Route::get('/wishlist/check', [ApiProductController::class, 'checkWishlist']);
Route::get('/wishlist/products/{userId}', [ApiProductController::class, 'getWishlistProducts']);

Route::get('/allcategory', [ApiCategoryController::class, 'allcategory']);
Route::get('/category/{category}', [ApiCategoryController::class, 'singlecategory']);
Route::get('/categorywiseproduct/{category}', [ApiCategoryController::class, 'categorywiseproduct']);
