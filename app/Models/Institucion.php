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

    public function scopeSearch($query, $search)
    {
        $search = trim($search);

        if ($search === '') {
            return $query;
        }

        $palabras = explode(' ', $search);

        return $query->where(function ($subQuery) use ($palabras) {
            foreach ($palabras as $palabra) {
                $subQuery->where(function ($w) use ($palabra) {
                    $w->where('codigo_modular', 'like', "%{$palabra}%")
                    ->orWhere('nombre_ie', 'like', "%{$palabra}%");
                });
            }
        });
    }

    public function scopeFilterNivel($query, $nivel)
    {
        if (!empty($nivel)) {
            $query->where('nivel', $nivel);
        }

        return $query;
    }

    public function scopeFilterEstado($query, $estado)
    {
        if (!empty($estado)) {
            $query->where('estado_institucion', $estado);
        }

        return $query;
    }


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
