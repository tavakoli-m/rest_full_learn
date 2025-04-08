<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Auth\GetMeController;
use App\Http\Controllers\Auth\LogoutController;
//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');
//

Route::get('/test',function (){
    return response()->json([
       "id" => 1,
       "message" => "okk",
       "numbers" => [1,2,3,4,5]
    ]);
});

Route::post('/login',\App\Http\Controllers\Auth\LoginController::class);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/me',GetMeController::class);
    Route::delete('/logout',LogoutController::class);

    Route::apiResource('user',UserController::class);
    Route::apiResource('article',ArticleController::class)->only(['index']);
});
