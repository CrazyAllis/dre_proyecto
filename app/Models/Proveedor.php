<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    /** @use HasFactory<\Database\Factories\ProveedorFactory> */
    use HasFactory;

    protected $fillable = [
        'nombre',
        'ruc',
        'telefono_contacto',
        'correo_contacto',
        'tipo_servicio',
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
                    $w->where('nombre', 'like', "%{$palabra}%")
                    ->orWhere('ruc', 'like', "%{$palabra}%");
                });
            }
        });
    }

    // Define la relación con el modelo Servicio
    public function servicios()
    {
        return $this->hasMany(Servicio::class);
    }
}
