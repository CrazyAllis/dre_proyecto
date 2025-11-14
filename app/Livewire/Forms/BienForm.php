<?php

namespace App\Livewire\Forms;

use App\Models\Bien;
use Livewire\Attributes\Validate;
use Livewire\Form;

class BienForm extends Form
{

    public ?Bien $bien; // Instancia del modelo Bien, se usa ? porque la propiedad puede ser nula
    public bool $isEditing = false; // Indica si el formulario está en modo edición

    public array $estadosBienes = [
        'Activo' => 'Activo',
        'Inactivo' => 'Inactivo',
        'En Mantenimiento' => 'En Mantenimiento',
    ];

    public array $almacenamientoBienes = [
        'HDD' => 'HDD',
        'SSD' => 'SSD',
        'NVMe' => 'NVMe',
    ];

    // Validación de los campos del formulario
    #[Validate('required', message: 'La institución es obligatoria')]
    public $institucion_id;

    #[Validate('required', message: 'El código patrimonial es obligatorio')]
    public $codigo_patrimonial;

    public $dre_id;

    #[Validate('required', message: 'Este campo es obligatorio')]
    public $detalle_id;

    #[Validate('required', message: 'La marca es obligatoria')]
    public $marca;

    #[Validate('nullable')]
    public $modelo;

    #[Validate('nullable')]
    public $nro_serie;

    #[Validate('nullable')]
    public $procesador;

    #[Validate('nullable')]
    public $ram;

    #[Validate('nullable')]
    public $tipo_almacenamiento;

    #[Validate('nullable')]
    public $capacidad_almacenamiento;

    #[Validate('nullable')]
    public $descripcion;

    #[Validate('nullable')]
    public $oficina_ubicacion;

    public $estado;

    #[Validate('nullable|date', message: 'La fecha debe ser una fecha válida')]
    public $fecha_adquisicion;

    #[Validate('nullable')]
    public $observaciones;

    public function setBien(Bien $bien)
    {   
        $this->isEditing = true; // Cambia el estado a edición
        $this->bien = $bien; // Asigna el bien al formulario
        $this->institucion_id = $bien->institucion_id;
        $this->codigo_patrimonial = $bien->codigo_patrimonial;
        $this->dre_id = $bien->dre_id;
        $this->detalle_id = $bien->detalle_id;
        $this->marca = $bien->marca;
        $this->modelo = $bien->modelo;
        $this->nro_serie = $bien->nro_serie;
        $this->procesador = $bien->procesador;
        $this->ram = $bien->ram;
        $this->tipo_almacenamiento = $bien->tipo_almacenamiento;
        $this->capacidad_almacenamiento = $bien->capacidad_almacenamiento;
        $this->descripcion = $bien->descripcion;
        $this->oficina_ubicacion = $bien->oficina_ubicacion;
        $this->estado = $bien->estado;
        $this->fecha_adquisicion = $bien->fecha_adquisicion?->format('Y-m-d'); // Formatea la fecha a 'Y-m-d'    
        $this->observaciones = $bien->observaciones;
    }

    public function save()
    {
        if ($this->isEditing) {
            $this->update();
        } else {
            $this->store();
        }
    }

    public function store()
    {
        $this->validate(); // Valida los datos del formulario

        // Crea un nuevo Bien con los datos del formulario
        Bien::create([
            'institucion_id' => $this->institucion_id,
            'codigo_patrimonial' => $this->codigo_patrimonial,
            'dre_id' => $this->dre_id,
            'detalle_id' => $this->detalle_id,
            'marca' => $this->marca,
            'modelo' => $this->modelo,
            'nro_serie' => $this->nro_serie,
            'procesador' => $this->procesador,
            'ram' => $this->ram,
            'tipo_almacenamiento' => $this->tipo_almacenamiento,
            'capacidad_almacenamiento' => $this->capacidad_almacenamiento,
            'descripcion' => $this->descripcion,
            'oficina_ubicacion' => $this->oficina_ubicacion,
            'estado' => $this->estado,
            'fecha_adquisicion' => $this->fecha_adquisicion,
            'observaciones' => $this->observaciones,
        ]);
    }

    public function update()
    {
        $this->validate(); // Valida los datos del formulario

        // Actualiza el modelo Bien con los datos del formulario
        $this->bien->update($this->all());
    }
}
