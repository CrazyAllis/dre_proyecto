<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Detalle>
 */
class DetalleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'bien_id' => null, // Puede ser null o un ID de Bien existente
            'tipo_componente' => $this->faker->word(),
            'descripcion' => $this->faker->sentence(),
            'estado' => $this->faker->randomElement(['nuevo', 'usado', 'reparado']),
        ];
    }
}
