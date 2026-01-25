<?php

namespace App\Livewire\Forms\Prestamos;

use App\Models\Prestamo;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CreatePrestamoForm extends Form
{
    #[Validate(['required', 'exists:libros,id'])]
    public $libro_id = '';

    #[Validate(['required', 'exists:users,id'])]
    public $user_id = '';

    #[Validate(['required', 'date'])]
    public $fecha_prestamo = '';

    public function guardar()
    {
        $datos = $this->validate();

        Prestamo::create($datos);

        $this->cancelar();
    }

    public function cancelar()
    {
        $this->resetValidation();
        $this->reset();
    }
}