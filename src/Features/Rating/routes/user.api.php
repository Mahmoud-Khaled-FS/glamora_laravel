<?php

use Illuminate\Support\Facades\Route;
use Src\Features\Rating\Controllers\RatingController;

Route::group(["prefix" => "ratings", "middleware" => ["auth:sanctum"]], function () {
  Route::get("/my-rate", [RatingController::class, "myRate"]);
  Route::post("/", [RatingController::class, "store"]);
  Route::delete("/{id}", [RatingController::class, "destroy"]);
  Route::patch("/{id}", [RatingController::class, "update"]);
});
