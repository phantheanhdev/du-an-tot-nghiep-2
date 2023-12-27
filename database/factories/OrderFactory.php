<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'table_id' => 6,
            'note' => 'hello',
            'total_price'=> 50000,
            'status'=> 0,
            'customer_name'=> fake()->name(),
            'customer_phone' => fake()->phoneNumber(),
            'order_day'=> '2023-10-30'

        ];
    }
}
