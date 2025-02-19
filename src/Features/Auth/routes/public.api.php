<?php

use Illuminate\Support\Facades\Route;
use Src\Features\Auth\Controllers\AuthController;

Route::group(["prefix" => "auth"], function () {
  Route::post("login", [AuthController::class, "login"]);
  Route::post("register", [AuthController::class, "register"]);
});
