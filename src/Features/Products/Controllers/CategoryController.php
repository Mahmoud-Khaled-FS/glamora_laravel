<?php

namespace Src\Features\Products\Controllers;

use Src\Features\Products\Services\CategoryService;
use Src\Shared\Response\AppResponse;

class CategoryController
{
  public function __construct(private readonly CategoryService $categoryService) {}

  public function getCategories(): AppResponse
  {
    return AppResponse::ok($this->categoryService->getAllWithChildren());
  }
}
