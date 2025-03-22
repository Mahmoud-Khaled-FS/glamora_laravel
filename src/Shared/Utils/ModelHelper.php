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

  public static function fileAccessor(string $disk = 'public'): Attribute
  {
    return Attribute::make(
      get: fn(string|null $value) => $value ? Storage::disk($disk)->url($value) : null,
    );
  }
}
