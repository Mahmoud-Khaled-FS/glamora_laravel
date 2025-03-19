<?php

namespace Src\Features\Setting\Enum;

enum SettingKeys: string
{
  case APP_NAME = 'app_name';
  case ABOUT_US = 'about_us';
  case CONTACT_US = 'contact_us';
  case EMAIL = 'email';

  public static function isPublic(string|self $key): bool
  {
    if (is_string($key)) {
      $key = SettingKeys::tryFrom($key);
    }
    return in_array($key, self::publicKeys());
  }

  public static function publicKeys(): array
  {
    return [
      self::APP_NAME,
      self::ABOUT_US,
      self::CONTACT_US,
    ];
  }
}
