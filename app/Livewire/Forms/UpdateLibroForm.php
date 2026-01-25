<?php

namespace App\Livewire\Forms;

use App\Models\Libro;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;

class UpdateLibroForm extends Form
{

    public ?Libro $libro = null;
    #[Validate(['required', 'string', 'min:2', 'max:60'])]
    public string $titulo = '';

    public $anio_publicacion = '';

    #[Validate(['required', 'string', 'max:255'])]
    public string $editorial = '';

    #[Validate(['required', 'integer', 'min:1'])]
    public $paginas = '';

    #[Validate(['nullable', 'image', 'max:2048'])]
    public ?TemporaryUploadedFile $portada = null;

    #[Validate(['required', 'exists:authors,id'])]
    public $author_id = '';

    #[Validate(['required', 'exists:categorias,id'])]
    public $categoria_id = '';

    public function rules()
    {
        return [
            'anio_publicacion' => [
                'required',
                'integer',
                'min:1000',
                "max:" . Carbon::now()->year,
            ]
        ];
    }

    public function setForm(Libro $libro)
    {
        $this->libro = $libro;
        $this->titulo = $libro->titulo;
        $this->anio_publicacion = $libro->anio_publicacion;
        $this->editorial = $libro->editorial;
        $this->paginas = $libro->paginas;
        $this->author_id = $libro->author_id;
        $this->categoria_id = $libro->categoria_id;
    }

    public function updateForm()
    {
        $datos = $this->validate();
        $datos['portada'] = $this->portada?->store('portadas/') ?? $this->libro->portada;

        $portadaAnterior = $this->libro->portada;
        $this->libro->update($datos);
        if ($this->portada && basename($portadaAnterior) != 'default.jpg') {
            Storage::delete($portadaAnterior);
        }
        $this->cancelarForm();
    }

    public function cancelarForm()
    {
        $this->resetValidation();
        $this->reset();
    }
}