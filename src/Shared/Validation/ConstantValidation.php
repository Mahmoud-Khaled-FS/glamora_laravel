<?php

namespace Src\Shared\Validation;

use Illuminate\Validation\Rules\Password;

class ConstantValidation
{
  /**
   * @return string[]
   */
  public static function phoneRules(bool $isRequired = true): array
  {
    return self::withRequired(['regex:/^(\+201|01|00201)[0-2,5]{1}[0-9]{8}/'], $isRequired);
  }

  /**
   * @return array<int,string|Password>
   */
  public static function passwordRules(): array
  {
    return ['required', Password::min(8)];
  }

  /**
   * @return string[]
   */
  public static function imageRules(bool $isRequired = true): array
  {
    // TODO (MAHMOUD) - Compress image size and add image size validation
    return self::withRequired(['file', 'image', 'mimes:jpg,jpeg,png'], $isRequired);
  }

  /**
   * @param mixed[] $rules
   * @return string[]
   */
  private static function withRequired(array $rules, bool $isRequired): array
  {
    if ($isRequired) {
      $rules[] = 'required';
    }
    return $rules;
  }
}
