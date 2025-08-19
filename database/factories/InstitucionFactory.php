<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Institucion>
 */
class InstitucionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'codigo_modular' => $this->faker->unique()->bothify('IE-####'),
            'nombre_ie' => $this->faker->company(),
            'nivel' => $this->faker->randomElement(['Primaria', 'Secundaria', 'Superior']),
            'distrito' => $this->faker->city(),
            'provincia' => $this->faker->state(),
            'direccion' => $this->faker->address(),
            'estado_institucion' => $this->faker->randomElement(['Activo', 'Inactivo']),
            'latitud' => $this->faker->latitude(),
            'longitud' => $this->faker->longitude(),
            'director_id' => \App\Models\Director::factory()->create()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
