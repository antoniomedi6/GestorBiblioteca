<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datosAutores = [
            [
                'nombre' => 'Gabriel',
                'apellidos' => 'García Márquez',
                'nacionalidad' => 'Colombiana',
                'fecha_nacimiento' => '1927-03-06',
                'biografia' => 'Escritor y periodista colombiano, premio Nobel de Literatura en 1982.',
            ],
            [
                'nombre' => 'George',
                'apellidos' => 'Orwell',
                'nacionalidad' => 'Británica',
                'fecha_nacimiento' => '1903-06-25',
                'biografia' => 'Escritor y periodista británico, conocido por sus obras distópicas.',
            ],
            [
                'nombre' => 'Stephen',
                'apellidos' => 'King',
                'nacionalidad' => 'Estadounidense',
                'fecha_nacimiento' => '1947-09-21',
                'biografia' => 'Escritor estadounidense de novelas de terror, ficción sobrenatural y misterio.',
            ],
            [
                'nombre' => 'J.K.',
                'apellidos' => 'Rowling',
                'nacionalidad' => 'Británica',
                'fecha_nacimiento' => '1965-07-31',
                'biografia' => 'Escritora británica, conocida por ser la autora de la serie de libros de Harry Potter.',
            ],
        ];

        foreach ($datosAutores as $autor) {
            Author::create($autor);
        }
    }
}