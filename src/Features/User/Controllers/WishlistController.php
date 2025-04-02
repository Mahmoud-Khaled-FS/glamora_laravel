<?php

namespace Src\Features\User\Controllers;

use Auth;
use Src\Features\Products\Resources\ProductResource;
use Src\Features\User\Services\WishlistService;
use Src\Shared\Response\AppResponse;

class WishlistController
{
  public function __construct(private readonly WishlistService $wishlistService) {}

  public function addToWishlist(int $productId)
  {
    $user = Auth::user();
    $this->wishlistService->addProductToWishlist($user, $productId);
    return AppResponse::noContent();
  }

  public function removeFromWishlist(int $productId)
  {
    $user = Auth::user();
    $this->wishlistService->removeProductFromWishlist($user, $productId);
    return AppResponse::noContent();
  }

  public function getWishlist()
  {
    $user = Auth::user();
    $wishlist = $this->wishlistService->getWishlist($user);
    return AppResponse::ok(ProductResource::collection($wishlist));
  }
}
