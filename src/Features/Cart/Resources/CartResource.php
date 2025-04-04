<?php

namespace Src\Features\Cart\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Src\Features\Cart\Services\CartService;

class CartResource extends JsonResource
{
  /**
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array
  {
    return [
      'id' => $this->id,
      'totalPrice' => CartService::calcCartTotalPrice($this->resource),
      'totalQuantity' => $this->items->sum('quantity'),

      'items' => $this->items->map(static fn($item) => [
        'id' => $item->id,
        'quantity' => $item->quantity,
        'productId' => $item->product_id,
        'totalPrice' => $item->product->price * $item->quantity
      ])
    ];
  }
}
