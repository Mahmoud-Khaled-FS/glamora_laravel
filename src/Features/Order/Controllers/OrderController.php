<?php

namespace Src\Features\Order\Controllers;

use Auth;
use Src\Features\Order\Requests\OrderRequest;
use Src\Features\Order\Resources\OrderResource;
use Src\Features\Order\Services\OrderService;
use Src\Shared\Response\AppResponse;

class OrderController
{
  public function __construct(private readonly OrderService $orderService) {}

  public function getUserOrders(): AppResponse
  {
    $orders = $this->orderService->getUserOrders(Auth::id());
    return AppResponse::ok(OrderResource::collection($orders));
  }

  public function createOrder(OrderRequest $request): AppResponse
  {
    $order = $this->orderService->createOrder($request->validated(), Auth::id());
    return AppResponse::created(OrderResource::make($order));
  }
}
