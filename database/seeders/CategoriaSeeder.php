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
        $categorias = [
            'Ciencia Ficción' => 'Narrativa imaginaria basada en especulaciones científicas y tecnológicas futuras.',
            'Novela Histórica' => 'Obras ambientadas en un periodo específico del pasado con reconstrucción de época.',
            'Fantasía' => 'Historias que incorporan elementos mágicos, sobrenaturales o mundos inexistentes.',
            'Terror' => 'Relatos diseñados para provocar miedo, horror o inquietud en el lector.',
            'Romance' => 'Narrativa centrada en las relaciones amorosas y vínculos sentimentales entre personajes.',
            'Misterio y Policial' => 'Tramas enfocadas en la resolución de un crimen o enigma a través de la investigación.',
            'Biografía' => 'Narración de la vida de una persona real escrita por otra persona.',
            'Ensayo' => 'Texto en prosa que analiza, interpreta o evalúa un tema de manera reflexiva.',
            'Poesía' => 'Composición literaria que utiliza el lenguaje estético y rítmico para expresar emociones.',
            'Programación' => 'Libros técnicos sobre desarrollo de software, lenguajes de programación y ciencias de la computación.',
        ];

        foreach ($categorias as $nombre => $descripcion) {
            Categoria::create(compact('nombre', 'descripcion'));
        }
    }
}