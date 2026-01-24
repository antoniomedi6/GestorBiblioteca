<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Categoria;
use App\Models\Libro;
use App\Models\Prestamo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LibroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datosLibros = [
            [
                'titulo' => 'Cien años de soledad',
                'anio_publicacion' => 1967,
                'editorial' => 'Editorial Sudamericana',
                'paginas' => 471,
                'portada' => 'portadas/cien_anios.jpg',
            ],
            [
                'titulo' => 'El amor en los tiempos del cólera',
                'anio_publicacion' => 1985,
                'editorial' => 'Oveja Negra',
                'paginas' => 368,
                'portada' => 'portadas/amor_colera.jpg',
            ],
            [
                'titulo' => '1984',
                'anio_publicacion' => 1949,
                'editorial' => 'Secker & Warburg',
                'paginas' => 328,
                'portada' => 'portadas/1984.jpg',
            ],
            [
                'titulo' => 'Rebelión en la granja',
                'anio_publicacion' => 1945,
                'editorial' => 'Harvill Secker',
                'paginas' => 112,
                'portada' => 'portadas/rebelion.jpg',
            ],
            [
                'titulo' => 'It',
                'anio_publicacion' => 1986,
                'editorial' => 'Viking Press',
                'paginas' => 1138,
                'portada' => 'portadas/it.jpg',
            ],
            [
                'titulo' => 'Harry Potter y la piedra filosofal',
                'anio_publicacion' => 1997,
                'editorial' => 'Bloomsbury',
                'paginas' => 223,
                'portada' => 'portadas/harry_potter_1.jpg',
            ],
        ];

        $autores = Author::all();
        $categorias = Categoria::all();
        $prestamos = Prestamo::all();

        foreach ($datosLibros as $libro) {
            Libro::create([
                ...$libro,
                'author_id' => $autores->random()->id,
                'categoria_id' => $categorias->random()->id,
            ]);
        }
    }


}