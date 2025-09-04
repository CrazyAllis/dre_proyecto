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

     // codigo reutilizable para búsquedas
     public function scopeSearch($query, $search)
     {
         $search = trim($search); // Elimina espacios en blanco al inicio y al final
 
         if ($search === '') {
             return $query; // Si no hay búsqueda, no se modifica la query
         }
 
         $palabras = explode(' ', $search); // Divide la búsqueda en palabras EJM. "Juan Pérez" → ['Juan', 'Pérez']
 
         return $query->where(function ($subQuery) use ($palabras) {
             foreach ($palabras as $palabra) {
                 $subQuery->where(function ($w) use ($palabra) {
                     $w->where('nombres', 'like', "%{$palabra}%")
                       ->orWhere('apellidos', 'like', "%{$palabra}%")
                       ->orWhere('dni', 'like', "%{$palabra}%");
                 });
             }
         });
     }

    // Define la relación con el modelo Institucion
    public function instituciones()
    {
        return $this->hasMany(Institucion::class);
    }

}
