<?php

namespace App\Livewire\Instituciones;

use App\Livewire\Forms\InstitucionForm;
use App\Models\Director;
use App\Models\Institucion;
use Livewire\Component;

class Update extends Component
{
    public InstitucionForm $form;

    public function mount(Institucion $institucion)
    {
        $this->form->setInstitucion($institucion);
    }

    public function save()
    {
        $this->form->update(); // Llama al método update del formulario para actualizar la institución
        session()->flash('status', 'Institución actualizada correctamente.'); // Mensaje de éxito
        $this->redirectRoute('instituciones.index', navigate: true); // Redirige a la lista de instituciones
    }

    public function render()
    {
        // Obtén la lista de directores desde la base de datos
        $directores = Director::all();

        return view('livewire.instituciones.create', [
            'directores' => $directores,
            'niveles' => $this->form->niveles, // Accede a los niveles desde el formulario
            'estadosInstitucion' => $this->form->estadosInstitucion, // Accede a los estados desde el formulario
        ]);
    }
}
