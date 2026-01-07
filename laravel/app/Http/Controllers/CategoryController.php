<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\SortService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    const PRODUCT_COUNT = 12;

    /**
     * Display a listing of the resource.
     */
    public function show(Request $request, Category $category)
    {
        $product = SortService::sortProducts($request)
            ->with('images')
            ->where('category_id', $category->id)
            ->where('status', 0)
            ->paginate(self::PRODUCT_COUNT);

        $cartIds = array_keys(session()->get('cart', []));

        $product->through(function ($item) use ($cartIds) {
            $item->is_in_cart = in_array($item->id, $cartIds);
            return $item;
        });

        return view('pages.categories.show', compact('product','category', 'cartIds'));
    }
}
