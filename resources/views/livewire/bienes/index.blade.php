<div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

    @if (session('status'))
        <!-- success Alert -->
        <div x-data="{ alertIsVisible: true }" x-show="alertIsVisible" class="relative w-full overflow-hidden rounded-radius border border-success bg-surface text-on-surface dark:bg-surface-dark dark:text-on-surface-dark" role="alert" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">
            <div class="flex w-full items-center gap-2 bg-success/10 p-4">
                <div class="bg-success/15 text-success rounded-full p-1" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-6" aria-hidden="true">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-2">
                    <h3 class="text-sm font-semibold text-success">Mensaje</h3>
                    <p class="text-xs font-medium sm:text-sm">{{ session('status') }}</p>
                </div>
                <button type="button" @click="alertIsVisible = false" class="ml-auto" aria-label="dismiss alert">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" stroke="currentColor" fill="none" stroke-width="2.5" class="w-4 h-4 shrink-0">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    @endif

    <a href="{{ route('bienes.create') }}" wire:navigate class="w-fit whitespace-nowrap rounded-radius bg-primary border border-primary px-4 py-2 text-center text-sm font-medium tracking-wide text-on-primary transition hover:opacity-75 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary active:opacity-100 active:outline-offset-0 disabled:cursor-not-allowed disabled:opacity-75 dark:border-primary-dark dark:bg-primary-dark dark:text-on-primary-dark dark:focus-visible:outline-primary-dark" role="button">
        Agregar Bien
    </a>

    <div class="flex items-center gap-2">
        <div class="relative flex w-full max-w-xs flex-col gap-1 text-on-surface dark:text-on-surface-dark">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true" class="absolute left-2.5 top-1/2 size-5 -translate-y-1/2 text-on-surface/50 dark:text-on-surface-dark/50"> 
                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
            <input wire:model.live.debounce.300ms="search" 
            type="search" class="w-full rounded-radius border border-outline bg-surface-alt py-2 pl-10 pr-2 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary disabled:cursor-not-allowed disabled:opacity-75 dark:border-outline-dark dark:bg-surface-dark-alt/50 dark:focus-visible:outline-primary-dark" 
            name="search" 
            placeholder="Codigo Patrimonial, Tipo de bien" 
            aria-label="search"/>
        </div>

        <!-- Filtro por Institución -->
        <select
            wire:model.live.debounce.300ms="institucionSeleccionada"
            class="rounded-radius border border-outline px-3 py-2 text-sm bg-surface-alt focus:outline-none focus:ring-2 focus:ring-primary dark:bg-surface-dark-alt"
        >
            <option value="">Todas las instituciones</option>
            @foreach ($instituciones as $institucion)
                <option value="{{ $institucion->id }}">{{ $institucion->nombre_ie }}</option>
            @endforeach
        </select>

        <!-- Filtro por estado -->
        <select
            wire:model.live.debounce.300ms="estadoSeleccionado"
            class="rounded-radius border border-outline px-3 py-2 text-sm bg-surface-alt focus:outline-none focus:ring-2 focus:ring-primary dark:bg-surface-dark-alt"
        >
            <option value="">Todos los estados</option>
            <option value="Activo">Activo</option>
            <option value="Inactivo">Inactivo</option>
            <option value="En Mantenimiento">En Mantenimiento</option>
        </select>
    </div>

    <div class="overflow-hidden w-full overflow-x-auto rounded-radius border border-outline dark:border-outline-dark">
        <table class="w-full text-left text-sm text-on-surface dark:text-on-surface-dark">
            <thead class="border-b border-outline bg-surface-alt text-sm text-on-surface-strong dark:border-outline-dark dark:bg-surface-dark-alt dark:text-on-surface-dark-strong">
                <tr>
                    <th scope="col" class="p-4">BienID</th>
                    <th scope="col" class="p-4">Institución</th>
                    <th scope="col" class="p-4">Codigo Patrimonial</th>
                    <th scope="col" class="p-4">Tipo de bien</th>
                    <th scope="col" class="p-4">Marca</th>
                    <th scope="col" class="p-4">Modelo</th>
                    <th scope="col" class="p-4">Número de serie</th>
                    <th scope="col" class="p-4">Descripción</th>
                    <th scope="col" class="p-4">Oficina/Area</th>
                    <th scope="col" class="p-4">Estado</th>
                    <th scope="col" class="p-4">Fecha de adquisición</th>
                    <th scope="col" class="p-4">Observaciones</th>
                    <th scope="col" class="p-4">Created At</th>
                    <th scope="col" class="p-4">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline dark:divide-outline-dark">
                @forelse($bienes as $bien)
                    <tr class="hover:bg-surface-alt dark:hover:bg-surface-dark-alt">
                        <td class="p-4">{{ $bien->id }}</td>
                        <td class="p-4">{{ $bien->institucion ? $bien->institucion->nombre_ie : 'No asignado' }}</td>
                        <td class="p-4">{{ $bien->codigo_patrimonial }}</td>
                        <td class="p-4">{{ $bien->tipo_bien }}</td>
                        <td class="p-4">{{ $bien->marca }}</td>
                        <td class="p-4">{{ $bien->modelo }}</td>
                        <td class="p-4">{{ $bien->nro_serie }}</td>
                        <td class="p-4">{{ $bien->descripcion }}</td>
                        <td class="p-4">{{ $bien->oficina_ubicacion }}</td>
                        <td class="p-4">{{ $bien->estado }}</td>
                        <td class="p-4">{{ $bien->fecha_adquisicion?->format('d-m-Y') ?? 'Sin fecha registrada' }}</td>
                        <td class="p-4">{{ $bien->observaciones }}</td>
                        <td class="p-4">{{ $bien->created_at->format('d-m-Y H:i') }}</td>
                        <td class="p-4 flex items-center gap-2">
                            <a href="{{ route('bienes.edit', $bien) }}" wire:navigate >
                                <!-- success Button with Icon -->
                                <button type="button" class="inline-flex justify-center items-center gap-2 whitespace-nowrap rounded-radius bg-success border border-success dark:border-success px-4 py-2 text-sm font-medium tracking-wide text-on-success transition hover:opacity-75 text-center focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-success active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:bg-success dark:text-on-success dark:focus-visible:outline-success">
                                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="size-5 fill-on-success dark:fill-on-success" fill="currentColor">
                                        <path fill-rule="evenodd" d="M12 3.75a.75.75 0 01.75.75v6.75h6.75a.75.75 0 010 1.5h-6.75v6.75a.75.75 0 01-1.5 0v-6.75H4.5a.75.75 0 010-1.5h6.75V4.5a.75.75 0 01.75-.75z" clip-rule="evenodd" />
                                        </svg>
                                        Editar
                                </button>
                            </a>
                            <!-- danger Button -->
                            <button 
                                wire:click="delete({{ $bien }})"
                                wire:confirm="¿Estás seguro de que deseas eliminar este dato?" 
                                type="button" 
                                class="inline-flex justify-center items-center gap-2 whitespace-nowrap rounded-radius bg-danger border border-danger px-4 py-2 text-sm font-medium tracking-wide text-on-danger transition hover:opacity-75 text-center focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-danger active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:bg-danger dark:border-danger dark:text-onDanger dark:focus-visible:outline-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                </svg>
                                Eliminar
                            </button>

                            <!-- Botón dentro de ver -->
                            <button wire:click="verBien({{ $bien->id }})"
                                type="button"
                                class="inline-flex items-center bg-transparent rounded-radius px-4 py-2 text-sm font-medium tracking-wide text-info transition hover:opacity-75 text-center focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-info active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:text-info dark:focus-visible:outline-info">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                    <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                    <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>  
                        <td colspan="6" class="p-4 text-center text-sm text-on-surface-strong dark:text-on-surface-dark-strong">
                            {{ __('No existen datos.') }}
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4">
            {{ $bienes->links() }} <!-- Pagination links -->
        </div>
    </div> 
    
