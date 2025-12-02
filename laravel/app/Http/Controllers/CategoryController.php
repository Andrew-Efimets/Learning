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

    protected SortService $sortService;

    public function __construct(SortService $sortService)
    {
        $this->sortService = $sortService;
    }

    /**
     * Display a listing of the resource.
     */
    public function show(Request $request, string $id, SortService $sortService)
    {

        $user = Auth::user();
        $categoryItem = Category::where('id', $id)->firstOrFail();
        $categories = Category::all();
        $cities = City::all();
        $product = $sortService->sortProducts($request)->where('category_id', $id)->paginate(self::PRODUCT_COUNT);
        $productImages = ProductImage::all();

        return view('pages.categories.show',
            compact('product', 'productImages', 'categories', 'categoryItem', 'user', 'cities'));

    }
}
