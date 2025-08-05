<?php

namespace App\Livewire\Directores;

use App\Models\Director;
use Livewire\Component;

class Create extends Component
{
    public $nombres;
    public $apellidos;
    public $dni;
    public $cargo;
    public $telefono;

    public function store()
    {

        $validate = $this->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'dni' => 'required|string|max:8|unique:directors,dni',
            'cargo' => 'nullable|string|max:100',
            'telefono' => 'nullable|string|max:15',
        ]);

        Director::create($validate);
        
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
