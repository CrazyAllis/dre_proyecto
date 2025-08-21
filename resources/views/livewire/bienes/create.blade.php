<div>
    <form wire:submit='save' class="space-y-4 max-w-2xl p-4 bg-surface-alt dark:bg-surface-dark-alt rounded-lg shadow-md" >

        <div class="flex w-full max-w-xs flex-col gap-1 text-on-surface dark:text-on-surface-dark">
            <label for="institucion_id" class="w-fit pl-0.5 text-sm">Institución</label>
            <select id="institucion_id" wire:model='form.institucion_id' class="w-full rounded-radius border border-outline bg-surface-alt px-2 py-2 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary disabled:cursor-not-allowed disabled:opacity-75 dark:border-outline-dark dark:bg-surface-dark-alt/50 dark:focus-visible:outline-primary-dark">
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
        <x-form.input wire:model='form.tipo_bien' label="Tipo de Bien" name="form.tipo_bien" type="text" placeholder="Ingrese tipo de bien"/>
        <x-form.input wire:model='form.marca' label="Marca" name="form.marca" type="text" placeholder="Ingrese marca del bien"/>
        <x-form.input wire:model='form.modelo' label="Modelo" name="form.modelo" type="text" placeholder="Ingrese modelo del bien"/>
        <x-form.input wire:model='form.nro_serie' label="Número de Serie" name="form.nro_serie" type="text" placeholder="Ingrese número de serie"/>  
        <div class="flex w-full max-w-md flex-col gap-1 text-on-surface dark:text-on-surface-dark">
            <label for="descripcion" class="w-fit pl-0.5 text-sm">Descripción</label>
            <textarea wire:model='form.descripcion' id="descripcion" class="w-full rounded-radius border border-outline bg-surface-alt px-2.5 py-2 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary disabled:cursor-not-allowed disabled:opacity-75 dark:border-outline-dark dark:bg-surface-dark-alt/50 dark:focus-visible:outline-primary-dark" rows="3" placeholder="descripción del bien..."></textarea>
        </div>
        <x-form.input wire:model='form.oficina_ubicacion' label="Oficina/Área" name="form.oficina_ubicacion" type="text" placeholder="Ingrese oficina o área donde se encuentra el bien"/>
        <x-form.select wire:model='form.estado' label="Estado" name="form.estado" :options="$estadosBienes" placeholder="Seleccione estado del bien"/>
        <x-form.input wire:model='form.fecha_adquisicion' label="Fecha de Adquisición" name="form.fecha_adquisicion" type="date" placeholder="Seleccione fecha de adquisición"/>
        <div class="flex w-full max-w-md flex-col gap-1 text-on-surface dark:text-on-surface-dark">
            <label for="observaciones" class="w-fit pl-0.5 text-sm">Observaciones</label>
            <textarea wire:model='form.observaciones' id="observaciones" class="w-full rounded-radius border border-outline bg-surface-alt px-2.5 py-2 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary disabled:cursor-not-allowed disabled:opacity-75 dark:border-outline-dark dark:bg-surface-dark-alt/50 dark:focus-visible:outline-primary-dark" rows="3" placeholder="Observaciones..."></textarea>
        </div>

        <button type="submit" class="whitespace-nowrap rounded-radius bg-primary border border-primary px-4 py-2 text-sm font-medium tracking-wide text-on-primary transition hover:opacity-75 text-center focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:bg-primary-dark dark:border-primary-dark dark:text-on-primary-dark dark:focus-visible:outline-primary-dark">
            {{ request()->routeIs('bienes.create') ? 'Crear' : 'Actualizar' }}
        </button>

        <a href="{{ route('bienes.index') }}" wire:navigate>
            <!-- danger Button -->
            <button type="button" class="whitespace-nowrap rounded-radius bg-danger border border-danger px-4 py-2 text-sm font-medium tracking-wide text-on-danger transition hover:opacity-75 text-center focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-danger active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:bg-danger dark:border-danger dark:text-onDanger dark:focus-visible:outline-danger">
                Cancelar
            </button>
        </a> 
    </form>
</div>
