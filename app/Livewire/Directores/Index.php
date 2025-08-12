<?php

namespace App\Livewire\Directores;

use App\Models\Director;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function delete(Director $director)
    {
        $director->delete(); // Elimina el director seleccionado

        session()->flash('status', 'Director eliminado correctamente.'); // Mensaje de éxito
        $this->redirectRoute('directores.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.directores.index', [
            //'directores' => Director::paginate(10), //metodo para paginar los directores
            //'directores' => Director::simplePaginate(10) //metodo para paginar los directores de forma simple
            //'directores' => Director::all() //metodo para obtener todos los directores
            //'directores' => Director::take(3)->get() // Para llamar solo los primeros 3 directores
            'directores' => Director::latest()->paginate(10) // Para llamar los directores ordenados por fecha de creación
            //'directores' => Director::orderBy('name', 'asc')->get() // Para ordenar los directores por nombre en orden ascendente
            //'directores' => Director::orderBy('name', 'desc')->get() // Para ordenar los directores por nombre en orden descendente
            //'directores' => Director::where('name', 'like', '%John%')->get() // Para filtrar directores por nombre que contenga 'John'
            //'directores' => Director::where('created_at', '>=', now()->subDays(30))->get() // Para filtrar directores creados en los últimos
        ]);
    }
}
