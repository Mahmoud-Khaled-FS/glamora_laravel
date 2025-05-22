<?php

use Illuminate\Support\Facades\Route;
use Src\Features\Store\Controllers\StoreController;

Route::group(["prefix" => "stores", "middleware" => "auth:sanctum"], function () {
  Route::post('/', [StoreController::class, 'store']);
});
