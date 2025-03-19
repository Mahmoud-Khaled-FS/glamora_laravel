<?php

namespace Src\Features\Setting\Controllers;

use Illuminate\Http\Request;
use Src\Features\Setting\Enum\SettingKeys;
use Src\Features\Setting\Services\SettingService;
use Src\Shared\Response\AppResponse;

class SettingController
{
  public function getByKeys(Request $request, SettingService $settingService)
  {
    $keys = $request->query("keys");
    if (!$keys) {
      $keys = SettingKeys::publicKeys();
    }
    $keys = explode(",", $keys);
    $settings = $settingService->getPublicKeys($keys);
    return AppResponse::ok($settings);
  }

  public function getKeys()
  {
    $keys = SettingKeys::publicKeys();
    return AppResponse::ok($keys);
  }
}
