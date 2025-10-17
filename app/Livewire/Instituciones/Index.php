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
    public string $search = ''; // Variable para el término de búsqueda
    public $nivelSeleccionado = ''; // Variable para el filtro de nivel
    public $estadoSeleccionado = ''; // Variable para el filtro de estado

    public function updatingSearch()
    {
        $this->resetPage(); // Reinicia la paginación cuando cambias la búsqueda
    }

    public function updatingNivelSeleccionado()
    {
        $this->resetPage();
    }

    public function updatingEstadoSeleccionado()
    {
        $this->resetPage();
    }

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
            'instituciones' => Institucion::search($this->search)
            ->filterNivel($this->nivelSeleccionado)
            ->filterEstado($this->estadoSeleccionado)->latest()->paginate(10)
        ]);
    }
}
