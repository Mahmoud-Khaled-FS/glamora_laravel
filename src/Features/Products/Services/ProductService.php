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
    return ["products" => $this->productToCollectionResponse($products), "metadata" => PaginationHelpers::getMetadata($products)];
  }

  public function getById(int $id): array
  {
    $product = Product::with('category')->find($id);
    if (!$product) {
      throw new AppError('Product not found', 404, ErrorCode::ERR_NOT_FOUND);
    }

    return $this->productToResponse($product);
  }

  public function productToCollectionResponse(LengthAwarePaginator|Collection $products): Collection
  {
    $productsResponse = collect();
    foreach ($products as $product) {
      $productsResponse->push([
        'id' => $product->id,
        'name' => $product->name,
        'summary' => $product->summary,
        'price' => $product->price,
        'image' => $product->image,
        'discount' => $product->discount,
        'categoryId' => $product->category_id
      ]);
    }

    return $productsResponse;
  }

  public function productToResponse(Product $product): array
  {
    return [
      'id' => $product->id,
      'name' => $product->name,
      'summary' => $product->summary,
      'price' => $product->price,
      'image' => $product->image,
      'discount' => $product->discount,
      'category' => $this->categoryService->categoryToResponse($product->category),
      'videoUrl' => $product->video_url,
      'quantity' => $product->quantity,
      'discount' => $product->discount
    ];
  }
}
