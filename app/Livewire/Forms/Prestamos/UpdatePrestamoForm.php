<?php

namespace App\Livewire\Forms\Prestamos;

use App\Models\Prestamo;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UpdatePrestamoForm extends Form
{
    public ?Prestamo $prestamo = null;

    #[Validate(['required', 'exists:libros,id'])]
    public $libro_id = '';

    #[Validate(['required', 'exists:users,id'])]
    public $user_id = '';

    #[Validate(['required', 'date'])]
    public $fecha_prestamo = '';

    #[Validate(['nullable', 'date', 'after_or_equal:fecha_prestamo'])]
    public $fecha_devolucion = null;

    public function setForm(Prestamo $prestamo)
    {
        $this->prestamo = $prestamo;
        $this->libro_id = $prestamo->libro_id;
        $this->user_id = $prestamo->user_id;
        $this->fecha_prestamo = $prestamo->fecha_prestamo;
        $this->fecha_devolucion = $prestamo->fecha_devolucion;
    }

    public function updateForm()
    {
        $datos = $this->validate();

        $this->prestamo->update($datos);

        $this->cancelarForm();
    }

    public function cancelarForm()
    {
        $this->resetValidation();
        $this->reset();
    }
}