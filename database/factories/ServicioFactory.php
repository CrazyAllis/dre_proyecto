<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Servicio>
 */
class ServicioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'institucion_id' => \App\Models\Institucion::factory(),
            'proveedor_id' => \App\Models\Proveedor::factory(),
            'fecha_inicio' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'fecha_fin' => $this->faker->dateTimeBetween('now', '+1 year'),
            'velocidad_contratada_mbps' => $this->faker->numberBetween(10, 1000),
            'costo_mensual' => $this->faker->randomFloat(2, 50, 5000),
            'estado_contrato' => $this->faker->randomElement(['activo', 'inactivo']),
            'observaciones' => $this->faker->sentence(),
        ];
    }
}
