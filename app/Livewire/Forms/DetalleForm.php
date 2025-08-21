<?php

namespace App\Livewire\Forms;

use App\Models\Detalle;
use Livewire\Attributes\Validate;
use Livewire\Form;

class DetalleForm extends Form
{
    public ?Detalle $detalle; // Instancia del modelo Detalle

    public array $estadosDetalle = [
        'nuevo' => 'Nuevo',
        'usado' => 'Usado',
        'reparado' => 'Reparado',
    ];

    // Validación de los campos del formulario
    #[Validate('required', message: 'El código del bien es obligatorio')]
    public $bien_id;

    #[Validate('required', message: 'El tipo de componente es obligatorio')]
    public $tipo_componente;

    #[Validate('nullable')]
    public $descripcion;

    #[Validate('required', message: 'El estado del componente es obligatorio')]
    public $estado;

    public function setDetalle(Detalle $detalle)
    {
        $this->detalle = $detalle;
        $this->bien_id = $detalle->bien_id;
        $this->tipo_componente = $detalle->tipo_componente;
        $this->descripcion = $detalle->descripcion;
        $this->estado = $detalle->estado;
    }

    public function store()
    {
        $this->validate(); // Valida los datos del formulario

        Detalle::create([
            'bien_id' => $this->bien_id,
            'tipo_componente' => $this->tipo_componente,
            'descripcion' => $this->descripcion,
            'estado' => $this->estado,
        ]);
    }

    public function update()
    {
        $this->validate(); // Valida los datos del formulario

        $this->detalle->update($this->all());
    
    }
}
