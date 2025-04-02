<?php

namespace Src\Features\User\Services;

use Src\Features\Products\Models\Product;
use Src\Features\User\Models\User;
use Src\Shared\Error\AppError;
use Src\Shared\Error\ErrorCode;

class WishlistService
{
  function __construct() {}

  function addProductToWishlist(User $user, int $productId)
  {
    $product = Product::find($productId);
    if (!$product) {
      throw new AppError('Product not found', 404, ErrorCode::ERR_NOT_FOUND);
    }

    $user->wishlists()->create([
      'product_id' => $product->id,
    ]);
  }

  function removeProductFromWishlist(User $user, int $productId)
  {
    $user->wishlists()->where('product_id', $productId)->delete();
  }

  function getWishlist(User $user)
  {
    return $user->wishlists()->with('product')->get()->map(static fn($wishlist) => $wishlist->product);
  }
}
