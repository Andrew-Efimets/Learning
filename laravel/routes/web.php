<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EmailSenderController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SearchController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('/search', [SearchController::class, 'search'])->name('products.search');
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/auth', [LoginController::class, 'authenticate'])->name('auth');
Route::get('/register', [LoginController::class, 'registration'])->name('register');
Route::post('/create_user', [LoginController::class, 'createUser'])->name('create_user');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/account', [AccountController::class, 'show'])->name('account');
Route::get('/send_mail/{id}', [EmailSenderController::class, 'index'])->name('send_mail');
Route::get('/email/verify', [LoginController::class, 'verify'])->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::prefix('/products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('products.index');
    Route::get('/create', [ProductController::class, 'create'])->name('products.create')->middleware('auth');
    Route::post('/store', [ProductController::class, 'store'])->name('products.store')->middleware('auth');
    Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('products.edit')->middleware('auth');
    Route::patch('/{id}/update', [ProductController::class, 'update'])->name('products.update')->middleware('auth');
    Route::delete('/{id}', [ProductController::class, 'destroy'])->name('products.destroy')->middleware('auth');
    Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category.show');
    Route::get('/category/{category_id}/product/{id}', [ProductController::class, 'show'])->name('product_item.show');
});
