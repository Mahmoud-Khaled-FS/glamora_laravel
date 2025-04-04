<?php

namespace Src\Features\Cart\Requests;

use Src\Shared\Request\AppJsonRequest;

class CartItemRequest extends AppJsonRequest
{
  protected $fields = [
    'productId' => 'product_id',
  ];
  /**
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    if ($this->isMethod('POST')) {
      return $this->addItemRules();
    }
    return $this->updateItemRules();
  }

  private function addItemRules(): array
  {
    return [
      'productId' => ['required', 'exists:products,id'],
      'quantity' => ['required', 'integer', 'min:1']
    ];
  }

  private function updateItemRules(): array
  {
    return [
      'quantity' => ['required', 'integer', 'min:1']
    ];
  }
}
