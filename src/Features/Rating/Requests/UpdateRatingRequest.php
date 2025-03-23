<?php

namespace Src\Features\Rating\Requests;

use Src\Shared\Request\AppJsonRequest;

class UpdateRatingRequest extends AppJsonRequest
{
  protected $fields = [];
  /**
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    return [
      "rating" => ["sometimes", "integer", "min:1", "max:5"],
      'review' => ["sometimes", "string", "min:2", "max:255"],
    ];
  }
}
