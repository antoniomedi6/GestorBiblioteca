<?php

namespace App\Livewire\Forms\Authors;

use App\Models\Author;
use Date;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CreateAuthorForm extends Form
{
    #[Validate(['required', 'string', 'min:3', 'max:50'])]
    public string $nombre = '';

    #[Validate(['required', 'string', 'min:3', 'max:60'])]
    public string $apellidos = '';

    #[Validate(['required', 'string', 'max:60'])]
    public string $nacionalidad = '';

    #[Validate(['required', 'date', 'before:today'])]
    public string $fecha_nacimiento = '';

    #[Validate(['required', 'string', 'min:10', 'max:1000'])]
    public string $biografia = '';


    public function guardarForm()
    {
        $datos = $this->validate();
        Author::create($datos);
        $this->cancelarForm();
    }

    public function cancelarForm()
    {
        $this->resetValidation();
        $this->reset();
    }
}