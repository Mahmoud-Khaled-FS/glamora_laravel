<?php

namespace Src\Features\Rating\Requests;

use Src\Shared\Request\AppJsonRequest;

class StoreRatingRequest extends AppJsonRequest
{
  protected $fields = [];
  /**
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    return [
      "rating" => ["required", "integer", "min:1", "max:5"],
      'review' => ["required", "string", "min:2", "max:255"],
      'retableType' => ['required', 'in:product'],
      'retableId' => ['required', 'numeric'],
    ];
  }
}
