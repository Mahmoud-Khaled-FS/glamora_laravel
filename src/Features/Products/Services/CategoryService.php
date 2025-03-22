<?php

namespace Src\Features\Products\Services;

use Illuminate\Support\Collection;
use Src\Features\Products\Models\ProductCategory;
use Storage;

class CategoryService
{
  public function getAllWithChildren(): Collection
  {
    $categories = ProductCategory::all();
    $response = collect();
    foreach ($categories as $category) {
      $response->push($this->categoryToResponse($category));
    }
    return $response;
  }

  public function categoryToResponse(ProductCategory $category): array
  {
    return [
      'id' => $category->id,
      'name' => $category->name,
      'slug' => $category->slug,
      'image' => $category->image,
      'description' => $category->description,
      'parentId' => $category->parent_id,
      'subCategories' => $category->hasAttribute('subCategories') ? $category->subCategories->map(fn($s) => $this->categoryToResponse($s)) : [],
    ];
  }
}
