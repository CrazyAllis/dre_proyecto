<?php

namespace App\Livewire\Forms;

use App\Models\Proveedor;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ProveedorForm extends Form
{
    public ?Proveedor $proveedor; // Instancia del modelo Proveedor, se usa ? porque la propiedad puede ser nula

    #[Validate('required', message: 'El nombre del proveedor es obligatorio')]
    #[Validate('string')]
    #[Validate('max:255')]
    public $nombre;

    #[Validate('required', message: 'El RUC es obligatorio')]
    #[Validate('numeric', message: 'El RUC debe ser numérico')]
    #[Validate('digits:11', message: 'El RUC debe tener 11 dígitos')]
    public $ruc;

    #[Validate('nullable|string')]
    public $telefono_contacto;

    #[Validate('nullable|email|max:255')]
    public $correo_contacto;

    #[Validate('nullable|string|max:100')]
    public $tipo_servicio;

    public function setProveedor(Proveedor $proveedor)
    {
        $this->proveedor = $proveedor; // Asigna el proveedor al formulario
        $this->nombre = $proveedor->nombre;
        $this->ruc = $proveedor->ruc;
        $this->telefono_contacto = $proveedor->telefono_contacto;
        $this->correo_contacto = $proveedor->correo_contacto;
        $this->tipo_servicio = $proveedor->tipo_servicio;
    }

    public function update()
    {
        $this->validate(); // Valida los datos usando las reglas definidas en los atributos
        $this->proveedor->update($this->all()); // Actualiza el proveedor con los datos del formulario
    }

    public function store()
    {
        $this->validate(); // Valida los datos usando las reglas definidas en los atributos

        Proveedor::create([
            'nombre' => $this->nombre,
            'ruc' => $this->ruc,
            'telefono_contacto' => $this->telefono_contacto,
            'correo_contacto' => $this->correo_contacto,
            'tipo_servicio' => $this->tipo_servicio,
        ]);
    }
}
