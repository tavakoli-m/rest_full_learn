<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Permission::with('roles')->each(function ($permission) {
            Gate::define($permission->name,function (User $user) use ($permission) {
                return (bool) $permission->roles->intersect($user->roles)->count();
            });
        });
    }
}
