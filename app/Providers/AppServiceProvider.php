<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use  App\Http\Controllers\Admin;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->bind('Admin', function ($app) {
            return new App\Http\Controllers\Admin\Admin;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
