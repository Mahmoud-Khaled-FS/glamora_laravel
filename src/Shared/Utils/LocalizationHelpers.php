<?php

namespace Src\Shared\Utils;

use Src\Shared\Constant\Language;
use Str;

class LocalizationHelpers
{
  const DEFAULT_LOCALE = Language::EN;

  public static function getRequestedLocale(): string
  {
    $lang = request()->header('Accept-Language', self::DEFAULT_LOCALE->value);
    try {
      return Language::from(Str::lower($lang))->value;
    } catch (\Throwable $_) {
      return self::DEFAULT_LOCALE->value;
    }
  }
}
