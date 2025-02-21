<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'vehicle_type' => $this->faker->randomElement(['Carro', 'Moto',
                'Caminhão', 'Van', 'Quadriciclo', 'Triciclo']),
            'model' => $this->faker->date(),
            'brand' => $this->faker->company(),
            'color' => $this->faker->safeColorName(),
            'daily_price' => $this->faker->randomFloat(2, 10, 200),
        ];
    }
}
