<?php

namespace App\Providers;

use Laravel\Dusk\DuskServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningUnitTests()) {
            Schema::defaultStringLength(191);
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local', 'testing')) {
            $this->app->register(DuskServiceProvider::class);
        }
        $this->app->bind(
            'App\Contracts\API\v1\RoleInterface',
            'App\Services\API\v1\RoleService'
        );
        $this->app->bind(
            'App\Contracts\API\v1\PermissionInterface',
            'App\Services\API\v1\PermissionService'
        );
        $this->app->bind(
            'App\Contracts\API\v1\NotificationInterface',
            'App\Services\API\v1\NotificationService'
        );
        $this->app->bind(
            'App\Contracts\API\v1\EmailsInterface',
            'App\Services\API\v1\EmailsService'
        );
    }
}
