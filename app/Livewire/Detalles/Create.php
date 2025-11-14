<?php

namespace App\Livewire\Detalles;

use App\Livewire\Forms\DetalleForm;
use App\Models\Bien;
use Livewire\Component;

class Create extends Component
{
    public DetalleForm $form;

    public function save()
    {
        $this->form->store(); // Llama al método store del formulario DetalleForm

        // Redireccionar con Livewire sin refrescar toda la pagina con el parametro navigate
        session()->flash('status', 'Detalle creado exitosamente.');
        $this->redirectRoute('detalles.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.detalles.create');
    }
}
