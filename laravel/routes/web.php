<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('/search', [SearchController::class, 'search'])->name('products.search');
Route::get('/login', [LoginController::class, 'login'])->name('login')->middleware('guest');
Route::post('/auth', [LoginController::class, 'authenticate'])->name('auth')->middleware('guest');
Route::get('/register', [LoginController::class, 'registration'])->name('register')->middleware('guest');
Route::post('/create_user', [LoginController::class, 'createUser'])->name('create_user')->middleware('guest');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');
Route::get('/account', [AccountController::class, 'show'])->name('account')->middleware('auth');
Route::get('/email/verify', [LoginController::class, 'verify'])->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [LoginController::class, 'verifyEmail'])->middleware(['auth', 'signed'])->name('verification.verify');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index')->middleware('auth');


Route::prefix('/products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('products.index');
    Route::get('/create', [ProductController::class, 'create'])->name('products.create')->middleware('auth');
    Route::post('/store', [ProductController::class, 'store'])->name('products.store')->middleware('auth');
    Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('products.edit')->middleware('auth');
    Route::patch('/{product}/update', [ProductController::class, 'update'])->name('products.update')->middleware('auth');
    Route::delete('/{product}', [ProductController::class, 'destroy'])->name('products.destroy')->middleware('auth');
    Route::get('/category/{category}', [CategoryController::class, 'show'])->name('category.show');
    Route::get('/category/{category}/product/{product}', [ProductController::class, 'show'])->name('product_item.show');
});
