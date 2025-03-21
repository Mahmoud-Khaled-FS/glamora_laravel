<?php

use Illuminate\Support\Facades\Route;
use Src\Features\User\Controllers\ProfileController;

Route::group(["prefix" => "users", "middleware" => "auth:sanctum"], function () {
  Route::get("/me", [ProfileController::class, "myProfile"]);
  Route::patch("/me", [ProfileController::class, "updateMe"]);
  Route::delete("/me", [ProfileController::class, "deleteMe"]);

  Route::post("/me/avatar", [ProfileController::class, "updateAvatar"]);
});
