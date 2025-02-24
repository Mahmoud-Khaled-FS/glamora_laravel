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
