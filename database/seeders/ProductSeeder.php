<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Src\Features\Products\Models\Product;
use Src\Features\Products\Models\ProductCategory;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ProductCategory::factory()->count(3)->create();
        foreach ($categories as $category) {
            Product::factory()->count(100)->create([
                'category_id' => $category->id,
            ]);
        }
    }
}
