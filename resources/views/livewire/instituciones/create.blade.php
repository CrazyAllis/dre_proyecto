<div>
    <form wire:submit='save' class="space-y-4 max-w-2xl p-4 bg-surface-alt dark:bg-surface-dark-alt rounded-lg shadow-md">
        <x-form.input wire:model='form.codigo_modular' label="Código Modular" name="form.codigo_modular" placeholder="Ingrese código modular"/>
        <x-form.input wire:model='form.nombre_ie' label="Nombre IE" name="form.nombre_ie" placeholder="Ingrese nombre de la institución"/>
        <x-form.select wire:model='form.nivel' label="Nivel" name="form.nivel" :options="$niveles" placeholder="Seleccione nivel"/>
        <x-form.input wire:model='form.distrito' label="Distrito" name="form.distrito" placeholder="Ingrese distrito"/>
        <x-form.input wire:model='form.provincia' label="Provincia" name="form.provincia" placeholder="Ingrese provincia"/>
        <x-form.input wire:model='form.direccion' label="Dirección" name="form.direccion" placeholder="Ingrese dirección"/>
        <x-form.select wire:model='form.estado_institucion' label="Estado de la Institución" name="form.estado_institucion" :options="$estadosInstitucion" placeholder="Seleccione estado"/>
        <x-form.input wire:model='form.latitud' label="Latitud" name="form.latitud" type="text" step="any" placeholder="Ingrese latitud"/>
        <x-form.input wire:model='form.longitud' label="Longitud" name="form.longitud" type="text" step="any" placeholder="Ingrese longitud"/>
        
        <!-- Input para seleccionar director -->
        <div class="flex w-full max-w-xs flex-col gap-1 text-on-surface dark:text-on-surface-dark">
            <label for="director_id" class="w-fit pl-0.5 text-sm">Director</label>
            <select id="director_id" wire:model='form.director_id' class="w-full rounded-radius border border-outline bg-surface-alt px-2 py-2 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary disabled:cursor-not-allowed disabled:opacity-75 dark:border-outline-dark dark:bg-surface-dark-alt/50 dark:focus-visible:outline-primary-dark">
                <option value="">Seleccione un director</option>
                @foreach($directores as $director)
                    <option value="{{ $director->id }}">{{ $director->nombres }} {{ $director->apellidos }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="whitespace-nowrap rounded-radius bg-primary border border-primary px-4 py-2 text-sm font-medium tracking-wide text-on-primary transition hover:opacity-75 text-center focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:bg-primary-dark dark:border-primary-dark dark:text-on-primary-dark dark:focus-visible:outline-primary-dark">
            {{ request()->routeIs('instituciones.create') ? 'Crear' : 'Actualizar' }}
        </button>
        
        <a href="{{ route('instituciones.index') }}" wire:navigate>
            <!-- danger Button -->
            <button type="button" class="whitespace-nowrap rounded-radius bg-danger border border-danger px-4 py-2 text-sm font-medium tracking-wide text-on-danger transition hover:opacity-75 text-center focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-danger active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:bg-danger dark:border-danger dark:text-onDanger dark:focus-visible:outline-danger">
                Cancelar
            </button>
        </a>  
    </form>
</div>
