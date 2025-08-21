<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle extends Model
{
    /** @use HasFactory<\Database\Factories\DetalleFactory> */
    use HasFactory;

    protected $fillable = [
        'bien_id',
        'tipo_componente',
        'descripcion',
        'estado',
    ];

    // Define la relación con el modelo Bien
    public function bien()
    {
        return $this->belongsTo(Bien::class);
    }
}
