<?php

namespace App\Livewire\Bienes;

use App\Livewire\Forms\BienForm;
use App\Models\Bien;
use App\Models\Detalle;
use App\Models\Dre;
use App\Models\Institucion;
use Livewire\Component;

class FichaRegistro extends Component
{
    public BienForm $form;
    public $bienesTemp = [];

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

    public function detalleChanged($detalleId)
    {
        $this->form->detalle_id = $detalleId;

        $detalle = Detalle::find($detalleId);

        $esLaptopPC = $detalle && in_array($detalle->tipo_componente, ['Laptop', 'PC escritorio']);
    
        if (!$esLaptopPC) {
            $this->form->procesador = null;
            $this->form->ram = null;
            $this->form->tipo_almacenamiento = null;
            $this->form->capacidad_almacenamiento = null;
        }
    }

    public function institucionChanged($institucionId)
    {
        $this->form->institucion_id = $institucionId;

        // Obtener nombre
        $institucion = Institucion::find($institucionId);

        // Si ya NO es DRE, limpiar select "Oficina: Responsable"
        if (!$institucion || $institucion->nombre_ie !== 'DRE') {
            $this->form->dre_id = null;
        }

        // Si AHORA es DRE, limpiar Oficina/Área
        if ($institucion && $institucion->nombre_ie === 'DRE') {
            $this->form->oficina_ubicacion = null;
        }
    }

    public function agregarBien()
    {
        // Validamos con las reglas del form
        $this->form->validate();

        // Agregamos a la lista temporal
        $this->bienesTemp[] = [
            'institucion_id' => $this->form->institucion_id,
            'codigo_patrimonial' => $this->form->codigo_patrimonial,
            'dre_id' => $this->form->dre_id,
            'detalle_id' => $this->form->detalle_id,
            'marca' => $this->form->marca,
            'modelo' => $this->form->modelo,
            'nro_serie' => $this->form->nro_serie,
            'procesador' => $this->form->procesador,
            'ram' => $this->form->ram,
            'tipo_almacenamiento' => $this->form->tipo_almacenamiento,
            'capacidad_almacenamiento' => $this->form->capacidad_almacenamiento,
            'descripcion' => $this->form->descripcion,
            'oficina_ubicacion' => $this->form->oficina_ubicacion,
            'estado' => $this->form->estado,
            'fecha_adquisicion' => $this->form->fecha_adquisicion,
            'observaciones' => $this->form->observaciones,
        ];

        // Limpiamos los campos del form (pero sin perder instancia)
        $this->form->reset();
    }

    public function eliminarBien($index)
    {
        unset($this->bienesTemp[$index]);
        $this->bienesTemp = array_values($this->bienesTemp); // reindexar
    }

    public function guardarTodo()
    {
        foreach ($this->bienesTemp as $bienData) {
            Bien::create($bienData);
        }

        $this->bienesTemp = [];
        session()->flash('status', 'Todos los datos fueron guardados exitosamente.');
    }


    public function render()
    {
        $instituciones = Institucion::orderBy('nombre_ie', 'ASC')->get();
        $detalles = Detalle::orderBy('tipo_componente', 'ASC')->get();
        $dres = Dre::orderBy('oficina', 'ASC')->get();
        
        return view('livewire.bienes.ficha-registro', [
            'instituciones' => $instituciones,
            'detalles' => $detalles,
            'dres' => $dres,
            'estadosBienes' => $this->form->estadosBienes,
            'almacenamientoBienes' => $this->form->almacenamientoBienes,
        ]);
    }
}
