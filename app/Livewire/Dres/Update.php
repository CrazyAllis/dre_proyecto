<?php

namespace App\Livewire\Dres;

use App\Livewire\Forms\DreForm;
use App\Models\Dre;
use Livewire\Component;

class Update extends Component
{
    public DreForm $form;

    public function mount(Dre $dre)
    {
        $this->form->setDre($dre);
    }

    public function save()
    {
        $this->form->update();

        session()->flash('status', 'Dato actualizado exitosamente.');
        $this->redirectRoute('dres.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.dres.create');
    }
}
