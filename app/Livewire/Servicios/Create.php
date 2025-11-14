<?php

namespace App\Livewire\Servicios;

use App\Livewire\Forms\ServicioForm;
use App\Models\Institucion;
use App\Models\Proveedor;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public ServicioForm $form;

    public function save()
    {
        $this->form->store(); // Llama al método store del formulario ServicioForm

        //Redireccionar con Livewire sin refrescar toda la pagina con el parametro navigate
        session()->flash('status', 'Servicio creado exitosamente.');
        $this->redirectRoute('servicios.index', navigate: true);
    }

    public function render()
    {

        $instituciones = Institucion::orderBy('nombre_ie', 'ASC')->get();
        $proveedores = Proveedor::orderBy('nombre', 'ASC')->get();

        return view('livewire.servicios.create', [
            'instituciones' => $instituciones,
            'proveedores' => $proveedores,
            'estadosContrato' => $this->form->estadosContrato,
            'entidadesPago' => $this->form->entidadesPago,
        ]);
    }
}
