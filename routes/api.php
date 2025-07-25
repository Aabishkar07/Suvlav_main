<?php

use App\Http\Controllers\Api\ApiAddressContoller;
use App\Http\Controllers\Api\ApiCategoryController;
use App\Http\Controllers\Api\ApiCheckoutController;
use App\Http\Controllers\Api\ApiOrderController;
use App\Http\Controllers\Api\ApiProductController;
use App\Http\Controllers\Api\ApiSupportController;
use App\Http\Controllers\Api\ApiTransactionController;
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
Route::post('/updatepassword/{id}', [UserAuthController::class, 'updatePassword']);

Route::post('/googlelogin', [UserAuthController::class, 'googlelogin']);

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
Route::post('/wishlist', [ApiProductController::class, 'wishlist']);
Route::get('/wishlist/check', [ApiProductController::class, 'checkWishlist']);
Route::get('/wishlist/products/{userId}', [ApiProductController::class, 'getWishlistProducts']);

Route::get('/order/{userId}', [ApiOrderController::class, 'order']);
Route::get('/ongoingorder/{userId}', [ApiOrderController::class, 'ongoingorder']);
Route::get('/deliveredorder/{userId}', [ApiOrderController::class, 'deliveredorder']);
Route::get('/cancelledorder/{userId}', [ApiOrderController::class, 'cancelledorder']);
Route::get('/exchange/{userId}', [ApiOrderController::class, 'exchange']);
Route::post('/exchangeupdate', [ApiOrderController::class, 'exchangeupdate']);
Route::post('/referralcode/{userId}', [ApiOrderController::class, 'referralcode'])->name('referralcode');


Route::get('/allcategory', [ApiCategoryController::class, 'allcategory']);
Route::get('/category/{category}', [ApiCategoryController::class, 'singlecategory']);
Route::get('/categorywiseproduct/{category}', [ApiCategoryController::class, 'categorywiseproduct']);
Route::get('/alladdress', [ApiAddressContoller::class, 'getaddress']);
Route::get('/shippingaddress/{userid}', [ApiAddressContoller::class, 'shippingaddress']);
Route::post('/shippingaddress/{userid}', [ApiAddressContoller::class, 'updateshippingaddress']);
Route::post('/placeorder', [ApiCheckoutController::class, 'placeorder']);

// transaction pin 
Route::post('/addpin/{id}', [ApiTransactionController::class, 'addpin']);
Route::get('/checkpin/{id}', [ApiTransactionController::class, 'checkpin']);
Route::post('/changepin/{id}', [ApiTransactionController::class, 'changepin']);
Route::post('/checkuser/{unique_id}', [ApiTransactionController::class, 'checkuser']);
Route::post('/transferpoint/{id}', [ApiTransactionController::class, 'transferpoint']);
Route::post('/checkuserpin/{id}', [ApiTransactionController::class, 'checkuserpin']);

Route::get('/getnotification/{user_id}', [ApiTransactionController::class, 'getnotification']);
