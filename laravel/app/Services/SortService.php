<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class SortService
{
    public static function sortProducts(Request $request)
    {
        $query = Product::query();

        return match ($request->input('sort')) {
            'created_at_asc' => $query->orderBy('created_at', 'asc'),
            'price_asc'      => $query->orderBy('price', 'asc'),
            'price_desc'     => $query->orderBy('price', 'desc'),
            'name_asc'       => $query->orderBy('name', 'asc'),
            'name_desc'      => $query->orderBy('name', 'desc'),
            default          => $query->orderBy('created_at', 'desc'),
        };
    }

    public static function sortSearchProducts(Request $request)
    {
        $query = self::sortProducts($request);
        if ($search = $request->input('search')) {
            $query->where('name', 'like', "%{$search}%");
        }

        return $query;

    }
}
