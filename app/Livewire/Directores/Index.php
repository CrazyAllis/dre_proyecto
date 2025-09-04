<?php

namespace App\Livewire\Directores;

use App\Models\Director;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $modalIsOpen = false;
    public $directorSeleccionado;
    public string $search = ''; // Variable para el término de búsqueda

    public function updatingSearch()
    {
        $this->resetPage(); // Reinicia la paginación cuando cambias la búsqueda
    }

    public function verDirector($id)
    {
        $this->directorSeleccionado = Director::findOrFail($id);
        $this->modalIsOpen = true;
    }

    public function delete(Director $director)
    {
        $director->delete(); // Elimina el director seleccionado

        session()->flash('status', 'Director eliminado correctamente.'); // Mensaje de éxito
        $this->redirectRoute('directores.index', navigate: true);
    }

    /*
    public function render()
    {
        $q = trim($this->search); // Elimina espacios en blanco al inicio y al final
    
        $directores = Director::query()
            ->when($q !== '', function ($query) use ($q) {
                $palabras = explode(' ', $q); // Divide la búsqueda en palabras EJM. "Juan Pérez" → ['Juan', 'Pérez']
    
                $query->where(function ($subQuery) use ($palabras) {
                    foreach ($palabras as $palabra) {
                        $subQuery->where(function ($w) use ($palabra) {
                            $w->where('nombres', 'like', "%{$palabra}%")
                              ->orWhere('apellidos', 'like', "%{$palabra}%")
                              ->orWhere('dni', 'like', "%{$palabra}%");
                        });
                    }
                });
            })
            ->latest()
            ->paginate(10);
    
        return view('livewire.directores.index', compact('directores'));
    }
    */
    
    public function render()
    {
        return view('livewire.directores.index', [
            'directores' => Director::search($this->search)->latest()->paginate(10)
        ]);
    }
}
