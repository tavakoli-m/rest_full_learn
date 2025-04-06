<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ArticleController;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('user',UserController::class);
    Route::apiResource('article',ArticleController::class)->only(['index']);
});
