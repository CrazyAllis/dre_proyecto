<?php

namespace App\Livewire\Instituciones;

use App\Models\Institucion;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.instituciones.index', [
            'instituciones' => Institucion::latest()->paginate(10)
        ]);
    }
}
