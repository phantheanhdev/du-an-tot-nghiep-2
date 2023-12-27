<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Table>
 */
class TableFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Bàn' . fake()->numberBetween(1, 100),
            'type' => 'Bàn' . fake()->numberBetween(1, 10),
            'qr' => 'https://api.qrserver.com/v1/create-qr-code/?data=http://127.0.0.1:8000/restaurant-manager&amp;size=100x100'
        ];
    }
}
