<?php

namespace App\Livewire\Proveedores;

use App\Models\Proveedor;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function delete(Proveedor $proveedor)
    {
        $proveedor->delete(); // Elimina el proveedor
        
        session()->flash('status', 'Proveedor eliminado exitosamente.'); // Mensaje flash para mostrar en la vista
        $this->redirectRoute('proveedores.index', navigate: true); // Redirecciona a la lista de proveedores
    }

    public function render()
    {
        return view('livewire.proveedores.index', [
            'proveedores' => Proveedor::paginate(10),
        ]);
    }
}
