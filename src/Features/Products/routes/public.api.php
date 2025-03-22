<?php

use Illuminate\Support\Facades\Route;
use Src\Features\Products\Controllers\CategoryController;

Route::group(['prefix' => 'categories'], function () {
  Route::get('/', [CategoryController::class, 'getCategories']);
});
