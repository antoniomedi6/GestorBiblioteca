<?php

namespace App\Livewire\Authors;

use App\Livewire\Forms\Authors\CreateAuthorForm;
use Livewire\Component;

class CreateAuthor extends Component
{
    public CreateAuthorForm $cform;
    public bool $mostrarCrear = false;

    public function render()
    {
        return view('livewire.authors.create-author');
    }

    public function guardar()
    {
        $this->cform->guardarForm();
        $this->dispatch('evtAutorCreado')->to(ShowAuthors::class);
        $this->dispatch('mensaje', 'Autor Creado Correctamente');
        $this->cancelar();
    }

    public function cancelar()
    {
        $this->cform->cancelarForm();
        $this->mostrarCrear = false;
    }
}