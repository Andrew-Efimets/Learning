<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/users', [UserController::class, 'getAll']);

Route::get('/news', [CategoryController::class, 'index']);
