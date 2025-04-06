<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Services\ApiResponse\Facades\ApiResponse;
use Illuminate\Http\Request;

class GetMeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return ApiResponse::withStatus(200)->withData([
            'user' => auth()->user()
        ])->send();
    }
}
