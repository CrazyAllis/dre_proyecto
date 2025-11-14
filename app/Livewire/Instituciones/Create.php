<?php

namespace App\Livewire\Instituciones;

use App\Livewire\Forms\InstitucionForm;
use App\Models\Director;
use Livewire\Component;

class Create extends Component
{
    public InstitucionForm $form; // Instancia del formulario InstitucionForm
    
    public function save()
    {
        $this->form->store(); // Llama al método store del formulario InstitucionForm

        //Redireccionar con Livewire sin refrescar toda la pagina con el parametro navigate
        session()->flash('status', 'Institución creada exitosamente.'); // Mensaje flash para mostrar en la vista
        $this->redirectRoute('instituciones.index', navigate: true);
    }

    public function render()
    {
        // Obtén la lista de directores desde la base de datos
        $directores = Director::orderBy('nombres', 'ASC')->get();

        // Pasa los directores a la vista
        return view('livewire.instituciones.create', [
            'directores' => $directores,
            'niveles' => $this->form->niveles, // Accede a los niveles desde el formulario
            'estadosInstitucion' => $this->form->estadosInstitucion, // Accede a los estados desde el formulario
        ]);
    }
}
