<?php

use Illuminate\Support\Facades\Route;
use Src\Features\Store\Controllers\StoreController;

Route::prefix('stores')->group(function () {
    // Get all active stores
    Route::get('/', [StoreController::class, 'index']);
    
    // Get specific store details with its products
    Route::get('/{id}', [StoreController::class, 'show']);
    
    // Get store products
    Route::get('/{id}/products', [StoreController::class, 'products']);
    
    // Search stores
    // Route::get('/search', [StoreController::class, 'search']);
});