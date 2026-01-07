<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schedule;
use App\Models\Product;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::call(function () {
    $expiredProducts = Product::where('status', 1)
        ->where('updated_at', '<', now()->subMinutes(10))
        ->get();

    if ($expiredProducts->isNotEmpty()) {
        Product::whereIn('id', $expiredProducts->pluck('id'))
            ->update(['status' => 0]);

        Cache::flush();
    }
})->everyFiveMinutes();
