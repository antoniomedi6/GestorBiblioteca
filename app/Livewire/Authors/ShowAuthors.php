<?php

namespace App\Livewire\Authors;

use App\Livewire\Forms\Authors\UpdateAuthorForm;
use App\Models\Author;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ShowAuthors extends Component
{
    use WithPagination;
    public string $orden = 'desc';
    public string $campo = 'id';
    public string $buscar = '';

    public Author $autor;

    public UpdateAuthorForm $uform;

    public bool $openEditar = false;

    #[On('evtAutorCreado')]
    public function render()
    {
        $autores = Author::where(function ($q) {
            $q->where('nombre', 'like', "%{$this->buscar}%")
                ->orWhere('apellidos', 'like', "%{$this->buscar}%")
                ->orWhere('fecha_nacimiento', 'like', "%{$this->buscar}%")
                ->orWhere('biografia', 'like', "%{$this->buscar}%")
                ->orWhere('nacionalidad', 'like', "%{$this->buscar}%");
        })
            ->orderBy($this->campo, $this->orden)
            ->paginate(10);
        return view('livewire.authors.show-authors', compact('autores'));
    }

    public function updatingBuscar()
    {
        $this->resetPage();
    }

    public function ordenar(string $campo)
    {
        $this->campo = $campo;
        $this->orden = $this->orden == 'asc' ? 'desc' : 'asc';
    }

    public function mostrarConfirmacion(Author $autor)
    {
        $this->autor = $autor;
        $this->dispatch('evtBorrarAutor', 'authors.show-authors');
    }

    #[On('evtBorrarOk')]
    public function delete()
    {
        $this->autor->delete();
        $this->dispatch('mensaje', 'Autor Borrado Correctamente');
    }

    public function mostrarEditar(Author $autor)
    {
        $this->uform->setForm($autor);
        $this->openEditar = true;
    }

    public function update()
    {
        $this->uform->updateForm();
        $this->cancelar();
        $this->dispatch('mensaje', 'Autor Editado Correctamente');
    }

    public function cancelar()
    {
        $this->uform->cancelarForm();
        $this->openEditar = false;
    }

}