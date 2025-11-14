<?php

namespace App\Livewire\Bienes;

use App\Models\Bien;
use App\Models\Institucion;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $modalIsOpen = false;
    public $bienSeleccionado;
    public $search = '';
    public $institucionSeleccionada = '';
    public $estadoSeleccionado = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingInstitucionSeleccionada()
    {
        $this->resetPage();
    }

    public function updatingEstadoSeleccionado()
    {
        $this->resetPage();
    }

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
            'bienes' => Bien::with('institucion','detalle', 'dre')
            ->search($this->search)
            ->filterInstitucion($this->institucionSeleccionada)
            ->filterEstado($this->estadoSeleccionado)->latest()->paginate(10),
            'instituciones' => Institucion::orderBy('nombre_ie')->get(), // Obtener todas las instituciones ordenadas por nombre y pasarlas a la vista
        ]);
    }
}
