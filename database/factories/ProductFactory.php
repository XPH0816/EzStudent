<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
            'name' => $this->faker->name,
            'type' => $this->faker->word,
            'description' => $this->faker->sentence,
            'image' => $this->faker->imageUrl,
            'price' => $this->faker->randomFloat(1, 10, 50),
            'category' => collect($this->faker->randomElements(['Men', 'Women']))->pop(),
            'quantity' => $this->faker->numberBetween(1, 5),
            'size' => collect($this->faker->randomElements(['S', 'M', 'L']))->pop(),
        ];
    }
}
