<?php

namespace App\Livewire\Instituciones;

use App\Models\Institucion;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $modalIsOpen = false;
    public $institucionSeleccionada;

    public function verInstitucion($id)
    {
        $this->institucionSeleccionada = Institucion::with(['director'])->findOrFail($id);
        $this->modalIsOpen = true;
    }

    public function delete(Institucion $institucion)
    {
        $institucion->delete(); // Elimina la institución seleccionada

        session()->flash('status', 'Institución eliminada correctamente.'); // Mensaje de éxito
        $this->redirectRoute('instituciones.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.instituciones.index', [
            'instituciones' => Institucion::latest()->paginate(10)
        ]);
    }
}
