<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Service;
use App\Models\Barber;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titulo' => fake()->sentence(3),
            'descripcion' => fake()->sentence(10),
            'precio' => fake()->randomFloat(2, 10, 100),
            'tiempo_estimado' => fake()->numberBetween(15, 120),
            'id_barbero' => fake()->numberBetween(1, Barber::count()),
        ];
    }
}
