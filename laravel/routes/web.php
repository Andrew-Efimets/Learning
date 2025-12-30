<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('/search', [SearchController::class, 'search'])->name('products.search');


Route::get('/login', [LoginController::class, 'login'])->name('login')
    ->middleware('guest');
Route::post('/auth', [LoginController::class, 'authenticate'])->name('auth')
    ->middleware('guest');
Route::get('/register', [LoginController::class, 'registration'])->name('register')
    ->middleware('guest');
Route::post('/create_user', [LoginController::class, 'createUser'])->name('create_user')
    ->middleware('guest');
Route::get('/forgot_password', function () {
    return view('pages.auth.forgot-password');
})->middleware('guest')->name('password.request');
Route::post('/forgot_password', [LoginController::class, 'forgotPassword'])
    ->middleware(['guest', 'throttle:3,1'])->name('password.email');
Route::get('/reset-password/{token}', function (string $token) {
    return view('pages.auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');
Route::post('/reset-password', [LoginController::class, 'updatePassword'])
    ->middleware('guest')->name('password.update');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout')
    ->middleware('auth');
Route::get('/account', [AccountController::class, 'show'])->name('account')
    ->middleware(['auth', 'verified']);
Route::get('/user', [UserController::class, 'index'])->name('personal.data')
    ->middleware(['auth', 'verified']);
Route::post('/user/update', [UserController::class, 'updateUser'])->name('personal.data.update')
    ->middleware(['auth', 'verified']);
Route::get('/admin', [AccountController::class, 'adminPanel'])->name('account.admin')
    ->middleware(['auth', 'verified', 'can:admin-panel']);
Route::get('/email/verify', [LoginController::class, 'verify'])
    ->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [LoginController::class, 'verifyEmail'])
    ->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', [LoginController::class, 'resendVerification'])
    ->middleware(['auth', 'throttle:1,1'])
    ->name('verification.send');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index')
    ->middleware(['auth', 'verified']);
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add')
    ->middleware(['auth', 'verified']);
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove')
    ->middleware(['auth', 'verified']);


Route::prefix('/products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('products.index');
    Route::get('/create', [ProductController::class, 'create'])->name('products.create')
        ->middleware(['auth', 'verified']);
    Route::post('/store', [ProductController::class, 'store'])->name('products.store')
        ->middleware(['auth', 'verified']);
    Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('products.edit')
        ->middleware(['auth', 'verified']);
    Route::patch('/{product}/update', [ProductController::class, 'update'])->name('products.update')
        ->middleware(['auth', 'verified']);
    Route::delete('/{product}', [ProductController::class, 'destroy'])->name('products.destroy')
        ->middleware(['auth', 'verified']);
    Route::get('/category/{category}', [CategoryController::class, 'show'])->name('category.show');
    Route::get('/category/{category}/product/{product}', [ProductController::class, 'show'])
        ->name('product_item.show');
});

Route::get('/payment', [StripeController::class, 'index'])->name('payment')
    ->middleware(['auth', 'verified']);
Route::post('/payment', [StripeController::class, 'stripePost'])->name('credit-card')
    ->middleware(['auth', 'verified']);
