<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ServiceModel;
use App\Models\BarberModel;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServiceModel>
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
            'titulo' => $this->faker->sentence(3),
            'descripcion' => $this->faker->sentence(10),
            'precio' => $this->faker->randomFloat(2, 10, 100),
            'tiempo_estimado' => $this->faker->randomFloat(2, 10, 100),
            'id_barbero' => $this->faker->numberBetween(1, BarberModel::count()),
        ];
    }
}
