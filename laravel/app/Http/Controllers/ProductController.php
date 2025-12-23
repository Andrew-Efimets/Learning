<?php

namespace App\Http\Controllers;

use App\Http\Filters\ProductFilter;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Services\SortService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ProductController
{
    const PRODUCT_COUNT = 12;

    /**
     * Display a listing of the resource.
     */

    public function index(ProductFilter $filter, Request $request)
    {
        $cacheKey = 'products.' . md5(json_encode([
                'page' => $request->get('page', 1),
                'filter' => $request->query(),
            ]));
        $product = Cache::remember($cacheKey, now()->addMinutes(60), function () use ($request, $filter) {
            return SortService::sortProducts($request)->filter($filter)
                ->with('images')->paginate(self::PRODUCT_COUNT);
        });

        return view('pages.products.index', compact('product'));
//        return response()->json(array_merge($product->toArray()));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.products.create');
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
            'category' => $product->category,
            'product' => $product
        ])->with('success', $message);

    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category, Product $product)
    {
        return view('pages.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        if (!Gate::allows('update', $product)) {
            return redirect()->back()->with('error', 'У вас нет доступа');
        };
        return view('pages.products.edit', compact('product'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        if (!Gate::allows('delete', $product)) {
            return redirect()->back()->with('error', 'У вас нет доступа');
        };
        $validatedProduct = $request->validated();
        if ($request->has('delete_images')) {
            $imagesToDelete = ProductImage::whereIn('id', $request->delete_images)
                ->where('product_id', $product->id)
                ->get();
            foreach ($imagesToDelete as $image) {
                Storage::disk('public')->delete("product/{$product->id}/{$image->product_image}");
                $image->delete();
            }
        }
        $product->update($validatedProduct);
        $this->insertImages($request, $product);
        $photoExist = $product->images()->exists() ? 'photo' : null;
        $product->update(['photo_exist' => $photoExist]);

        return redirect()->route('product_item.show', [
            'category' => $product->category,
            'product' => $product
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
        $product->delete();

        return redirect()->route('home')->with('success', 'Объявление удалено');
    }

    protected function insertImages($request, $product)
    {
        if ($request->hasFile('product_image')) {
            $files = [];
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
