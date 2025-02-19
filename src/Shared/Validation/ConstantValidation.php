<?php

namespace Src\Shared\Validation;

use Illuminate\Validation\Rules\Password;

class ConstantValidation
{
  public static function phoneRules(bool $isRequired = true)
  {
    return self::withRequired(['regex:/^(\+201|01|00201)[0-2,5]{1}[0-9]{8}/'], $isRequired);
  }

  public static function passwordRules()
  {
    return ['required', Password::min(8)];
  }

  private static function withRequired(array $rules, bool $isRequired)
  {
    if ($isRequired) {
      $rules[] = 'required';
    }
    return $rules;
  }
}
