<?php

namespace App\Livewire\Forms\Categorias;

use App\Models\Categoria;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CreateCategoriaForm extends Form
{
    #[Validate(['required', 'string', 'unique:categorias', 'min:3', 'max:60'])]
    public string $nombre = '';
    #[Validate(['required', 'string', 'min:3', 'max:300'])]
    public string $descripcion = '';

    public function guardarForm()
    {
        $datos = $this->validate();
        Categoria::create($datos);
        $this->cancelarForm();
    }

    public function cancelarForm()
    {
        $this->resetValidation();
        $this->reset();
    }
}