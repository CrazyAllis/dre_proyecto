<?php

namespace App\Livewire\Dres;

use App\Models\Dre;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $modalIsOpen = false;
    public $dreSeleccionado;

    public function verDre($id)
    {
        $this->dreSeleccionado = Dre::findOrFail($id);
        $this->modalIsOpen = true;
    }

    public function delete(Dre $dre)
    {
        $dre->delete();

        session()->flash('status', 'Dato eliminado correctamente.');
        $this->redirectRoute('dres.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.dres.index', [
            'dres' => Dre::latest()->paginate(10),
        ]);
    }
}
