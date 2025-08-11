<?php

namespace App\Livewire\Directores;

use App\Livewire\Forms\DirectorForm;
use App\Models\Director;
//use Livewire\Attributes\Validate;   
use Livewire\Component;

class Create extends Component
{
    public DirectorForm $form; // Instancia del formulario DirectorForm

    /* 1 Otra forma de validación usando atributos de Livewire
    #[Validate('required', message: 'Los nombres son obligatorios')]
    #[Validate('string', message: 'Solo texto es permitido')]
    #[Validate('max:255', message: 'El nombre no puede exceder los 255 caracteres')]
    public $nombres;

    #[Validate('required|string|max:255')]
    public $apellidos;

    #[Validate('required|string|max:8|unique:directors,dni')]
    public $dni;

    #[Validate('nullable|string|max:100')]
    public $cargo;

    #[Validate('nullable|string|max:15')]
    public $telefono;*/

    public function save()
    {
        $this->form->store(); // Llama al método store del formulario DirectorForm

        /*$validate = $this->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'dni' => 'required|string|max:8|unique:directors,dni',
            'cargo' => 'nullable|string|max:100',
            'telefono' => 'nullable|string|max:15',
        ]);

        Director::create($validate);*/

        /* 1 Otra forma de validación usando atributos de Livewire
        $this->validate(); // Valida los datos usando las reglas definidas en los atributos

        Director::create([
            'nombres' => $this->form->nombres,   // agregamos el prefijo form para acceder a las propiedades del formulario
            'apellidos' => $this->form->apellidos,
            'dni' => $this->form->dni,
            'cargo' => $this->form->cargo,
            'telefono' => $this->form->telefono,
        ]);*/

        //dump("Se esta llamando al metodo store"); // Aquí puedes agregar la lógica para almacenar el director | usamos DUMP para depurar
       
        // Si no se usa la validación, se puede hacer así:
        //Ya no necesitamos el modelo Director ya que estamos usando la validación
        /*$director = new Director();
        $director->nombres = $this->nombres;
        $director->apellidos = $this->apellidos;
        $director->dni = $this->dni;
        $director->cargo = $this->cargo;
        $director->telefono = $this->telefono;
        $director->save();*/

        // Redireccion formulario de Laravel refrescando toda la pagina
        //redirect()->route('directores.index');

        //Redireccionar con Livewire sin refrescar toda la pagina con el parametro navigate
        session()->flash('status', 'Director creado exitosamente.'); // Mensaje flash para mostrar en la vista
        $this->redirectRoute('directores.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.directores.create');
    }
}
