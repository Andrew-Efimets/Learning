<?php

namespace App\Http\Controllers;

use App\Http\Filters\ProductFilter;
use App\Models\Category;
use App\Models\City;
use App\Models\Product;
use App\Models\ProductImage;
use App\Services\SortService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use function Webmozart\Assert\Tests\StaticAnalysis\resource;

class ProductController
{
    const PRODUCT_COUNT = 12;

    protected SortService $sortService;

    public function __construct(SortService $sortService)
    {
        $this->sortService = $sortService;
    }

    /**
     * Display a listing of the resource.
     */

    public function index(ProductFilter $filter, Request $request, SortService $sortService)
    {
        $user = Auth::user();
        $categories = Category::all();
        $cities = City::all();

        $productImages = Cache::remember('all_product_images', now()->addMinutes(10), function () {
            return ProductImage::all();
        });

        $cacheKey = 'products.' . md5(json_encode([
                'page' => $request->get('page', 1),
                'filter' => $request->query(),
            ]));

        $product = Cache::remember($cacheKey, now()->addMinutes(10), function () use ($request, $sortService, $filter) {
            return $sortService->sortProducts($request)->filter($filter)->paginate(self::PRODUCT_COUNT);
        });

        return view('pages.products.index', compact('product', 'productImages', 'categories', 'user', 'cities'));
//        return response()->json(array_merge($product->toArray(), $productImages->toArray()));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $categories = Category::all();
        $cities = City::all();
        return view('pages.products.create', compact('categories', 'user', 'cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $user = Auth::user();
        $validatedProduct = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|integer',
            'description' => 'required',
            'photo_exist' => 'null',
            'category_id' => 'required',
            'city_id' => 'required',
            'product_image' => '',
        ]);

        $product = Product::create($validatedProduct);

        if ($request->hasFile('product_image')) {
            foreach ($request->file('product_image') as $file) {
                $image = $file->getClientOriginalName();
                $file->storeAs('/product/' . $product->id . '/', $image, 'public');
                $files[] = [
                    'product_image' => $image,
                    'product_id' => $product->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            $files = collect($files);

            ProductImage::insert($files->toArray());

            $product->photo_exist = 'photo';
        }

        $product->user_id = $user->id;
        $product->save();

        return redirect()->route('send_mail', $product->id);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $categoryId, string $id)
    {
        $user = Auth::user();
        $categories = Category::all();
        $product = Product::where('id', $id)->firstOrFail();
        $productImages = ProductImage::orderBy('product_id')->where('product_id', $product->id)->get();
        $cities = City::all();
        $address = City::findOrFail($product->city_id)->city;
        return view('pages.products.show',
            compact('productImages', 'product', 'categories', 'user' , 'address', 'cities'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = Auth::user();
        $product = Product::where('id', $id)->firstOrFail();
        $categories = Category::all();
        $cities = City::all();
        $productImages = ProductImage::orderBy('product_id')->where('product_id', $product->id)->get();
        return view('pages.products.edit',
            compact('product', 'productImages', 'categories', 'user', 'cities'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedProduct = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|integer',
            'description' => 'required',
            'category_id' => 'required|max:255',
            'city_id' => 'required',
            'product_image' => '',
        ]);

        $product = Product::findOrFail($id);
        $product->update($validatedProduct);

        if ($request->hasFile('product_image')) {
            foreach ($request->file('product_image') as $file) {
                $image = $file->getClientOriginalName();
                $file->storeAs('/product/' . $product->id . '/', $image, 'public');
                $files[] = [
                    'product_image' => $image,
                    'product_id' => $product->id,
                ];
            }

            $files = collect($files);

            ProductImage::insert($files->toArray());

            $product->photo_exist = 'photo';
            $product->save();
        }

        $productImages = ProductImage::orderBy('product_id')->where('product_id', $product->id)->get();
        $categories = Category::all();

        return view('pages.products.show',
            compact('product', 'productImages', 'categories'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Auth::user();
        $product = Product::where('id', $id)->firstOrFail();
        $product->delete();
        $productImages = ProductImage::where('product_id', $product->id)->get();
        foreach ($productImages as $productImage) {
            $productImage->delete();
        }

        return view('pages.products.destroy', compact('product', 'user'));

    }
}
