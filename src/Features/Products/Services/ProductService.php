<?php

namespace Src\Features\Products\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Src\Features\Products\Models\Product;
use Src\Shared\Error\AppError;
use Src\Shared\Error\ErrorCode;
use Src\Shared\Utils\PaginationHelpers;

class ProductService
{
  public function __construct(private readonly CategoryService $categoryService) {}

  public function getPaginate(): array
  {
    $products = Product::paginate();
    return ["products" => $products, "metadata" => PaginationHelpers::getMetadata($products)];
  }

  public function getById(int $id): Product
  {
    $product = Product::with(['category', 'images'])->find($id);
    if (!$product) {
      throw new AppError('Product not found', 404, ErrorCode::ERR_NOT_FOUND);
    }
    return $product;
  }
}
