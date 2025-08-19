<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
    /** @use HasFactory<\Database\Factories\InstitucionFactory> */
    use HasFactory;

    protected $fillable = [
        'codigo_modular',
        'nombre_ie',
        'nivel',
        'distrito',
        'provincia',
        'direccion',
        'estado_institucion',
        'latitud',
        'longitud',
        'director_id',
    ];
}
