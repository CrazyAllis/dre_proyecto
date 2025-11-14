<?php

namespace App\Livewire\Forms;

use App\Models\Servicio;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;

class ServicioForm extends Form
{

    public ?Servicio $servicio = null; // Instancia del modelo Servicio, se usa ? porque la propiedad puede ser nula
    public bool $isEditing = false; // Indica si el formulario está en modo edición

    public array $estadosContrato = [
        'Activo' => 'Activo',
        'Inactivo' => 'Inactivo',
    ];

    public array $entidadesPago = [
        'DRE' => 'DRE',
        'UGEL' => 'UGEL',
        'MINEDU' => 'MINEDU',
        'PROPIO' => 'PROPIO',

    ];

    // Validación de los campos del formulario
    
    #[Validate('required', message: 'La institución es obligatoria')]
    public $institucion_id;
    
    #[Validate('required', message: 'El proveedor es obligatorio')]
    public $proveedor_id;

    #[Validate('nullable|date')]
    public $fecha_inicio;

    #[Validate('nullable|date')]
    public $fecha_fin;

    #[Validate('required', message: 'La velocidad de subida es obligatoria')]
    #[Validate('numeric', message: 'La velocidad contratada debe ser un número')]
    public $velocidad_subida;

    #[Validate('required', message: 'La velocidad de bajada es obligatoria')]
    #[Validate('numeric', message: 'La velocidad contratada debe ser un número')]
    public $velocidad_bajada;

    #[Validate('required', message: 'Entidad que paga es obligatoria')]
    public $entidad_paga;

    #[Validate('required', message: 'El costo mensual es obligatorio')]
    #[Validate('numeric', message: 'El costo mensual debe ser un número')]
    public $costo_mensual;

    public $estado_contrato;

    #[Validate('nullable|string')]
    public $observaciones;

    #[Validate('nullable|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:10048', message: 'Formato de archivo no permitido o demasiado grande')]
    public $documento;

    public function setServicio(Servicio $servicio)
    {
        $this->isEditing = true; // Cambia el estado a edición
        $this->servicio = $servicio; // Asigna el modelo Servicio a la propiedad
        $this->institucion_id = $servicio->institucion_id;
        $this->proveedor_id = $servicio->proveedor_id;
        $this->fecha_inicio = $servicio->fecha_inicio?->format('Y-m-d'); // Formatea la fecha a 'Y-m-d'
        $this->fecha_fin = $servicio->fecha_fin?->format('Y-m-d');
        $this->velocidad_subida = $servicio->velocidad_subida;
        $this->velocidad_bajada = $servicio->velocidad_bajada;
        $this->entidad_paga = $servicio->entidad_paga;
        $this->costo_mensual = $servicio->costo_mensual;
        $this->estado_contrato = $servicio->estado_contrato;
        $this->observaciones = $servicio->observaciones;
    }

    public function save()
    {
        if ($this->isEditing) {
            $this->update();
        } else {
            $this->store();
        }
    }

    public function store()
    {
        $this->validate(); // Valida los datos del formulario

        $path = null;
        if ($this->documento) {
            // Asegura que el archivo realmente esté disponible antes de guardarlo
            if ($this->documento instanceof TemporaryUploadedFile) {
                $path = $this->documento->storeAs(
                    'documentos_servicios',
                    time() . '_' . $this->documento->getClientOriginalName(),
                    'public'
                );
            }
        }

        Servicio::create([
            'institucion_id' => $this->institucion_id,
            'proveedor_id' => $this->proveedor_id,
            'fecha_inicio' => $this->fecha_inicio ?: null,
            'fecha_fin' => $this->fecha_fin ?: null,
            'velocidad_subida' => $this->velocidad_subida,
            'velocidad_bajada' => $this->velocidad_bajada,
            'entidad_paga' => $this->entidad_paga,
            'costo_mensual' => $this->costo_mensual,
            'estado_contrato' => $this->estado_contrato,
            'observaciones' => $this->observaciones,
            'documento' => $path,
        ]);
    }

    public function update()
    {
        $this->validate(); // Valida los datos del formulario

        $path = $this->servicio->documento;

        if ($this->documento instanceof TemporaryUploadedFile) {
            if ($this->servicio->documento && Storage::disk('public')->exists($this->servicio->documento)) {
                Storage::disk('public')->delete($this->servicio->documento);
            }
        
            $path = $this->documento->storeAs(
                'documentos_servicios',
                time() . '_' . $this->documento->getClientOriginalName(),
                'public'
            );
        }

        $this->servicio->update(array_merge(
            $this->all(),
            [
                'fecha_inicio' => $this->fecha_inicio ?: null,
                'fecha_fin' => $this->fecha_fin ?: null,
                'documento' => $path,
            ]
        )); // Actualiza el modelo Servicio con los datos del formulario
    }
}
