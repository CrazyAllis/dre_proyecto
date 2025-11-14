<div>
    <form wire:submit='save' class="space-y-4 max-w-2xl p-4 bg-surface-alt dark:bg-surface-dark-alt rounded-lg shadow-md">
        
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
        
        <div class="flex w-full max-w-xs flex-col gap-1 text-on-surface dark:text-on-surface-dark">
            <label for="proveedor_id" class="w-fit pl-0.5 text-sm">Proveedor</label>
            <select id="proveedor_id" wire:model='form.proveedor_id' class="w-full rounded-radius border border-outline bg-surface-alt px-2 py-2 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary disabled:cursor-not-allowed disabled:opacity-75 dark:border-outline-dark dark:bg-surface-dark-alt/50 dark:focus-visible:outline-primary-dark">
                <option value="">Seleccione un proveedor</option>
                @foreach($proveedores as $proveedor)
                    <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                @endforeach
            </select>
            @error('form.proveedor_id')
                <span class="text-danger text-sm">{{ $message }}</span>
            @enderror
        </div>

        <x-form.input wire:model='form.fecha_inicio' label="Fecha Inicio" name="form.fecha_inicio" type="date" placeholder="Seleccione fecha de inicio"/>
        <x-form.input wire:model='form.fecha_fin' label="Fecha Fin" name="form.fecha_fin" type="date" placeholder="Seleccione fecha de fin"/>
        <x-form.input wire:model='form.velocidad_subida' label="Velocidad Subida (Mbps)" name="form.velocidad_subida" type="number" step="any" placeholder="Ingrese velocidad de subida en Mbps"/>
        <x-form.input wire:model='form.velocidad_bajada' label="Velocidad Bajada (Mbps)" name="form.velocidad_bajada" type="number" step="any" placeholder="Ingrese velocidad de bajada en Mbps"/>
        <x-form.select wire:model='form.entidad_paga' label="Entidad que Paga" name="form.entidad_paga" :options="$entidadesPago" placeholder="Seleccione la entidad que paga"/>
        <x-form.input wire:model='form.costo_mensual' label="Costo Mensual (S/.)" name="form.costo_mensual" type="number" step="any" placeholder="Ingrese costo mensual en S/."/>
        <x-form.select wire:model='form.estado_contrato' label="Estado de Contrato" name="form.estado_contrato" :options="$estadosContrato" placeholder="Seleccione estado de contrato"/>
        <div class="flex w-full max-w-md flex-col gap-1 text-on-surface dark:text-on-surface-dark">
            <label for="observaciones" class="w-fit pl-0.5 text-sm">Observaciones</label>
            <textarea wire:model='form.observaciones' id="observaciones" class="w-full rounded-radius border border-outline bg-surface-alt px-2.5 py-2 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary disabled:cursor-not-allowed disabled:opacity-75 dark:border-outline-dark dark:bg-surface-dark-alt/50 dark:focus-visible:outline-primary-dark" rows="3" placeholder="Observaciones..."></textarea>
        </div>

        <div class="relative flex w-full max-w-sm flex-col gap-1 text-on-surface dark:text-on-surface-dark">
            <label for="documento" class="w-fit pl-0.5 text-sm">Subir archivo (opcional)</label>
            <input type="file"
                id="documento"
                wire:model="form.documento"
                accept=".pdf,.doc,.docx,.png,.jpg,.jpeg"
                class="w-full max-w-md overflow-clip rounded-radius border border-outline bg-surface-alt/50 text-sm file:mr-4 file:border-none file:bg-surface-alt file:px-4 file:py-2 file:font-medium file:text-on-surface-strong focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary disabled:cursor-not-allowed disabled:opacity-75 dark:border-outline-dark dark:bg-surface-dark-alt/50 dark:file:bg-surface-dark-alt dark:file:text-on-surface-dark-strong dark:focus-visible:outline-primary-dark"
                >
                <small class="pl-0.5">PDF, DOCX, JPEG, JPG - Max 10MB</small>
            @error('form.documento') <span class="text-danger text-sm">{{ $message }}</span> @enderror

            @if ($form->servicio && $form->servicio->documento)
                <div class="flex items-center justify-between bg-surface-alt px-3 py-2 rounded-radius mt-2">
                    <a href="{{ Storage::url($form->servicio->documento) }}" target="_blank" class="text-primary underline text-sm">
                        Ver documento actual
                    </a>
                    <button type="button" wire:click="$dispatch('eliminar-documento')" wire:confirm="¿Estás seguro de que deseas eliminar este documento?" class="text-danger text-sm hover:underline">
                        Eliminar
                    </button>
                </div>
            @endif

            <!-- Vista previa de archivo -->
            @if ($form->documento)
                <p class="text-xs text-on-surface/70 mt-1">
                    Archivo seleccionado: {{ $form->documento->getClientOriginalName() }}
                </p>
            @endif
        </div>

        <button type="submit" class="whitespace-nowrap rounded-radius bg-primary border border-primary px-4 py-2 text-sm font-medium tracking-wide text-on-primary transition hover:opacity-75 text-center focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:bg-primary-dark dark:border-primary-dark dark:text-on-primary-dark dark:focus-visible:outline-primary-dark">
            <!--{{ request()->routeIs('servicios.create') ? 'Crear' : 'Actualizar' }}-->
            {{ $form->isEditing ? 'Actualizar' : 'Crear' }}
        </button>

        <a href="{{ route('servicios.index') }}" wire:navigate>
            <!-- danger Button -->
            <button type="button" class="whitespace-nowrap rounded-radius bg-danger border border-danger px-4 py-2 text-sm font-medium tracking-wide text-on-danger transition hover:opacity-75 text-center focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-danger active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:bg-danger dark:border-danger dark:text-onDanger dark:focus-visible:outline-danger">
                Cancelar
            </button>
        </a>  
    </form>

</div>
