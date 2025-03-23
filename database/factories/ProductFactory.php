<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Src\Features\Products\Models\Product;
use Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Model>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name_ar" => fake()->name(),
            "name_en" => fake()->name(),
            "description_ar" => fake()->text(),
            "description_en" => fake()->text(),
            "summary_ar" => fake()->text(),
            "summary_en" => fake()->text(),
            "image" => Storage::disk('public')->url('/products/Temp.png'),
            'discount' => fake()->numberBetween(0, 100),
            'price' => fake()->numberBetween(0, 100),
            'quantity' => fake()->numberBetween(0, 100),
        ];
    }
}
