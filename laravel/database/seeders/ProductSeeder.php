<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        for ($i = 0; $i < 100; $i++) {
            DB::table('products')->insert([
                'name' => 'product name ' . $i,
                'price' => rand(1, 1000),
                'category_id' => rand(1, 6),
            ]);
        }
    }
}
