<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Proveedor>
 */
class ProveedorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->company,
            'ruc' => $this->faker->unique()->numerify('###########'),
            'telefono_contacto' => $this->faker->phoneNumber,
            'correo_contacto' => $this->faker->unique()->safeEmail,
            'tipo_servicio' => $this->faker->word,
        ];
    }
}
