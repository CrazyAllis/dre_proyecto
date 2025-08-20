<?php

namespace App\Livewire\Forms;

use App\Models\Servicio;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ServicioForm extends Form
{

    public ?Servicio $servicio; // Instancia del modelo Servicio, se usa ? porque la propiedad puede ser nula

    public array $estadosContrato = [
        'Activo' => 'Activo',
        'Inactivo' => 'Inactivo',
    ];

    // Validación de los campos del formulario
    
    public $institucion_id;
    
    #[Validate('required', message: 'El proveedor es obligatorio')]
    #[Validate('exists:proveedors,id', message: 'El proveedor debe existir')]
    public $proveedor_id;

    #[Validate('nullable|date', message: 'La fecha de inicio es obligatoria y debe ser una fecha válida')]
    public $fecha_inicio;

    #[Validate('nullable|date', message: 'La fecha de fin debe ser una fecha válida')]
    public $fecha_fin;

    #[Validate('required', message: 'La velocidad contratada es obligatoria')]
    #[Validate('numeric', message: 'La velocidad contratada debe ser un número')]
    public $velocidad_contratada_mbps;

    #[Validate('required', message: 'El costo mensual es obligatorio')]
    #[Validate('numeric', message: 'El costo mensual debe ser un número')]
    public $costo_mensual;

    #[Validate('required', message: 'El estado del contrato es obligatorio')]
    public $estado_contrato;

    #[Validate('nullable|string')]
    public $observaciones;

    public function store()
    {
        $this->validate(); // Valida los datos del formulario

        Servicio::create([
            'institucion_id' => $this->institucion_id,
            'proveedor_id' => $this->proveedor_id,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
            'velocidad_contratada_mbps' => $this->velocidad_contratada_mbps,
            'costo_mensual' => $this->costo_mensual,
            'estado_contrato' => $this->estado_contrato,
            'observaciones' => $this->observaciones,
        ]);
    }
}
