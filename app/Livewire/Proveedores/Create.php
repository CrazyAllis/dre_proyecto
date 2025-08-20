<?php

namespace App\Livewire\Proveedores;

use App\Livewire\Forms\ProveedorForm;
use Livewire\Component;

class Create extends Component
{
    public ProveedorForm $form;

    public function save()
    {
        $this->form->store(); // Llama al método store del formulario ProveedorForm

        //Redireccionar con Livewire sin refrescar toda la pagina con el parametro navigate
        session()->flash('status', 'Proveedor de servicio creado exitosamente.');
        $this->redirectRoute('proveedores.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.proveedores.create');
    }
}
