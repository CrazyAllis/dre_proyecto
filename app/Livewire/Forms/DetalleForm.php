<?php

namespace App\Livewire\Forms;

use App\Models\Detalle;
use Livewire\Attributes\Validate;
use Livewire\Form;

class DetalleForm extends Form
{
    public ?Detalle $detalle; // Instancia del modelo Detalle

    #[Validate('required', message: 'El tipo de componente es obligatorio')]
    public $tipo_componente;

    public function setDetalle(Detalle $detalle)
    {
        $this->detalle = $detalle;
        $this->tipo_componente = $detalle->tipo_componente;
    }

    public function store()
    {
        $this->validate(); // Valida los datos del formulario

        Detalle::create([
            'tipo_componente' => $this->tipo_componente,
        ]);
    }

    public function update()
    {
        $this->validate(); // Valida los datos del formulario

        $this->detalle->update($this->all());
    
    }
}
