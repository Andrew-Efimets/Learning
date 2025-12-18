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

class SearchController
{
    const PRODUCT_COUNT = 12;

    public function search(Request $request)
    {
        $categories = Category::all();
        $cities = City::all();
        $product = SortService::sortSearchProducts($request)->paginate(self::PRODUCT_COUNT);
        $productImages = ProductImage::all();
        return view('pages.products.search', compact('product', 'productImages', 'categories', 'cities'));
//        return response()->json(array_merge($product->toArray()));

    }
}
