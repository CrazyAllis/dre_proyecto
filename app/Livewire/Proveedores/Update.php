<?php

namespace App\Livewire\Proveedores;

use App\Livewire\Forms\ProveedorForm;
use App\Models\Proveedor;
use Livewire\Component;

class Update extends Component
{
    public ProveedorForm $form; // Instancia del formulario ProveedorForm

    public function mount(Proveedor $proveedor)
    {
        $this->form->setProveedor($proveedor); // Asigna la instancia del formulario al componente
    }

    public function save()
    {
        $this->form->update(); // Llama al método update del formulario ProveedorForm

        session()->flash('status', 'Proveedor actualizado exitosamente.'); // Mensaje flash para mostrar en la vista
        $this->redirectRoute('proveedores.index', navigate: true); // Redirecciona a la lista de proveedores
    }

    public function render()
    {
        return view('livewire.proveedores.create');
    }
}
