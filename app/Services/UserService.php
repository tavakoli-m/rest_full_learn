<?php

namespace App\Services;

use App\Base\ServiceManager\ServiceManager;
use App\Base\ServiceManager\ServiceResult;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{

    public function getAllUsers(array $inputs) : ServiceResult
    {
        return app(ServiceManager::class)(function() use ($inputs) {
            return User::paginate();
        });
    }
    public function getUser(User $user) : ServiceResult
    {
        return app(ServiceManager::class)(fn() => $user);
    }

    public function registerUser(array $inputs) : ServiceResult
    {
       return app(ServiceManager::class)(function() use ($inputs) {
            $inputs['password'] = Hash::make($inputs['password']);
            return User::create($inputs);
        });
    }
    public function updateUser(array $inputs,User $user) : ServiceResult
    {
       return app(ServiceManager::class)(function() use ($inputs,$user) {
           if(isset($inputs['password']))
               $inputs['password'] = Hash::make($inputs['password']);
           $user->update($inputs);

           return $user;
        });
    }

    public function deleteUser(User $user) : ServiceResult
    {
        return app(ServiceManager::class)(fn() => $user->delete());
    }

    public function loginUser(array $inputs) : ServiceResult
    {
        return app(ServiceManager::class)(function() use ($inputs) {
            if(!auth()->attempt($inputs))
                return false;

            return auth()->user()->createToken('API TOKEN')->plainTextToken;
        });
    }
}
