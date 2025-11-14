<?php

namespace App\Livewire\Detalles;

use App\Livewire\Forms\DetalleForm;
use App\Models\Bien;
use App\Models\Detalle;
use Livewire\Component;

class Update extends Component
{
    public DetalleForm $form;

    public function mount(Detalle $detalle)
    {
        $this->form->setDetalle($detalle); // Asigna el modelo Detalle al formulario
    }

    public function save()
    {
        $this->form->update(); // Llama al método store del formulario DetalleForm

        // Redireccionar con Livewire sin refrescar toda la pagina con el parametro navigate
        session()->flash('status', 'Detalle actualizado exitosamente.');
        $this->redirectRoute('detalles.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.detalles.create');
    }
}
