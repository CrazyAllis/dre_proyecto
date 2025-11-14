<?php

namespace App\Livewire\Servicios;

use App\Livewire\Forms\ServicioForm;
use App\Models\Institucion;
use App\Models\Proveedor;
use App\Models\Servicio;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Update extends Component
{
    use WithFileUploads;

    public ServicioForm $form;

    protected $listeners = ['eliminar-documento' => 'eliminarDocumento'];

    public function mount(Servicio $servicio)
    {
        $this->form->setServicio($servicio); // Asigna el servicio al formulario
    }

    public function eliminarDocumento()
    {
        if ($this->form->servicio->documento && Storage::disk('public')->exists($this->form->servicio->documento)) {
            Storage::disk('public')->delete($this->form->servicio->documento);
            $this->form->servicio->update(['documento' => null]);
            $this->form->documento = null;

            session()->flash('status', 'Documento eliminado correctamente.');
        }
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
            'entidadesPago' => $this->form->entidadesPago,
        ]);
    }
}
