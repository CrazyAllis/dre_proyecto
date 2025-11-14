<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dre extends Model
{
    /** @use HasFactory<\Database\Factories\DreFactory> */
    use HasFactory;

    protected $fillable = [
        'oficina',
        'responsable',
    ];

    public function bienes()
    {
        return $this->hasMany(Bien::class);
    }

}
