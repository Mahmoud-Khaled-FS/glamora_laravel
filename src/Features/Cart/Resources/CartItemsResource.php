<?php

namespace Src\Features\Cart\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Src\Features\Products\Resources\ProductResource;

class CartItemsResource extends JsonResource
{
  /**
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array
  {
    return [
      'id' => $this->id,
      'quantity' => $this->quantity,
      'productId' => $this->product_id,
      'totalPrice' => $this->product->price * $this->quantity,
      'product' => new ProductResource($this->product)
    ];
  }
}
