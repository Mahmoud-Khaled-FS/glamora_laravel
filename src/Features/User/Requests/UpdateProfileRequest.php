<?php

namespace Src\Features\User\Requests;

use Src\Shared\Request\AppJsonRequest;

class UpdateProfileRequest extends AppJsonRequest
{
  protected $fields = [
    "firstName" => "first_name",
    "lastName" => "last_name",
    'dateOfBirth' => 'date_of_birth'
  ];
  /**
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    return [
      "firstName" => ["sometimes", "string", "min:2", "max:255"],
      "lastName" => ["sometimes", "string", "min:2", "max:255"],
      "email" => ["sometimes", "email", "min:2", "max:255"],
      "dateOfBirth" => ["sometimes", "date"],
    ];
  }
}
