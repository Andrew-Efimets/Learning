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
            ->where('category_id', $category->id)->paginate(self::PRODUCT_COUNT);

        return view('pages.categories.show', compact('product','category'));
    }
}
