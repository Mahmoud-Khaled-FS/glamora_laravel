<?php

namespace Src\Features\Order\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
  /**
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array
  {
    return [
      'id' => $this->id,
      'totalPrice' => $this->total_price,
      'addressId' => $this->address_id,
      'status' => $this->status,
      'paymentMethod' => $this->payment_method,
      'createdAt' => $this->created_at,
      'updatedAt' => $this->updated_at,
    ];
  }
}
