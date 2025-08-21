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

    // Define la relación con el modelo Institucion
    public function director()
    {
        return $this->belongsTo(Director::class);
    }

    // Define la relación con el modelo Servicio
    public function servicios()
    {
        return $this->hasMany(Servicio::class);
    }

    // Define la relación con el modelo Bien
    public function bienes()
    {
        return $this->hasMany(Bien::class);
    }
}
