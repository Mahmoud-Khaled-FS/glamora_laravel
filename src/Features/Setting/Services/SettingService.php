<?php

namespace Src\Features\Setting\Services;

use Illuminate\Support\Collection;
use Src\Features\Setting\Enum\SettingKeys;
use Src\Features\Setting\Models\Setting;

class SettingService
{
  /**
   * @param array<string> $keys
   * @return Collection<int,string>
   */
  public function getPublicKeys(array $keys): Collection
  {

    $availableKeys = [];
    foreach ($keys as $key) {
      $key = trim($key);
      if (SettingKeys::isPublic($key)) {
        $availableKeys[] = $key;
      }
    }
    if (count($availableKeys) === 0) {
      return collect();
    }
    return Setting::whereIn('key', $availableKeys)->get()->map(fn($s) => $this->convertSettingToKeyValue($s));
  }

  public function convertSettingToKeyValue(Setting $setting): array
  {
    $value = match ($setting->type) {
      'string' => $setting->value,
      'json' => json_decode($setting->value, true),
      'number' => (float)$setting->value,
      'boolean' => (bool)$setting->value,
      default => $setting->value
    };
    return [
      'key' => $setting->key,
      'value' => $value,
      'value_ar' => $setting->value_ar
    ];
  }
}
