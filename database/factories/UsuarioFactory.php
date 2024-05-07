<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Usuario>
 */
class UsuarioFactory extends Factory
{
   
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $faker= fake();
        $faker->addProvider(new Identificacion($faker));
        $genero = $faker->genero();
        $nombre = ($genero == 'MASCULINO') ? $faker->nombreMasculino() : $faker->nombreFemenino();

        return [
            'correo' => fake()->unique()->safeEmail(),
            'apellido_paterno' => $faker->apellido(),
            'apellido_materno' => $faker->apellido(),
            'nombre' => $nombre,
            'genero' => $genero,
        ];
    }
}
