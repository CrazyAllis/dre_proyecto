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
