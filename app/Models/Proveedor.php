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
}
