<?php

namespace App\Livewire\Libros;

use App\Livewire\Forms\CreateLibroForm;
use App\Models\Author;
use App\Models\Categoria;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateLibros extends Component
{
    use WithFileUploads;
    public $mostrarCrear = false;
    public CreateLibroForm $cform;
    public function render()
    {
        $autores = Author::select('id', 'nombre', 'apellidos')->orderBy('nombre')->get();
        $categorias = Categoria::select('id', 'nombre')->orderBy('nombre')->get();
        return view('livewire.libros.create-libros', compact('autores', 'categorias'));
    }

    public function guardar()
    {
        $this->cform->guardarForm();
        $this->cancelar();
        $this->dispatch('mensaje', 'Nuevo libro creado');
        $this->dispatch('evtLibroCreado')->to(ShowLibros::class);
    }

    public function cancelar()
    {
        $this->mostrarCrear = false;
        $this->cform->cancelarForm();
    }
}