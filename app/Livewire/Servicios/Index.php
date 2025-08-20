<?php

namespace App\Livewire\Servicios;

use App\Models\Servicio;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;


    public function render()
    {
        return view('livewire.servicios.index', [
            'servicios' => Servicio::latest()->paginate(10),
        ]);
    }
}
