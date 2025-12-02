<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Http\Request;

class SortService
{
    public function sortProducts(Request $request)
    {
        $query = Product::query();

        switch ($request->input('sort')) {
            case 'created_at_asc':
                $query->orderBy('created_at', 'asc');
                break;
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        return $query;

    }

    public function sortSearchProducts(Request $request)
    {
        $query = $this->sortProducts($request);

        if ($search = $request->input('search')) {
            $query->where('name', 'like', "%{$search}%");
        }

        return $query;

    }
}
