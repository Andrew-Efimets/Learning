<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Carbon;
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
        Carbon::setLocale('ru');
        Paginator::defaultView('vendor.pagination.pagination-custom');

//        Gate::define('update-product', function (User $user, Product $product) {
//            return $user->role === 'admin' || $product->user_id == $user->id;
//        });
//        Gate::define('delete-product', function (User $user, Product $product) {
//            return $user->role === 'admin' || $product->user_id == $user->id;
//        });
    }
}
