<div>
    <form wire:submit='save' class="space-y-4 max-w-2xl p-4 bg-surface-alt dark:bg-surface-dark-alt rounded-lg shadow-md" >

        <div class="flex w-full max-w-xs flex-col gap-1 text-on-surface dark:text-on-surface-dark">
            <label for="institucion_id" class="w-fit pl-0.5 text-sm">Institución</label>
            <select id="institucion_id" wire:model='form.institucion_id' 
            wire:change="institucionChanged($event.target.value)" class="w-full rounded-radius border border-outline bg-surface-alt px-2 py-2 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary disabled:cursor-not-allowed disabled:opacity-75 dark:border-outline-dark dark:bg-surface-dark-alt/50 dark:focus-visible:outline-primary-dark">
                <option value="">Seleccione una institución</option>
                @foreach($instituciones as $institucion)
                    <option value="{{ $institucion->id }}">{{ $institucion->nombre_ie }}</option>
                @endforeach
            </select>
            @error('form.institucion_id')
                <span class="text-danger text-sm">{{ $message }}</span>
            @enderror
        </div>

        <x-form.input wire:model='form.codigo_patrimonial' label="Código Patrimonial" name="form.codigo_patrimonial" type="text" placeholder="Ingrese código patrimonial"/>

        @if ($this->esDre)
            <div class="flex w-full max-w-xs flex-col gap-1 text-on-surface dark:text-on-surface-dark">
                <label for="dre_id" class="w-fit pl-0.5 text-sm">Oficina: Responsable</label>
                <select id="dre_id" wire:model='form.dre_id' class="w-full rounded-radius border border-outline bg-surface-alt px-2 py-2 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary disabled:cursor-not-allowed disabled:opacity-75 dark:border-outline-dark dark:bg-surface-dark-alt/50 dark:focus-visible:outline-primary-dark">
                    <option value="">Seleccione</option>
                    @foreach($dres as $dre)
                        <option value="{{ $dre->id }}">{{ $dre->oficina }}: {{ $dre->responsable }}</option>
                    @endforeach
                </select>
                @error('form.dre_id')
                    <span class="text-danger text-sm">{{ $message }}</span>
                @enderror
            </div>
        @endif

        <div class="flex w-full max-w-xs flex-col gap-1 text-on-surface dark:text-on-surface-dark">
            <label for="detalle_id" class="w-fit pl-0.5 text-sm">Tipo de Bien</label>
            <select id="detalle_id" wire:model='form.detalle_id' 
            wire:change="detalleChanged($event.target.value)" class="w-full rounded-radius border border-outline bg-surface-alt px-2 py-2 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary disabled:cursor-not-allowed disabled:opacity-75 dark:border-outline-dark dark:bg-surface-dark-alt/50 dark:focus-visible:outline-primary-dark">
                <option value="">Seleccione un tipo de bien</option>
                @foreach($detalles as $detalle)
                    <option value="{{ $detalle->id }}">{{ $detalle->tipo_componente }}</option>
                @endforeach
            </select>
            @error('form.detalle_id')
                <span class="text-danger text-sm">{{ $message }}</span>
            @enderror
        </div>

        <x-form.input wire:model='form.marca' label="Marca" name="form.marca" type="text" placeholder="Ingrese marca del bien"/>
        <x-form.input wire:model='form.modelo' label="Modelo" name="form.modelo" type="text" placeholder="Ingrese modelo del bien"/>
        <x-form.input wire:model='form.nro_serie' label="Número de Serie" name="form.nro_serie" type="text" placeholder="Ingrese número de serie"/>
        @if ($this->mostrarSpecs)
            <x-form.input wire:model='form.procesador' label="Procesador" name="form.procesador" type="text" placeholder="ej. Intel Core i7"/>
            <x-form.input wire:model='form.ram' label="RAM" name="form.ram" type="text" placeholder="ej. 8 GB"/>
            <x-form.select wire:model='form.tipo_almacenamiento' label="Tipo de Almacenamiento" name="form.tipo_almacenamiento" :options="$almacenamientoBienes" placeholder="Seleccione"/>
            <x-form.input wire:model='form.capacidad_almacenamiento' label="Capacidad de Almacenamiento" name="form.capacidad_almacenamiento" type="text" placeholder="ej. 1 TB, 980 GB..."/>  
        @endif
        <div class="flex w-full max-w-md flex-col gap-1 text-on-surface dark:text-on-surface-dark">
            <label for="descripcion" class="w-fit pl-0.5 text-sm">Descripción</label>
            <textarea wire:model='form.descripcion' id="descripcion" class="w-full rounded-radius border border-outline bg-surface-alt px-2.5 py-2 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary disabled:cursor-not-allowed disabled:opacity-75 dark:border-outline-dark dark:bg-surface-dark-alt/50 dark:focus-visible:outline-primary-dark" rows="3" placeholder="descripción del bien..."></textarea>
        </div>

        @if (! $this->esDre)
            <x-form.input wire:model='form.oficina_ubicacion' label="Oficina/Área" name="form.oficina_ubicacion" type="text" placeholder="Ingrese oficina o área donde se encuentra el bien"/>
        @endif

        <x-form.select wire:model='form.estado' label="Estado" name="form.estado" :options="$estadosBienes" placeholder="Seleccione estado del bien"/>
        <x-form.input wire:model='form.fecha_adquisicion' label="Fecha de Adquisición" name="form.fecha_adquisicion" type="date" placeholder="Seleccione fecha de adquisición"/>
        <div class="flex w-full max-w-md flex-col gap-1 text-on-surface dark:text-on-surface-dark">
            <label for="observaciones" class="w-fit pl-0.5 text-sm">Observaciones</label>
            <textarea wire:model='form.observaciones' id="observaciones" class="w-full rounded-radius border border-outline bg-surface-alt px-2.5 py-2 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary disabled:cursor-not-allowed disabled:opacity-75 dark:border-outline-dark dark:bg-surface-dark-alt/50 dark:focus-visible:outline-primary-dark" rows="3" placeholder="Observaciones..."></textarea>
        </div>

        <button type="submit" class="whitespace-nowrap rounded-radius bg-primary border border-primary px-4 py-2 text-sm font-medium tracking-wide text-on-primary transition hover:opacity-75 text-center focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:bg-primary-dark dark:border-primary-dark dark:text-on-primary-dark dark:focus-visible:outline-primary-dark">
            <!--{{ request()->routeIs('bienes.create') ? 'Crear' : 'Actualizar' }}-->
            {{ $form->isEditing ? 'Actualizar' : 'Crear' }}
        </button>

        <a href="{{ route('bienes.index') }}" wire:navigate>
            <!-- danger Button -->
            <button type="button" class="whitespace-nowrap rounded-radius bg-danger border border-danger px-4 py-2 text-sm font-medium tracking-wide text-on-danger transition hover:opacity-75 text-center focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-danger active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:bg-danger dark:border-danger dark:text-onDanger dark:focus-visible:outline-danger">
                Cancelar
            </button>
        </a> 
    </form>
</div>
