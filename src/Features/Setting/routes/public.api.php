<?php

use Illuminate\Support\Facades\Route;
use Src\Features\Setting\Controllers\SettingController;

Route::group(["prefix" => "settings"], function () {
  Route::get("/", [SettingController::class, "getByKeys"]);
  Route::get("/keys", [SettingController::class, "getKeys"]);
});
