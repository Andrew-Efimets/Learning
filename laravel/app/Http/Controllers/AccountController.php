<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
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
        $product = SortService::sortProducts($request)
            ->where('user_id', Auth::id())->paginate(self::PRODUCT_COUNT);

        return view('pages.account.show', compact('product'));
    }

    public function adminPanel()
    {
        $productCount = Product::all()->count();
        $usersCount = User::all()->count();
        return view('pages.account.admin-panel', compact('productCount', 'usersCount'));
    }
}
