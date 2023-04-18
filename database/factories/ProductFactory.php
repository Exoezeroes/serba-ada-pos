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
        $buy_price = fake()->numberBetween(10, 200) * 1000;
        return [
            'uid' => fake()->ean13(),
            'title' => fake()->text(16),
            'quantity' => fake()->numberBetween(1, 100),
            'buy_price' => $buy_price,
            'sell_price' => $buy_price * 1.5,
        ];
    }
}
