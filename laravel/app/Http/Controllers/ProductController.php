<?php

namespace App\Http\Controllers;

use App\Http\Filters\ProductFilter;
use App\Http\Requests\ProductRequest;
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
use Illuminate\Support\Facades\Exceptions;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use function Webmozart\Assert\Tests\StaticAnalysis\resource;

class ProductController
{
    const PRODUCT_COUNT = 12;

    /**
     * Display a listing of the resource.
     */

    public function index(ProductFilter $filter, Request $request)
    {
        $categories = Category::all();
        $cities = City::all();
        $productImages = ProductImage::all();
        $cacheKey = 'products.' . md5(json_encode([
                'page' => $request->get('page', 1),
                'filter' => $request->query(),
            ]));
        $product = Cache::remember($cacheKey, now()->addSeconds(5), function () use ($request, $filter) {
            return SortService::sortProducts($request)->filter($filter)->paginate(self::PRODUCT_COUNT);
        });

        return view('pages.products.index', compact('product', 'productImages', 'categories', 'cities'));
//        return response()->json(array_merge($product->toArray(), $productImages->toArray()));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $cities = City::all();
        return view('pages.products.create', compact('categories', 'cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $validatedProduct = $request->validated();
        $validatedProduct['user_id'] = Auth::id();
        $product = Product::create($validatedProduct);
        $this->insertImages($request, $product);

        $isSent = EmailSenderController::sendMail($product);

        $message = $isSent ? 'Товар создан, проверьте вашу почту!' : 'Товар создан';

        return redirect()->route('product_item.show', [
            'category' => $product->category_id,
            'product' => $product->id
        ])->with('success', $message);

    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category, Product $product)
    {
        $categories = Category::all();
        $cities = City::all();
        $productImages = ProductImage::orderBy('product_id')->where('product_id', $product->id)->get();
        $city = City::findOrFail($product->city_id)->city;
        return view('pages.products.show',
            compact('productImages', 'product', 'categories', 'city', 'cities'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        if (!Gate::allows('update', $product)) {
            return redirect()->back()->with('error', 'У вас нет доступа');
        };
        $categories = Category::all();
        $cities = City::all();
        $productImages = ProductImage::orderBy('product_id')->where('product_id', $product->id)->get();
        return view('pages.products.edit',
            compact('product', 'productImages', 'categories', 'cities'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $validatedProduct = $request->validated();
        $product->update($validatedProduct);
        $this->insertImages($request, $product);
        return redirect()->route('product_item.show', [
            'category' => $product->category_id,
            'product' => $product->id
        ])->with('success', 'Объявление обновлено');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {

        if (!Gate::allows('delete', $product)) {
            return redirect()->back()->with('error', 'У вас нет доступа');
        };
        Storage::disk('public')->deleteDirectory("product/{$product->id}");
        $productImages = ProductImage::where('product_id', $product->id)->get();
        foreach ($productImages as $productImage) {
            $productImage->delete();
        }
        $product->delete();

        return redirect()->route('home')->with('success', 'Объявление удалено');
    }

    protected function insertImages($request, $product)
    {
        if ($request->hasFile('product_image')) {
            foreach ($request->file('product_image') as $file) {
                $imageName = $file->getClientOriginalName();
                $file->storeAs("product/{$product->id}", $imageName, 'public');
                $files[] = [
                    'product_image' => $imageName,
                    'product_id' => $product->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            ProductImage::insert($files);
            $product->update(['photo_exist' => 'photo']);
        }
    }
}
