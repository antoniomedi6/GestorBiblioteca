<?php

namespace App\Livewire\Libros;

use App\Livewire\Forms\UpdateLibroForm;
use App\Models\Author;
use App\Models\Categoria;
use App\Models\Libro;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ShowLibros extends Component
{
    use WithFileUploads;
    use WithPagination;
    public string $orden = 'desc';
    public string $campo = 'created_at';
    public string $buscar = "";
    public Libro $libro;
    public UpdateLibroForm $uform;
    public bool $openEditar = false;

    #[On('evtLibroCreado')]
    public function render()
    {
        $autores = Author::all();
        $categorias = Categoria::all();
        $libros = Libro::select('libros.*')
            ->join('categorias', 'categorias.id', 'libros.categoria_id')
            ->join('authors', 'authors.id', 'libros.author_id')
            ->where(function ($q) {
                $q->where('libros.titulo', 'like', "%{$this->buscar}%")
                    ->orWhere('authors.nombre', 'like', "%{$this->buscar}%")
                    ->orWhere('authors.apellidos', 'like', "%{$this->buscar}%")
                    ->orWhere('libros.editorial', 'like', "%{$this->buscar}%")
                    ->orWhere('categorias.nombre', 'like', "%{$this->buscar}%");
            })
            ->orderBy($this->campo, $this->orden)
            ->paginate(10);
        return view('livewire.libros.show-libros', compact('libros', 'autores', 'categorias'));
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
    public function mostrarConfirmacion(Libro $libro)
    {
        $this->libro = $libro;
        $this->dispatch('evtBorrarLibro', 'libros.show-libros');
    }

    #[On('evtBorrarOk')]
    public function delete()
    {
        $portadaLibro = $this->libro->portada;
        $this->libro->delete();
        if (basename($portadaLibro) != 'default.jpg') {
            Storage::delete($portadaLibro);
        }
        $this->dispatch('mensaje', 'Libro Borrado Correctamente');
    }

    public function mostrarEditar(Libro $libro)
    {
        $this->uform->setForm($libro);
        $this->openEditar = true;
    }

    public function update()
    {
        $this->uform->updateForm();
        $this->cancelar();
        $this->dispatch('mensaje', 'Libro Editado Correctamente');
    }

    public function cancelar()
    {
        $this->uform->cancelarForm();
        $this->openEditar = false;
    }
}