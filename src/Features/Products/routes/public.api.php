<?php

use Illuminate\Support\Facades\Route;
use Src\Features\Products\Controllers\CategoryController;
use Src\Features\Products\Controllers\ProductController;

Route::group(['prefix' => 'categories'], function () {
  Route::get('/', [CategoryController::class, 'getCategories']);
});

Route::group(['prefix' => 'products'], function () {
  Route::get('/', [ProductController::class, 'getProducts']);
  Route::get('/{id}', [ProductController::class, 'getProduct']);
});
