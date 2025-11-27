<?php

namespace App\Providers;

use App\Services\SortService;
use Illuminate\Support\ServiceProvider;

class SortServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(SortService::class, function () {
            return new SortService();
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
