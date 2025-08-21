<?php

namespace App\Livewire\Bienes;

use App\Livewire\Forms\BienForm;
use App\Models\Bien;
use App\Models\Institucion;
use Livewire\Component;

class Update extends Component
{
    public BienForm $form;

    public function mount(Bien $bien)
    {
        $this->form->setBien($bien); // Asigna el bien al formulario
    }

    public function save()
    {
        $this->form->update(); // Llama al método update del formulario para actualizar el bien
        session()->flash('status', 'Bien actualizado exitosamente.'); // Mensaje de éxito
        $this->redirectRoute('bienes.index', navigate: true); // Redirige a la lista de bienes
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
