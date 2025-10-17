<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bien extends Model
{
    /** @use HasFactory<\Database\Factories\BienFactory> */
    use HasFactory;

    protected $fillable = [
        'institucion_id',
        'codigo_patrimonial',
        'tipo_bien',
        'marca',
        'modelo',
        'nro_serie',
        'descripcion',
        'oficina_ubicacion',
        'estado',
        'fecha_adquisicion',
        'observaciones',
    ];

    // Esto convierte automáticamente a Carbon
    protected $casts = [
        'fecha_adquisicion' => 'date'
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
                    $w->where('codigo_patrimonial', 'like', "%{$palabra}%")
                    ->orWhere('tipo_bien', 'like', "%{$palabra}%");
                });
            }
        });
    }

    public function scopeFilterInstitucion($query, $institucionId)
    {
        if ($institucionId) {
            return $query->where('institucion_id', $institucionId);
        }
        return $query;
    }

    public function scopeFilterEstado($query, $estado)
    {
        if ($estado) {
            return $query->where('estado', $estado);
        }
        return $query;
    }

    // Define la relación con el modelo Institucion
    public function institucion()
    {
        return $this->belongsTo(Institucion::class);
    }

    // Define la relación con el modelo Detalle
    public function detalles()
    {
        return $this->hasMany(Detalle::class);
    }
}