<!-- Modal para ver detalles del servicio -->
<div x-data="{ modalIsOpen: @entangle('modalIsOpen') }">
    <div 
    x-cloak 
    x-show="modalIsOpen" 
    x-transition.opacity.duration.200ms
    x-trap.inert.noscroll="modalIsOpen" 
    x-on:keydown.esc.window="modalIsOpen = false"
    x-on:click.self="modalIsOpen = false"
    class="fixed inset-0 z-30 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8"
    role="dialog" 
    aria-modal="true"
    style="display: none;">
    
    <div 
        x-show="modalIsOpen"
        x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
        x-transition:enter-start="opacity-0 scale-50"
        x-transition:enter-end="opacity-100 scale-100"
        class="flex max-w-lg w-full flex-col gap-4 overflow-hidden rounded-radius border border-outline bg-surface text-on-surface dark:border-outline-dark dark:bg-surface-dark-alt dark:text-on-surface-dark">

        <!-- Header -->
        <div class="flex items-center justify-between border-b border-outline bg-surface-alt/60 p-4 dark:border-outline-dark dark:bg-surface-dark/20">
            <h3 class="font-semibold tracking-wide text-on-surface-strong dark:text-on-surface-dark-strong">
                Detalle del Servicio
            </h3>
            <button wire:click="$set('modalIsOpen', false)" aria-label="close modal">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" stroke="currentColor" fill="none" stroke-width="1.4" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Body -->
        <div class="px-4 py-6 space-y-2">
            @if($bienSeleccionado)
                <p><strong>BienID:</strong> {{ $bienSeleccionado->id }}</p>
                <p><strong>Institución:</strong> {{ $bienSeleccionado->institucion ? $bienSeleccionado->institucion->nombre_ie : 'No asignado' }}</p>
                <p><strong>Código Patrimonial:</strong> {{ $bienSeleccionado->codigo_patrimonial }}</p>
                <p><strong>Tipo de bien:</strong> {{ $bienSeleccionado->tipo_bien }}</p>
                <p><strong>Marca:</strong> {{ $bienSeleccionado->marca }}</p>
                <p><strong>Modelo:</strong> {{ $bienSeleccionado->modelo }}</p>
                <p><strong>Número de serie:</strong> {{ $bienSeleccionado->nro_serie }}</p>
                <p><strong>Descripción:</strong> {{ $bienSeleccionado->descripcion }}</p>
                <p><strong>Oficina/Área:</strong> {{ $bienSeleccionado->oficina_ubicacion }}</p>
                <p><strong>Estado:</strong> {{ $bienSeleccionado->estado }}</p>
                <p><strong>Fecha de adquisición:</strong> {{ $bienSeleccionado->fecha_adquisicion?->format('d-m-Y') ?? 'Sin fecha registrada' }}</p>
                <p><strong>Observaciones:</strong> {{ $bienSeleccionado->observaciones ?? '-' }}</p>
                <p><strong>Fecha de Creación:</strong> {{ $bienSeleccionado->created_at->format('d-m-Y H:i') }}</p>
                <p><strong>Última Actualización:</strong> {{ $bienSeleccionado->updated_at->format('d-m-Y H:i') }}</p>
            @endif
        </div>

        <!-- Footer -->
        <div class="flex justify-end gap-2 border-t border-outline bg-surface-alt/60 p-4 dark:border-outline-dark dark:bg-surface-dark/20">
            @if($bienSeleccionado)
                <a href="{{ route('bienes.edit', $bienSeleccionado->id) }}" wire:navigate
                class="rounded-radius bg-success border border-success px-4 py-2 text-sm font-medium text-on-success hover:opacity-80 dark:bg-success dark:border-success dark:text-on-success">
                Editar
                </a>
            @endif
            <button wire:click="$set('modalIsOpen', false)" type="button"
                class="whitespace-nowrap rounded-radius bg-danger border border-danger px-4 py-2 text-sm font-medium tracking-wide text-on-danger transition hover:opacity-75 text-center focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-danger active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:bg-danger dark:border-danger dark:text-onDanger dark:focus-visible:outline-danger">
                Cerrar
            </button>
        </div>
    </div>
    </div>
</div>
    
</div>
