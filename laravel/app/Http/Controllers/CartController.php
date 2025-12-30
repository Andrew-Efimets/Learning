<?php

namespace App\Http\Controllers;

use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = session()->get('cart', []);
        $product = collect($cartItems);
        $totalPrice = collect($product)->sum('price');
        $orders = auth()->user()->orders;
        return view('pages.account.cart',
            compact('product', 'totalPrice', 'orders'));
    }

    public function add($id)
    {
        $product = Product::find($id);
        $cart = session()->get('cart', []);
        $cart[$id] = [
            "id" => $product->id,
            "name" => $product->name,
            "quantity" => 1,
            "price" => $product->price,
            "created_at" => $product->created_at,
            "images" => $product->images->first()?->product_image,
        ];

        session()->put('cart', $cart);

        return response()->json([
            'message' => 'Товар добавлен!',
            'cart_count' => count($cart),
            'total_price' => collect($cart)->sum('price'),
        ]);
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return response()->json([
            'message' => 'Товар удалён!',
            'cart_count' => count($cart),
            'total_price' => collect($cart)->sum('price'),
        ]);
    }

}
