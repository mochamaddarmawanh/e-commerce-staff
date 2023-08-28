<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->sentence(7);
        $slug = Str::slug($name);

        return [
            'product_code' => 'PRO-' . Str::random(10),
            'category_id' => mt_rand(1, 4),
            'brand_id' => mt_rand(1, 2),
            'first_image' => fake()->image(null, 640, 480),
            'name' => $name,
            'slug' => $slug,
            'gender' => fake()->randomElement(['male', 'female', 'all']),
            'description' => fake()->paragraph(),
            'weight' => mt_rand(62, 534),
            'actual_price' => fake()->randomElement([25000, 30000, 50000, 65000, 90000, 100000, 140000, 150000, 170000, 300000, 500000, 650000, 690000]),
            'final_price' => fake()->randomElement([69000, 89000, 119000, 134000, 159000, 189000, 229000, 279000, 339000, 459000, 659000, 779000, 849000]),
            'dealer_price' => fake()->randomElement([49000, 69000, 89000, 119000, 129000, 149000, 189000, 229000, 189000, 419000, 619000, 729000, 749000]),
            'discount' => fake()->randomElement([null, 25]),
            'stock' => mt_rand(0, 1000),
            'status' => fake()->randomElement(['published', 'scheduled'])
        ];
    }
}
