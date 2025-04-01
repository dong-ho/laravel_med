<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
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
        //
        Paginator::useBootstrap(); ///resources/views/vendor/pagination/bootstrap-4
        //Paginator::useBootstrapFive(); ///resources/views/vendor/pagination/bootstrap-5
        //Paginator::defaultView('pagination::custom'); ///resources/views/vendor/pagination/custom
    }

}
