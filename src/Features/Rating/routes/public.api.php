<?php

use Illuminate\Support\Facades\Route;
use Src\Features\Rating\Controllers\RatingController;

Route::group(["prefix" => "ratings"], function () {
  Route::get("/", [RatingController::class, "index"]);
  Route::get("/{id}", [RatingController::class, "show"])->where("id", "[0-9]+");
});

Route::get("/products/{productId}/ratings", [RatingController::class, "getProductRatings"]);
