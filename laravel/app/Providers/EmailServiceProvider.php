<?php

namespace App\Providers;

use App\Models\Order;
use App\Models\Product;
use App\Observers\OrdersObserver;
use App\Observers\ProductObserver;
use Illuminate\Support\ServiceProvider;

class EmailServiceProvider extends ServiceProvider
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
        Product::observe(ProductObserver::class);
        Order::observe(OrdersObserver::class);
    }
}
