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

class AccountController
{
    const PRODUCT_COUNT = 12;

    /**
     * Display a listing of the resource.
     */
    public function show(Request $request, SortService $sortService)
    {
        $categories = Category::all();
        $cities = City::all();
        $product = SortService::sortProducts($request)->where('user_id', Auth::id())->paginate(self::PRODUCT_COUNT);
        $productImages = ProductImage::all();

        return view('pages.account.show', compact('product', 'productImages', 'categories', 'cities'));

    }
}
