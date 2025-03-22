<?php

namespace Src\Features\Products\Controllers;

use Src\Features\Products\Services\CategoryService;

class CategoryController
{
  public function __construct(private readonly CategoryService $categoryService) {}

  public function getCategories()
  {
    return $this->categoryService->getAllWithChildren();
  }
}
