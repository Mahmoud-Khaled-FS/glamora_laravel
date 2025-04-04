<?php

namespace Src\Features\Cart\Services;

use Src\Features\Cart\Models\Cart;
use Src\Features\Products\Models\Product;
use Src\Shared\Error\AppError;
use Src\Shared\Error\ErrorCode;

class CartService
{

  public static function calcCartTotalPrice(Cart $cart): int
  {
    return $cart->items->sum(static fn($item) => $item->product->price * $item->quantity);
  }

  public function getCart(int $userId)
  {
    $cart = Cart::with('items', 'items.product:id,price')->where('user_id', $userId)->first();
    if (!$cart) {
      return Cart::create(['user_id' => $userId]);
    }
    return $cart;
  }

  public function getCartItems(int $userId)
  {
    $cart = Cart::where('user_id', $userId)->first();
    if (!$cart) {
      return collect();
    }
    return $cart->items()->with('product')->paginate();
  }

  public function addItemToCart(int $userId, int $productId, int $quantity)
  {
    $cart = $this->getCart($userId);
    $product = Product::find($productId);
    if (!$product) {
      throw new AppError('Product not found', 400, ErrorCode::ERR_NOT_FOUND);
    }
    $cartItem = $cart->items()->where('product_id', $productId)->first();
    if ($cartItem) {
      $cartItem->quantity += $quantity;
      $cartItem->save();
    } else {
      $cart->items()->create([
        'product_id' => $productId,
        'quantity' => $quantity
      ]);
    }
    return $cart->refresh();
  }

  public function removeItemFromCart(int $userId, int $itemId)
  {
    $cart = $this->getCart($userId);
    $cart->items()->where('id', $itemId)->delete();
  }

  public function updateItemInCart(int $userId, int $itemId, int $quantity)
  {
    $cart = $this->getCart($userId);
    $cartItem = $cart->items()->where('id', $itemId)->first();
    if (!$cartItem) {
      throw new AppError('Item not found', 404, ErrorCode::ERR_NOT_FOUND);
    }
    $cartItem->quantity = $quantity;
    $cartItem->save();
  }
}
