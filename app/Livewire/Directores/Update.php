<?php

namespace App\Livewire\Directores;

use App\Livewire\Forms\DirectorForm;
use App\Models\Director;
use Livewire\Component;

class Update extends Component
{
    public DirectorForm $form; // Instancia del formulario DirectorForm

    public function mount(Director $director)
    {
        $this->form->setDirector($director); // Asigna la instancia del formulario al componente
    }

    public function save()
    {
        $this->form->update(); // Llama al método store del formulario DirectorForm

        session()->flash('status', 'Director actualizado exitosamente.'); // Mensaje flash para mostrar en la vista
        $this->redirectRoute('directores.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.directores.create');
    }
}
