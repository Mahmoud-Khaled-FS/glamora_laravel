<?php

namespace Src\Features\Products\Controllers;

use Src\Features\Products\Services\ProductService;
use Src\Shared\Response\AppResponse;

class ProductController
{
  public function __construct(private readonly ProductService $productService) {}

  public function getProducts(): AppResponse
  {
    $productsResponse = $this->productService->getPaginate();
    return AppResponse::ok($productsResponse['products'], $productsResponse['metadata']);
  }

  public function getProduct(int $id): AppResponse
  {
    return AppResponse::ok($this->productService->getById($id));
  }
}
