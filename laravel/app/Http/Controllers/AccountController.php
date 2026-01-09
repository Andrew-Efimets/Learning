<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Services\SortService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    const PRODUCT_COUNT = 12;

    /**
     * Display a listing of the resource.
     */
    public function show(Request $request)
    {
        $productAll = SortService::sortProducts($request)
            ->where('user_id', Auth::id())
            ->with('images');

        $product = (clone $productAll)
            ->where('status', 0)
            ->paginate(self::PRODUCT_COUNT);
        $productSold = (clone $productAll)->where('status', 2)->get();

        return view('pages.account.show', compact('product', 'productSold'));
    }

    public function adminPanel()
    {
        $productCount = Product::all()->count();
        $usersCount = User::all()->count();
        $ordersCount = Order::all()->count();
        $sumTotalPrice = Order::all()->sum('total_price');
        return view('pages.account.admin-panel',
            compact('productCount', 'usersCount', 'ordersCount', 'sumTotalPrice'));
    }
}
