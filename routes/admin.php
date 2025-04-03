<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\UserController;

Route::apiResource('user',UserController::class);
