<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class GenerateSlugs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-slugs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate slugs using model names';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("Генерация слагов для категорий...");

        Category::chunk(10, function ($categories) {
            foreach ($categories as $category) {
                $category->update([
                    'slug' => Str::slug($category->name)
                ]);
                $this->line("Категория: {$category->name} -> {$category->slug}");
            }
        });

//        $this->info("Генерация слагов для продуктов...");
//
//        Product::chunk(100, function ($products) {
//            foreach ($products as $product) {
//                $product->update([
//                    'slug' => Str::slug($product->name) . '-' . $product->id
//                ]);
//                $this->line("Продукт: {$product->name} -> {$product->slug}");
//            }
//        });
//
        $this->info('Все слаги обновлены.');
    }
}
