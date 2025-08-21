<?php

namespace App\Livewire\Detalles;

use App\Models\Bien;
use App\Models\Detalle;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{   
    use WithPagination;

    public function delete(Detalle $detalle)
    {
        $detalle->delete();
        session()->flash('status', 'Detalle eliminado exitosamente.');
        $this->redirectRoute('detalles.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.detalles.index', [
            'detalles' => Detalle::latest()->paginate(10)
        ]);
    }
}
