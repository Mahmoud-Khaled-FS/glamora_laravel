<?php

namespace Src\Features\Order\Requests;

use Src\Shared\Request\AppJsonRequest;

class OrderRequest extends AppJsonRequest
{
  /**
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    return [
      'addressId' => ['required', 'numeric', 'exists:addresses,id'],
      'paymentMethod' => ['required', 'in:cash'],
      'note' => ['sometimes', 'string', 'min:2', 'max:500'],
    ];
  }
}
