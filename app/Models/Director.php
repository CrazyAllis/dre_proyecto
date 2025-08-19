<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    /** @use HasFactory<\Database\Factories\DirectorFactory> */
    use HasFactory;

    protected $fillable = [
        'nombres',
        'apellidos',
        'dni',
        'cargo',
        'telefono',
    ];

    // Define la relación con el modelo Institucion
    public function instituciones()
    {
        return $this->hasMany(Institucion::class);
    }

}
