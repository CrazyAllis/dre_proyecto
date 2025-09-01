<?php

namespace App\Livewire\Servicios;

use App\Models\Servicio;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $modalIsOpen = false;
    public $servicioSeleccionado;

    public function verServicio($id)
    {
        $this->servicioSeleccionado = Servicio::with(['institucion', 'proveedor'])->findOrFail($id);
        $this->modalIsOpen = true;
    }

    public function delete(Servicio $servicio)
    {
        $servicio->delete(); // Elimina el servicio seleccionado

        session()->flash('status', 'Servicio eliminado correctamente.'); // Mensaje de éxito
        $this->redirectRoute('servicios.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.servicios.index', [
            'servicios' => Servicio::latest()->paginate(10),
        ]);
    }
}
