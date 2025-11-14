<?php

namespace App\Livewire\Forms;

use App\Models\Director;
use Livewire\Attributes\Validate;
use Livewire\Form;

class DirectorForm extends Form
{
    public ?Director $director; // Instancia del modelo Director, se usa ? porque la propiedad puede ser nula

    // Otra forma de validación usando atributos de Livewire
    #[Validate('required', message: 'Los nombres son obligatorios')] //cuando se usa message, no se usa el mensaje de error por defecto y solo se puede añadir un mensaje por restricción sino se genera un error
    #[Validate('string')]
    #[Validate('max:255')]
    public $nombres;

    #[Validate('required', message: 'Los apellidos son obligatorios')]
    #[Validate('string')]
    #[Validate('max:255')]
    public $apellidos;

    #[Validate('required', message: 'El DNI es obligatorio')]
    #[Validate('numeric', message: 'El DNI debe ser numérico')]
    #[Validate('digits:8', message: 'El DNI debe tener 8 dígitos')]
    public $dni;

    #[Validate('nullable|string|max:100')]
    public $cargo;

    #[Validate('nullable|string|max:15')]
    public $telefono;

    public function setDirector(Director $director)
    {
        $this->director = $director; // Asigna el modelo Director a la propiedad
        $this->nombres = $director->nombres; // Asigna los valores del modelo a las propiedades del formulario
        $this->apellidos = $director->apellidos;
        $this->dni = $director->dni;
        $this->cargo = $director->cargo;
        $this->telefono = $director->telefono;
    }

    public function store(){
        $this->validate(); // Valida los datos usando las reglas definidas en los atributos

        Director::create([
            'nombres' => $this->nombres,
            'apellidos' => $this->apellidos,
            'dni' => $this->dni,
            'cargo' => $this->cargo,
            'telefono' => $this->telefono,
        ]);
    }

    public function update()
    {
        $this->validate(); // Valida los datos usando las reglas definidas en los atributos

        $this->director->update($this->all()); // Actualiza el modelo Director con los datos del formulario
    }
}
