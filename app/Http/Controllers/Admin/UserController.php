<?php

namespace App\Http\Controllers\Admin;

use App\Http\ApiRequests\Admin\User\StoreUserApiRequest;
use App\Http\ApiRequests\Admin\User\UpdateUserApiRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\User\UserDetailsApiResource;
use App\Http\Resources\UsersListApiResourceCollection;
use App\Http\Services\ApiResponse\Facades\ApiResponse;
use App\Models\User;
use App\DatabaseServices\UserService;
use Illuminate\Http\Request;
class UserController extends Controller
{

    public  function __construct(private UserService $userService)
    {

    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $result =  $this->userService->getAllUsers($request->all());

        if(!$result->ok)
            return ApiResponse::withMessage('Something went wrong. try again later!')->withStatus(500)->send();

        return ApiResponse::withData(new UsersListApiResourceCollection($result->data))->send();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserApiRequest $request)
    {
        $result =  $this->userService->registerUser($request->validated());

        if(!$result->ok)
            return ApiResponse::class::withMessage('Something went wrong. try again later!')->withStatus(500)->send();

        return ApiResponse::class::withMessage('User created successfully')->withData($result->data)->send();
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        {
            $result =  $this->userService->getUser($user);

            if(!$result->ok)
                return ApiResponse::class::withMessage('Something went wrong. try again later!')->withStatus(500)->send();

            return ApiResponse::class::withData(new UserDetailsApiResource($result->data))->send();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserApiRequest $request, User $user)
    {
        $result = $this->userService->updateUser($request->validated(),$user);

        if(!$result->ok)
            return ApiResponse::class::withMessage('Something went wrong. try again later!')->withStatus(500)->send();

        return ApiResponse::class::withMessage('User updated successfully')->withData($result->data)->send();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $result = $this->userService->deleteUser($user);

        if(!$result->ok)
            return ApiResponse::class::withMessage('Something went wrong. try again later!')->withStatus(500)->send();

        return ApiResponse::class::withMessage('User deleted successfully')->send();
    }
}
