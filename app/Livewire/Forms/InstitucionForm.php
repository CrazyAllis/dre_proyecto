<?php

namespace App\Livewire\Forms;

use App\Models\Institucion;
use Livewire\Attributes\Validate;
use Livewire\Form;

class InstitucionForm extends Form
{
    public ?Institucion $institucion; // Instancia del modelo Institucion, se usa ? porque la propiedad puede ser nula

    public array $niveles = [
        'Inicial' => 'Inicial',
        'Primaria' => 'Primaria',
        'Secundaria' => 'Secundaria',
    ];

    public array $estadosInstitucion = [
        'Activo' => 'Activo',
        'Inactivo' => 'Inactivo',
    ];

    // Validación de los campos del formulario
    #[Validate('required', message: 'El código modular es obligatorio')]
    #[Validate('numeric', message: 'El código modular debe ser un número')]
    public $codigo_modular;

    #[Validate('required', message: 'El nombre de la institución es obligatorio')]
    public $nombre_ie;

    #[Validate('required', message: 'El nivel es obligatorio')]
    public $nivel;

    #[Validate('required', message: 'El distrito es obligatorio')]
    public $distrito;

    #[Validate('required', message: 'La provincia es obligatoria')]
    public $provincia;

    #[Validate('nullable|string|max:255')]
    public $direccion;

    #[Validate('required', message: 'El estado de la institución es obligatorio')]
    public $estado_institucion;

    #[Validate('nullable|numeric', message: 'La latitud debe ser un número')]
    public $latitud;

    #[Validate('nullable|numeric', message: 'La longitud debe ser un número')]
    public $longitud;

    #[Validate('required|exists:directors,id', message: 'El director es obligatorio')]
    public $director_id;

    public function setInstitucion(Institucion $institucion)
    {
        $this->institucion = $institucion; // Asigna el modelo Institucion a la propiedad
        $this->codigo_modular = $institucion->codigo_modular;
        $this->nombre_ie = $institucion->nombre_ie;
        $this->nivel = $institucion->nivel;
        $this->distrito = $institucion->distrito;
        $this->provincia = $institucion->provincia;
        $this->direccion = $institucion->direccion;
        $this->estado_institucion = $institucion->estado_institucion;
        $this->latitud = $institucion->latitud;
        $this->longitud = $institucion->longitud;
        $this->director_id = $institucion->director_id;
    }

    public function store()
    {
        $this->validate(); // Valida los datos usando las reglas definidas en los atributos

        Institucion::create([
            'codigo_modular' => $this->codigo_modular,
            'nombre_ie' => $this->nombre_ie,
            'nivel' => $this->nivel,
            'distrito' => $this->distrito,
            'provincia' => $this->provincia,
            'direccion' => $this->direccion,
            'estado_institucion' => $this->estado_institucion,
            'latitud' => $this->latitud,
            'longitud' => $this->longitud,
            'director_id' => $this->director_id,
        ]);
    }

    public function update()
    {
        $this->validate(); // Valida los datos usando las reglas definidas en los atributos

        $this->institucion->update($this->all()); // Actualiza el modelo Director con los datos del formulario
    }
}
