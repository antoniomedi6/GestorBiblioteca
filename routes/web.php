<?php

use App\Http\Middleware\AdminMiddleware;
use App\Livewire\Authors\ShowAuthors;
use App\Livewire\Categorias\ShowCategorias;
use App\Livewire\Libros\ShowLibros;
use App\Models\Libro;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $libros = Libro::with('author', 'categoria', 'prestamos')->paginate(20);
    return view('welcome', compact('libros'));
})->name('inicio');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('libros', ShowLibros::class)->middleware(AdminMiddleware::class)->name('libros');
    Route::get('autores', ShowAuthors::class)->middleware(AdminMiddleware::class)->name('autores');
    Route::get('categorias', ShowCategorias::class)->middleware(AdminMiddleware::class)->name('categorias');
});