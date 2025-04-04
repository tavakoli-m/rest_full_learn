<?php

namespace App\Providers;

use App\RestFulApi\ApiResponseBuilder;
use Illuminate\Support\ServiceProvider;

class RestFulApiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('ApiResponse', function () {
            return new ApiResponseBuilder();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
