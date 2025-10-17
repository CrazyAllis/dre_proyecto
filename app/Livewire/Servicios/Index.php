<?php

namespace App\Livewire\Servicios;

use App\Models\Institucion;
use App\Models\Proveedor;
use App\Models\Servicio;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $modalIsOpen = false;
    public $servicioSeleccionado;
    public $search = '';
    public $institucionSeleccionada = '';
    public $proveedorSeleccionado = '';
    public $estadoSeleccionado = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingInstitucionSeleccionada()
    {
        $this->resetPage();
    }

    public function updatingProveedorSeleccionado()
    {
        $this->resetPage();
    }

    public function updatingEstadoSeleccionado()
    {
        $this->resetPage();
    }

    public function verServicio($id)
    {
        $this->servicioSeleccionado = Servicio::with(['institucion', 'proveedor'])->findOrFail($id);
        $this->modalIsOpen = true;
    }

    public function delete(Servicio $servicio)
    {
        $servicio->delete(); // Elimina el servicio seleccionado

        session()->flash('status', 'Servicio eliminado correctamente.'); // Mensaje de éxito
        $this->redirectRoute('servicios.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.servicios.index', [
            'servicios' => Servicio::with(['institucion', 'proveedor'])
            ->search($this->search)
            ->filterInstitucion($this->institucionSeleccionada)
            ->filterProveedor($this->proveedorSeleccionado)
            ->filterEstado($this->estadoSeleccionado)->latest()->paginate(10),
            'instituciones' => Institucion::orderBy('nombre_ie')->get(),
            'proveedores' => Proveedor::orderBy('nombre')->get(),
        ]);
    }
}
