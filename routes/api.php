<?php

use App\Http\Controllers\Api\ProductCategoryController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('/product-categories', ProductCategoryController::class)->only('index', 'store', 'show', 'update', 'destroy');
Route::apiResource('/products', ProductController::class)->only('index', 'store', 'show', 'update', 'destroy');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
