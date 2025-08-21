<?php

namespace App\Livewire\Servicios;

use App\Livewire\Forms\ServicioForm;
use App\Models\Institucion;
use App\Models\Proveedor;
use App\Models\Servicio;
use Livewire\Component;

class Update extends Component
{
    public ServicioForm $form;

    public function mount(Servicio $servicio)
    {
        $this->form->setServicio($servicio); // Asigna el servicio al formulario
    }

    public function save()
    {
        $this->form->update(); // Llama al método update del formulario para actualizar el servicio
        session()->flash('status', 'Servicio actualizado exitosamente.'); // Mensaje de éxito
        $this->redirectRoute('servicios.index', navigate: true); // Redirige a la lista de servicios
    }

    public function render()
    {
        $instituciones = Institucion::all();
        $proveedores = Proveedor::all();

        return view('livewire.servicios.create', [
            'instituciones' => $instituciones,
            'proveedores' => $proveedores,
            'estadosContrato' => $this->form->estadosContrato,
        ]);
    }
}
