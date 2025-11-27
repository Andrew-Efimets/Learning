<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Services\SortService;
use Illuminate\Http\Request;

class SearchController
{
    const PRODUCT_COUNT = 12;

    protected SortService $sortService;

    public function __construct(SortService $sortService)
    {
        $this->sortService = $sortService;
    }

    public function search(Request $request, SortService $sortService)
    {

        $categories = Category::all();
        $product = $sortService->sortSearchProducts($request)->paginate(self::PRODUCT_COUNT);
        $productImages = ProductImage::all();
        $productItem = $product->toArray();
        return view('pages.products.search', compact('product', 'productImages', 'categories', 'productItem'));
//        return response()->json(array_merge($product->toArray(), $productImages->toArray()));

    }
}
