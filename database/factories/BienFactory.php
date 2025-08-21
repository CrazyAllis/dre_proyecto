<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bien>
 */
class BienFactory extends Factory
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
            'codigo_patrimonial' => $this->faker->unique()->bothify('BIEN-####'),
            'tipo_bien' => $this->faker->word(),
            'marca' => $this->faker->company(),
            'modelo' => $this->faker->word(),
            'nro_serie' => $this->faker->unique()->numerify('SN-#####'),
            'descripcion' => $this->faker->sentence(),
            'oficina_ubicacion' => $this->faker->city(),
            'estado' => $this->faker->randomElement(['Nuevo', 'Usado', 'Reparado']),
            'fecha_adquisicion' => $this->faker->date(),
            'observaciones' => $this->faker->sentence(),
        ];
    }
}
