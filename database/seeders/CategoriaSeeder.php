<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datosCategorias = [
            [
                'nombre' => 'Novela',
                'descripcion' => 'Obras de ficción narrativa extensa.',
            ],
            [
                'nombre' => 'Ciencia Ficción',
                'descripcion' => 'Género especulativo que relata acontecimientos posibles desarrollados en un marco puramente imaginario.',
            ],
            [
                'nombre' => 'Terror',
                'descripcion' => 'Obras literarias cuya intención principal es provocar miedo y escalofríos.',
            ],
            [
                'nombre' => 'Biografía',
                'descripcion' => 'Narración de la vida de una persona.',
            ],
        ];

        foreach ($datosCategorias as $categoria) {
            Categoria::create($categoria);
        }
    }
}