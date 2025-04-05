<?php

namespace App\Services;

use App\Base\DatabaseServiceManger\DatabaseServiceResult;
use App\Base\DatabaseServiceManger\DatabaseServiceManager;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{

    public function getAllUsers(array $inputs) : DatabaseServiceResult
    {
        return app(DatabaseServiceManager::class)(function() use ($inputs) {
            return User::paginate();
        });
    }
    public function getUser(User $user) : DatabaseServiceResult
    {
        return app(DatabaseServiceManager::class)(fn() => $user);
    }

    public function registerUser(array $inputs) : DatabaseServiceResult
    {
       return app(DatabaseServiceManager::class)(function() use ($inputs) {
            $inputs['password'] = Hash::make($inputs['password']);
            return User::create($inputs);
        });
    }
    public function updateUser(array $inputs,User $user) : DatabaseServiceResult
    {
       return app(DatabaseServiceManager::class)(function() use ($inputs,$user) {
           if(isset($inputs['password']))
               $inputs['password'] = Hash::make($inputs['password']);
           $user->update($inputs);

           return $user;
        });
    }

    public function deleteUser(User $user) : DatabaseServiceResult
    {
        return app(DatabaseServiceManager::class)(fn() => $user->delete());
    }
}
