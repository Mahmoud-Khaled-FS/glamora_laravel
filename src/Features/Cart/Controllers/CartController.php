<?php

namespace Src\Features\Cart\Controllers;

use Auth;
use Illuminate\Http\Response;
use Src\Features\Cart\Requests\CartItemRequest;
use Src\Features\Cart\Resources\CartItemsResource;
use Src\Features\Cart\Resources\CartResource;
use Src\Features\Cart\Services\CartService;
use Src\Shared\Response\AppResponse;
use Src\Shared\Utils\PaginationHelpers;

class CartController
{
  public function __construct(private readonly CartService $cartService) {}

  public function getUserCart(): AppResponse
  {
    $cart = $this->cartService->getCart(Auth::id());
    return new AppResponse(new CartResource($cart));
  }


  public function getCartItems(): AppResponse
  {
    $items = $this->cartService->getCartItems(Auth::id());
    return AppResponse::ok(CartItemsResource::collection($items), PaginationHelpers::getMetadata($items));
  }

  public function addCartItem(CartItemRequest $request): AppResponse
  {
    $data = $request->validated();
    $cart = $this->cartService->addItemToCart(Auth::id(), $data['productId'], $data['quantity']);
    return AppResponse::created(new CartResource($cart));
  }

  public function removeCartItem(int $itemId): Response
  {
    $cart = $this->cartService->removeItemFromCart(Auth::id(), $itemId);
    return AppResponse::noContent();
  }

  public function updateCartItem(CartItemRequest $request, int $itemId): Response
  {
    $data = $request->validated();
    $cart = $this->cartService->updateItemInCart(Auth::id(), $itemId, $data['quantity']);
    return AppResponse::noContent();
  }
}
