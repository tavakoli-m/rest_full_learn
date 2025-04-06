<?php

namespace App\Http\Controllers\Auth;

use App\Http\ApiRequests\Auth\LoginApiRequest;
use App\Http\Controllers\Controller;
use App\Http\Services\ApiResponse\Facades\ApiResponse;
use App\Services\UserService;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginApiRequest $request,UserService $userService)
    {
        $result = $userService->loginUser($request->validated());

        if (!$result->ok)
            return ApiResponse::withMessage('Something went wrong. try again later!')->withStatus(500)->send();

        if($result->data === false)
            return ApiResponse::withMessage('client data not correct !!')->withStatus(401)->send();

        return ApiResponse::withMessage('user logged in successfuly')->withData([
            'token' => $result->data
        ])->withStatus(200)->send();
    }
}
