<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\BarberModel;
use App\Models\ClientModel;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'is_barber' => fake()->boolean(50),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    public function withProfile(): static
    {
        return $this->afterCreating(function (User $user) {
            // Create a new profile instance
            if($user->is_barber){
                $profile = new BarberModel();
                $profile->user_id = $user->id;
                $profile->nombre = fake()->firstName();
                $profile->apellido = fake()->lastName();
                $profile->cedula = fake()->unique()->numerify('##########');
                $profile->telefono = fake()->phoneNumber();
                $profile->direccion = fake()->address();
                $profile->save();
            } else {
                $profile = new ClientModel();
                $profile->user_id = $user->id;
                $profile->nombre = fake()->firstName();
                $profile->apellido = fake()->lastName();
                $profile->cedula = fake()->unique()->numerify('##########');
                $profile->telefono = fake()->phoneNumber();
                $profile->direccion = fake()->address();
                $profile->save();
            }

            return $user;
        });
    }
}
