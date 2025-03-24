<?php

namespace Src\Shared\Utils;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Storage;

class ModelHelper
{
  public static function defineLocaleAttribute(string $column): Attribute
  {
    $lang = LocalizationHelpers::getRequestedLocale();
    return Attribute::make(
      get: fn($_, array $attributes) => $attributes["{$column}_{$lang}"],
    );
  }

  public static function fileUrl(string|null $value, string $disk = 'public'): string|null
  {
    return $value ? Storage::disk($disk)->url($value) : null;
  }
}
