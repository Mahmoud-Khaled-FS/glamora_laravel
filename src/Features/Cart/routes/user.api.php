<?php

use Illuminate\Support\Facades\Route;
use Src\Features\Cart\Controllers\CartController;

Route::group(['prefix' => 'carts', 'middleware' => ['auth:sanctum']], function () {
  Route::get('/', [CartController::class, 'getUserCart']);
  Route::get('/items', [CartController::class, 'getCartItems']);
  Route::post('/items', [CartController::class, 'addCartItem']);
  Route::delete('/items/{itemId}', [CartController::class, 'removeCartItem']);
  Route::patch('/items/{itemId}', [CartController::class, 'updateCartItem']);
});
