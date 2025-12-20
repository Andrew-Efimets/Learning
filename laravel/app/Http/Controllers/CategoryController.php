<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Product;
use App\Models\ProductImage;
use App\Services\SortService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController
{
    const PRODUCT_COUNT = 12;

    /**
     * Display a listing of the resource.
     */
    public function show(Request $request, Category $category)
    {
        $product = SortService::sortProducts($request)->where('category_id', $category->id)->paginate(self::PRODUCT_COUNT);

        return view('pages.categories.show', compact('product','category'));
    }
}
