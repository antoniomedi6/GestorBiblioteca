<?php

namespace App\Livewire\Categorias;

use App\Livewire\Forms\Categorias\UpdateCategoriaForm;
use App\Models\Categoria;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ShowCategorias extends Component
{
    use WithPagination;
    public string $buscar = '';
    public string $orden = 'desc';
    public $campo = 'id';

    public bool $openEditar = false;
    public ?Categoria $categoria = null;

    public UpdateCategoriaForm $uform;

    #[On('evtCategoriaCreada')]
    public function render()
    {
        $categorias = Categoria::where(function ($q) {
            $q->where('nombre', 'like', "%{$this->buscar}%")
                ->orWhere('descripcion', 'like', "%{$this->buscar}%");
        })
            ->orderBy($this->campo, $this->orden)
            ->paginate(10);
        return view('livewire.categorias.show-categorias', compact('categorias'));
    }

    public function ordenar(string $campo)
    {
        $this->campo = $campo;
        $this->orden = $this->orden == 'asc' ? 'desc' : 'asc';
    }

    public function mostrarConfirmacion(Categoria $categoria)
    {
        $this->dispatch('evtBorrarCategoria', 'categorias.show-categorias');
        $this->categoria = $categoria;
    }

    #[On('evtBorrarOk')]
    public function delete()
    {
        $this->categoria->delete();
        $this->dispatch('mensaje', 'Categoria Borrada Correctamente');
    }

    public function mostrarEditar(Categoria $categoria)
    {
        $this->uform->setForm($categoria);
        $this->openEditar = true;
    }

    public function update()
    {
        $this->uform->editarForm();
        $this->dispatch('mensaje', 'Categoria Editada Correctamente');
        $this->cancelar();
    }

    public function cancelar()
    {
        $this->uform->cancelarForm();
        $this->openEditar = false;
    }
}