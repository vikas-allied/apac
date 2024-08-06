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
        $this->app->bind(
            'App\Services\RoleService\RoleService',
            'App\Services\RoleService\RoleServiceImpl'
        );
        $this->app->bind(
            'App\Services\PermissionService\PermissionService',
            'App\Services\PermissionService\PermissionServiceImpl'
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
