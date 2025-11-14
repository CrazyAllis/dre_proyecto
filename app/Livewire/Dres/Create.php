<?php

namespace App\Livewire\Dres;

use App\Livewire\Forms\DreForm;
use Livewire\Component;

class Create extends Component
{
    public DreForm $form;

    public function save()
    {
        $this->form->store();
        
        session()->flash('status', 'DRE creada correctamente.');
        $this->redirectRoute('dres.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.dres.create');
    }
}
