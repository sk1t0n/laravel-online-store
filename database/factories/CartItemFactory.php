<?php

namespace Database\Factories;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CartItem>
 */
class CartItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id' => Uuid::uuid6(),
            'cart_id' => Cart::factory(),
            'product_id' => Product::factory(),
            'price' => fake()->randomFloat(2, 100, 999999),
            'quantity' => fake()->randomDigit() + 1,
        ];
    }
}
