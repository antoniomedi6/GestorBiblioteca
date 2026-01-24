<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Author extends Model
{
    /** @use HasFactory<\Database\Factories\AuthorFactory> */
    use HasFactory;

    protected $fillable = ['nombre', 'apellidos', 'nacionalidad', 'fecha_nacimiento', 'biografia'];

    public function libros(): HasMany
    {
        return $this->hasMany(Libro::class);
    }
}