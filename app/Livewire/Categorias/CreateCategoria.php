<?php

namespace App\Livewire\Categorias;

use App\Livewire\Forms\Categorias\CreateCategoriaForm;
use Livewire\Component;

class CreateCategoria extends Component
{
    public bool $mostrarCrear = false;
    public CreateCategoriaForm $cform;
    public function render()
    {
        return view('livewire.categorias.create-categoria');
    }

    public function guardar()
    {
        $this->cform->guardarForm();
        $this->dispatch('mensaje', 'Categoría Creada Correctamente');
        $this->dispatch('evtCategoriaCreada')->to(ShowCategorias::class);
        $this->cancelar();
    }

    public function cancelar()
    {
        $this->cform->cancelarForm();
        $this->mostrarCrear = false;
    }
}