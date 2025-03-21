<?php

namespace Src\Features\User\Requests;

use Src\Shared\Request\AppJsonRequest;
use Src\Shared\Validation\ConstantValidation;

class UploadAvatarRequest extends AppJsonRequest
{
  protected $isFormData = true;
  /**
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    return [
      "avatar" => ConstantValidation::imageRules(),
    ];
  }
}
