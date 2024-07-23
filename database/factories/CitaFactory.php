<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Cita;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cita>
 */
class CitaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "id_cliente" => $this->faker->numberBetween(1, 5),
            "id_servicio" => $this->faker->numberBetween(1, 5),
            "estado" => $this->faker->randomElement(["pendiente", "aceptada", "cancelada", "finalizada"]),
            "fecha" => $this->faker->dateTimeBetween("-1 year", "+1 year")->format("Y-m-d H:i:s"),
        ];
    }
}
