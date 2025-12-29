<?php

namespace App\Http\Controllers;

use App\Services\SortService;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    const PRODUCT_COUNT = 12;

    public function search(Request $request)
    {
        $product = SortService::sortSearchProducts($request)->paginate(self::PRODUCT_COUNT);
        return view('pages.products.search', compact('product'));
//        return response()->json(array_merge($product->toArray()));

    }
}
