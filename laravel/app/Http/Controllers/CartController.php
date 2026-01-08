<?php

namespace App\Http\Controllers;

use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $cartIds = array_keys($cart);

        $available = Product::whereIn('id', $cartIds)
            ->where('status', 0)
            ->pluck('id')
            ->toArray();
        $filteredCart = array_intersect_key($cart, array_flip($available));

        if(count($filteredCart) !== count($cart)){
            session()->put('cart', $filteredCart);
            session()->flash('error', 'Некоторые товары из корзины не доступны к покупке!');
            $cart = $filteredCart;
        }

        $product = collect($cart);
        $totalPrice = collect($product)->sum('price');
        $orders = auth()->user()->orders()->where('status', 1)->latest()->get();
        return view('pages.account.cart',
            compact('product', 'totalPrice', 'orders'));
    }

    public function add($id)
    {
        $product = Product::find($id);
        $cart = session()->get('cart', []);
        $cart[$id] = [
            'id' => $product->id,
            'name' => $product->name,
            'quantity' => 1,
            'price' => $product->price,
            'created_at' => $product->created_at,
            'product_slug' => $product->slug,
            'category_slug' => $product->category->slug,
            'images' => $product->images->first()?->product_image,
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
