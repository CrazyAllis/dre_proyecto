<?php

namespace App\Livewire\Directores;

use App\Livewire\Forms\DirectorForm;
use App\Models\Director;
use Livewire\Component;

class FichaRegistro extends Component
{

    public DirectorForm $form;
    public $directoresTemp = [];

    public function agregarDirector()
    {
        // Validamos con las reglas del form
        $this->form->validate();

        // Agregamos a la lista temporal
        $this->directoresTemp[] = [
            'nombres' => $this->form->nombres,
            'apellidos' => $this->form->apellidos,
            'dni' => $this->form->dni,
            'cargo' => $this->form->cargo,
            'telefono' => $this->form->telefono,
        ];

        // Limpiamos los campos del form (pero sin perder instancia)
        $this->form->reset(['nombres', 'apellidos', 'dni', 'cargo', 'telefono']);
    }

    public function eliminarDirector($index)
    {
        unset($this->directoresTemp[$index]);
        $this->directoresTemp = array_values($this->directoresTemp); // reindexar
    }

    public function guardarTodo()
    {
        foreach ($this->directoresTemp as $dir) {
            Director::create($dir);
        }

        $this->directoresTemp = [];
        session()->flash('status', 'Todos los datos fueron guardados exitosamente.');
    }


    public function render()
    {
        return view('livewire.directores.ficha-registro');
    }
}
