<?php

namespace Src\Features\User\Requests;

use Src\Shared\Request\AppJsonRequest;
use Src\Shared\Validation\ConstantValidation;

class StoreAddressRequest extends AppJsonRequest
{
  protected $fields = [
    "addressLine1" => "address_line1",
    "addressLine2" => "address_line2",
  ];
  /**
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    return [
      "addressLine1" => ["sometimes", "string", "min:2", "max:255"],
      "addressLine2" => ["sometimes", "string", "min:2", "max:255"],
      "city" => ["sometimes", "string", "min:2", "max:255"],
      "postcode" => ["sometimes", "string", "min:2", "max:255"],
      "phone" => ConstantValidation::phoneRules(false),
    ];
  }
}
