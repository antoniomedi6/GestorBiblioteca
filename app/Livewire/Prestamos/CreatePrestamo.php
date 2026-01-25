<?php

namespace App\Livewire\Prestamos;

use App\Livewire\Forms\Prestamos\CreatePrestamoForm;
use App\Models\Libro;
use App\Models\User;
use Livewire\Component;

class CreatePrestamo extends Component
{
    public bool $mostrarCrear = false;

    public CreatePrestamoForm $cform;
    public function render()
    {
        $libros = Libro::orderBy('titulo')->get();
        $users = User::orderBy('name')->get();

        return view('livewire.prestamos.create-prestamo', compact('libros', 'users'));
    }

    public function guardar()
    {
        $this->cform->guardar();
        $this->dispatch('creado');
        $this->mostrarCrear = false;
    }

    public function cancelar()
    {
        $this->cform->cancelar();
        $this->mostrarCrear = false;
    }

}