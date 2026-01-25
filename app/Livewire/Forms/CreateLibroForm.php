<?php

namespace App\Livewire\Forms;

use App\Models\Libro;
use Carbon\Carbon;
use Livewire\Attributes\Validate;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;

class CreateLibroForm extends Form
{
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

    public function guardarForm()
    {
        $datos = $this->validate();
        $datos['portada'] = $this->portada?->store('portadas/') ?? 'portadas/default.jpg';
        Libro::create($datos);
        $this->cancelarForm();
    }

    public function cancelarForm()
    {
        $this->resetValidation();
        $this->reset();
    }
}