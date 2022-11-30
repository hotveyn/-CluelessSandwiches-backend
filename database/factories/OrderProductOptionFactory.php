<?php

namespace Database\Factories;

use App\Models\OrderProductOption;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OrderProductOption>
 */
class OrderProductOptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "toggle"=>fake()->boolean()
        ];
    }
}
