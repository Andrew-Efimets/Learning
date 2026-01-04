<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\City;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
//            $categories = Category::all();
            $categories = Cache::remember('categories', now()->addDay(), function () {
                return Category::all();
            });
//            $cities = City::all();
            $cities = Cache::remember('cities', now()->addDay(), function () {
                return City::all();
            });
            $cartCount = count(session()->get('cart', []));
            $view->with(compact('categories', 'cities', 'cartCount'));
        });
    }
}
