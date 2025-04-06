<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Services\ApiResponse\Facades\ApiResponse;
use App\Services\UserService;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request,UserService $userService)
    {
        $result = $userService->logoutUser();

        if (!$result->ok)
            return ApiResponse::withMessage('Something went wrong. try again later!')->withStatus(500)->send();

        return ApiResponse::withMessage('user logout successfuly')->withStatus(200)->send();
    }
}
