<?php

namespace Database\Factories;

use App\Models\Libro;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Prestamo>
 */
class PrestamoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $usuarios = User::all();
        $libros = Libro::all();
        $fechaPrestamo = fake()->dateTimeBetween('-6 months', '-1 week');
        $estado = fake()->randomElement(['Activo', 'Devuelto']);

        $fechaDevolucion = $estado == 'Devuelto' ? fake()->dateTimeBetween($fechaPrestamo, 'now') : null;
        return [
            'fecha_prestamo' => $fechaPrestamo,
            'fecha_devolucion' => $fechaDevolucion,
            'estado' => $estado,
            'user_id' => $usuarios->random()->id,
            'libro_id' => $libros->random()->id
        ];
    }
}