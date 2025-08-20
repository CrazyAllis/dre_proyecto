<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    /** @use HasFactory<\Database\Factories\ServicioFactory> */
    use HasFactory;

    protected $fillable = [
        'institucion_id',
        'proveedor_id',
        'fecha_inicio',
        'fecha_fin',
        'velocidad_contratada_mbps',
        'costo_mensual',
        'estado_contrato',
        'observaciones',
    ];

    // Esto convierte automáticamente a Carbon
    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
    ];
    
    // Define la relación con el modelo Institucion
    public function institucion()
    {
        return $this->belongsTo(Institucion::class);
    }

    // Define la relación con el modelo Proveedor
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }
}
