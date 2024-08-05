<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;

class BindingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            'App\Services\AdminUserService\AdminUserService',
            'App\Services\AdminUserService\AdminUserServiceImpl'
        );

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
