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
        'velocidad_subida',
        'velocidad_bajada',
        'entidad_paga',
        'costo_mensual',
        'estado_contrato',
        'observaciones',
        'documento',
    ];

    // Esto convierte automáticamente a Carbon
    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
    ];

    public function scopeSearch($query, $search)
    {
        if (trim($search) === '') {
            return $query;
        }
    
        $palabras = explode(' ', $search);
    
        return $query->where(function ($q) use ($palabras) {
            foreach ($palabras as $palabra) {
                $q->where(function ($sub) use ($palabra) {
                    $sub->whereHas('institucion', function ($i) use ($palabra) {
                            $i->where('nombre_ie', 'like', "%{$palabra}%");
                        })
                        ->orWhereHas('proveedor', function ($p) use ($palabra) {
                            $p->where('nombre', 'like', "%{$palabra}%");
                        });
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

    public function scopeFilterProveedor($query, $proveedorId)
    {
        if ($proveedorId) {
            return $query->where('proveedor_id', $proveedorId);
        }
        return $query;
    }
    
    public function scopeFilterEstado($query, $estado)
    {
        if (!empty($estado)) {
            $query->where('estado_contrato', $estado);
        }

        return $query;
    }
    
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
