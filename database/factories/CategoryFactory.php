<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->sentence(mt_rand(2, 3));
        $slug = Str::slug($name);

        return [
            'name' => $name,
            'slug' => $slug,
            'status' => fake()->randomElement(['active', 'off'])
        ];
    }
}
