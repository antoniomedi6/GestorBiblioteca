<?php

namespace App\Livewire\Forms\Authors;

use App\Models\Author;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UpdateAuthorForm extends Form
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

    public ?Author $autor = null;

    public function setForm(Author $autor)
    {
        $this->autor = $autor;
        $this->nombre = $autor->nombre;
        $this->apellidos = $autor->apellidos;
        $this->nacionalidad = $autor->nacionalidad;
        $this->fecha_nacimiento = $autor->fecha_nacimiento;
        $this->biografia = $autor->biografia;
    }

    public function updateForm()
    {
        $datos = $this->validate();
        $this->autor->update($datos);
        $this->cancelarForm();
    }

    public function cancelarForm()
    {
        $this->resetValidation();
        $this->reset();
    }
}