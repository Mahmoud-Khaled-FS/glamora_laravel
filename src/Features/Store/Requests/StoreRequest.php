<?php

namespace Src\Features\Store\Requests;

use Src\Shared\Request\AppJsonRequest;
use Src\Shared\Validation\ConstantValidation;

class StoreRequest extends AppJsonRequest
{
  protected $isFormData = true;

  protected $fields = [
    'socialLinks' => 'social_links'
  ];
  /**
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    return [
      'name' => ['required', 'string', 'min:3', 'max:255'],
      'logo' => ['sometimes', 'image'],
      'description' => ['sometimes', 'string', 'min:1'],
      'address' => ['sometimes', 'string', 'min:1'],
      'phone' => ConstantValidation::phoneRules(),
      'email' => ['sometimes', 'email'],
      'socialLinks' => ['required', 'array'],
      // TODO (MAHMOUD) - Create Enum class
      'socialLinks.*.key' => ['required', 'in:facebook,instagram,x,telegram'],
      'socialLinks.*.url' => ['required', 'url']
    ];
  }
}
