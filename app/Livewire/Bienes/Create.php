<?php

namespace App\Livewire\Bienes;

use App\Livewire\Forms\BienForm;
use App\Models\Bien;
use App\Models\Institucion;
use Livewire\Component;

class Create extends Component
{
    public BienForm $form;

    public function save()
    {
        $this->form->store(); // Llama al método store del formulario BienForm

        // Redireccionar con Livewire sin refrescar toda la pagina con el parametro navigate
        session()->flash('status', 'Bien creado exitosamente.');
        $this->redirectRoute('bienes.index', navigate: true);
    }

    public function render()
    {
        $instituciones = Institucion::all();

        return view('livewire.bienes.create', [
            'instituciones' => $instituciones,
            'estadosBienes' => $this->form->estadosBienes
        ]);
    }
}
