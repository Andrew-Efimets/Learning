<?php

declare (strict_types=1);

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoryController
// {
//     public function index(): void
//     {
//         Category::create([
//             'name' => 'News',
//         ]);

//         $categories = Category::all();

//         echo $categories;
//     }
// }

   {
       public function index(): JsonResponse
       {
           Category::create([
               'name' => 'News',
           ]);

            $categories = Category::all();

            return response()->json($categories);
       }
   }