<?php

namespace Src\Features\Order\Services;

use DB;
use Src\Features\Cart\Services\CartService;
use Src\Features\Order\Models\Order;
use Src\Shared\Error\AppError;
use Src\Shared\Error\ErrorCode;

class OrderService
{
  public function __construct(private readonly CartService $cartService) {}
  public function getUserOrders(int $userId)
  {
    return Order::where('user_id', $userId)->paginate();
  }

  public function createOrder(array $data, int $userId)
  {
    $order = DB::transaction(function () use ($data, $userId) {
      $cart = $this->cartService->getCart($userId);
      if ($cart->items()->count() === 0) {
        throw new AppError('Cart is empty', 400, ErrorCode::ERR_REQUIREMENT_ERROR);
      }

      $order = Order::create([
        'user_id' => $userId,
        'total_price' => $this->cartService->calcCartTotalPrice($cart),
        'address_id' => $data['addressId'],
        'payment_method' => $data['paymentMethod'],
        'note' => $data['note'],
      ]);
      $order->items()->createMany($cart->items->map(static fn($item) => [
        'product_id' => $item->product_id,
        'quantity' => $item->quantity,
        'price' => $item->product->price,
      ]));
      $cart->items()->delete();
      return $order;
    });
    return $order;
  }
}
