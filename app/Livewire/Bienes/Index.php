<?php

namespace App\Livewire\Bienes;

use App\Models\Bien;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $modalIsOpen = false;
    public $bienSeleccionado;

    public function verBien($id)
    {
        $this->bienSeleccionado = Bien::with(['institucion'])->findOrFail($id);
        $this->modalIsOpen = true;
    }

    public function delete(Bien $bien)
    {
        $bien->delete(); // Elimina el bien
        session()->flash('status', 'Bien eliminado exitosamente.'); // Mensaje de éxito
        $this->redirectRoute('bienes.index', navigate: true); // Redirige a la lista de bienes
    }

    public function render()
    {
        return view('livewire.bienes.index', [
            'bienes' => Bien::latest()->paginate(10)
        ]);
    }
}
