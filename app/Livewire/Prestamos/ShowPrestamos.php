<?php

namespace App\Livewire\Prestamos;

use App\Livewire\Forms\Prestamos\UpdatePrestamoForm;
use App\Models\Libro;
use App\Models\Prestamo;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ShowPrestamos extends Component
{
    use WithPagination;

    public string $orden = 'desc';
    public string $campo = 'id';
    public string $buscar = "";
    public Prestamo $prestamo;
    public UpdatePrestamoForm $uform;
    public bool $openEditar = false;

    #[On('evtPrestamoCreado')]
    public function render()
    {
        $libros = Libro::orderBy('titulo')->get();
        $users = User::orderBy('name')->get();

        $prestamos = Prestamo::select('prestamos.*', 'libros.titulo as ltitulo', 'users.name as uname')
            ->join('libros', 'libros.id', 'prestamos.libro_id')
            ->join('users', 'users.id', 'prestamos.user_id')
            ->where(function ($q) {
                $q->where('libros.titulo', 'like', "%{$this->buscar}%")
                    ->orWhere('users.name', 'like', "%{$this->buscar}%")
                    ->orWhere('users.email', 'like', "%{$this->buscar}%");
            })
            ->orderBy($this->campo, $this->orden)
            ->paginate(10);

        return view('livewire.prestamos.show-prestamos', compact('prestamos', 'libros', 'users'));
    }

    public function ordenar(string $campo)
    {
        $this->campo = $campo;
        $this->orden = $this->orden == 'asc' ? 'desc' : 'asc';
    }

    public function updatingBuscar()
    {
        $this->resetPage();
    }

    public function mostrarConfirmacion(Prestamo $prestamo)
    {
        $this->prestamo = $prestamo;
        $this->dispatch('evtBorrarPrestamo', 'prestamos.show-prestamos');
    }

    #[On('evtBorrarOk')]
    public function delete()
    {
        $this->prestamo->delete();
        $this->dispatch('mensaje', 'Préstamo Borrado Correctamente');
    }

    public function mostrarEditar(Prestamo $prestamo)
    {
        $this->uform->setForm($prestamo);
        $this->openEditar = true;
    }

    public function update()
    {
        $this->uform->updateForm();
        $this->cancelar();
        $this->dispatch('mensaje', 'Préstamo Editado Correctamente');
    }

    public function cancelar()
    {
        $this->uform->cancelarForm();
        $this->openEditar = false;
    }

    public function cambiarEstado(Prestamo $prestamo)
    {
        if ($prestamo->fecha_devolucion) {
            $prestamo->update(['fecha_devolucion' => null]);
        } else {
            $prestamo->update(['fecha_devolucion' => Carbon::now()]);
        }
        $this->dispatch('mensaje', 'Estado Actualizado Correctamente');
    }
}