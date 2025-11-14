<?php

namespace App\Livewire\Bienes;

use App\Livewire\Forms\BienForm;
use App\Models\Bien;
use App\Models\Detalle;
use App\Models\Dre;
use App\Models\Institucion;
use Livewire\Component;

class Update extends Component
{
    public BienForm $form;

    public function getMostrarSpecsProperty()
    {
        $detalle = Detalle::find($this->form->detalle_id);

        return $detalle && in_array($detalle->tipo_componente, ['Laptop', 'PC escritorio']);
    }

    public function getEsDreProperty()
    {
        $institucion = Institucion::find($this->form->institucion_id);

        return $institucion && $institucion->nombre_ie === 'DRE';
    }

    public function updatedFormDetalleId()
    {
        // Esto hace que Livewire re-renderice automáticamente
    }

    public function detalleChanged($detalleId)
    {
        $this->form->detalle_id = $detalleId;
    }

    public function institucionChanged($institucionId)
    {
        $this->form->institucion_id = $institucionId;
    }


    public function mount(Bien $bien)
    {
        $this->form->setBien($bien); // Asigna el bien al formulario
    }

    public function save()
    {
        $this->form->update(); // Llama al método update del formulario para actualizar el bien
        session()->flash('status', 'Bien actualizado exitosamente.'); // Mensaje de éxito
        $this->redirectRoute('bienes.index', navigate: true); // Redirige a la lista de bienes
    }

    public function render()
    {
        $instituciones = Institucion::orderBy('nombre_ie', 'ASC')->get();
        $detalles = Detalle::all();
        $dres = Dre::all();

        return view('livewire.bienes.create', [
            'instituciones' => $instituciones,
            'detalles' => $detalles,
            'dres' => $dres,
            'estadosBienes' => $this->form->estadosBienes,
            'almacenamientoBienes' => $this->form->almacenamientoBienes,
        ]);
    }
}
