<?php

namespace Database\Seeders;

use App\Models\Prestamo;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        $this->call(CategoriaSeeder::class);
        $this->call(AuthorSeeder::class);
        $this->call(LibroSeeder::class);
        Prestamo::factory(30)->create();
    }
}