<?php

namespace App\Http\Controllers;

use App\Services\SortService;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    const PRODUCT_COUNT = 12;

    public function search(Request $request)
    {
        $product = SortService::sortSearchProducts($request)
            ->with('images')
            ->where('status', 0)
            ->paginate(self::PRODUCT_COUNT);

        $cartIds = array_keys(session()->get('cart', []));

        $product->through(function ($item) use ($cartIds) {
            $item->is_in_cart = in_array($item->id, $cartIds);
            return $item;
        });

        return view('pages.products.search', compact('product', 'cartIds'));
//        return response()->json(array_merge($product->toArray()));

    }
}
