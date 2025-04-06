<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Auth\GetMeController;
use App\Http\Controllers\Auth\LogoutController;

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/me',GetMeController::class);
    Route::delete('/logout',LogoutController::class);

    Route::apiResource('user',UserController::class);
    Route::apiResource('article',ArticleController::class)->only(['index']);
});
