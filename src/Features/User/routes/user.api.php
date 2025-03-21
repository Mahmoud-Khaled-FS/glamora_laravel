<?php

use Illuminate\Support\Facades\Route;
use Src\Features\User\Controllers\AddressController;
use Src\Features\User\Controllers\ProfileController;

Route::group(["prefix" => "users/me", "middleware" => "auth:sanctum"], function () {
  Route::get("/", [ProfileController::class, "myProfile"]);
  Route::patch("/", [ProfileController::class, "updateMe"]);
  Route::delete("/", [ProfileController::class, "deleteMe"]);

  Route::post("/avatar", [ProfileController::class, "updateAvatar"]);

  Route::group(["prefix" => "addresses"], function () {
    Route::get("/", [AddressController::class, "getUserAddresses"]);
    Route::post("/", [AddressController::class, "storeAddress"]);
    Route::patch("/{id}", [AddressController::class, "updateAddress"]);
    Route::delete("/{id}", [AddressController::class, "deleteAddress"]);
  });
});
