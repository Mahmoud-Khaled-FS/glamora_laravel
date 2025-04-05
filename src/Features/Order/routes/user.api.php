<?php

use Illuminate\Support\Facades\Route;
use Src\Features\Order\Controllers\OrderController;

Route::group(['prefix' => 'orders', 'middleware' => ['auth:sanctum']], function () {
  Route::get('/', [OrderController::class, 'getUserOrders']);
  Route::post('/', [OrderController::class, 'createOrder']);
  Route::get('/items', [OrderController::class, 'getOrderItems']);
});
