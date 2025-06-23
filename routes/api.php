<?php

use App\Http\Controllers\Api\UserAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/customer/signup', [UserAuthController::class, 'register']);
Route::post('/customer/login', [UserAuthController::class, 'login']);
Route::post('/customer/checkotp/{member}', [UserAuthController::class, 'checkotp']);