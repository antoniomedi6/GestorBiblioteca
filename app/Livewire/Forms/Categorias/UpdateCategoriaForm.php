<?php

namespace App\Livewire\Forms\Categorias;

use App\Models\Categoria;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UpdateCategoriaForm extends Form
{
    public ?Categoria $categoria = null;

    #[Validate(['required', 'string', 'min:3', 'max:60'])]
    public string $nombre = '';
    #[Validate(['required', 'string', 'min:3', 'max:300'])]
    public string $descripcion = '';


    public function setForm(Categoria $categoria)
    {
        $this->categoria = $categoria;
        $this->nombre = $categoria->nombre;
        $this->descripcion = $categoria->descripcion;
    }

    public function editarForm()
    {
        $datos = $this->validate();
        $this->categoria->update($datos);
        $this->cancelarForm();
    }

    public function cancelarForm()
    {
        $this->resetValidation();
        $this->reset();
    }
}