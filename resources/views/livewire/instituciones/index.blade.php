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

    <a href="{{ route('instituciones.create') }}" wire:navigate class="w-fit whitespace-nowrap rounded-radius bg-primary border border-primary px-4 py-2 text-center text-sm font-medium tracking-wide text-on-primary transition hover:opacity-75 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary active:opacity-100 active:outline-offset-0 disabled:cursor-not-allowed disabled:opacity-75 dark:border-primary-dark dark:bg-primary-dark dark:text-on-primary-dark dark:focus-visible:outline-primary-dark" role="button">
        Agregar Institución
    </a>

    <div class="overflow-hidden w-full overflow-x-auto rounded-radius border border-outline dark:border-outline-dark" >
        <table class="w-full text-left text-sm text-on-surface dark:text-on-surface-dark">
            <thead class="border-b border-outline bg-surface-alt text-sm text-on-surface-strong dark:border-outline-dark dark:bg-surface-dark-alt dark:text-on-surface-dark-strong">
                <tr>
                    <th scope="col" class="p-4">InstitucionID</th>
                    <th scope="col" class="p-4">Codigo Modular</th>
                    <th scope="col" class="p-4">Nombre IE</th>
                    <th scope="col" class="p-4">Nivel</th>
                    <th scope="col" class="p-4">Distrito</th>
                    <th scope="col" class="p-4">Provincia</th>
                    <th scope="col" class="p-4">Dirección</th>
                    <th scope="col" class="p-4">Estado</th>
                    <th scope="col" class="p-4">Latitud</th>
                    <th scope="col" class="p-4">Longitud</th>
                    <th scope="col" class="p-4">Director</th>
                    <th scope="col" class="p-4">Created At</th>
                    <th scope="col" class="p-4">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline dark:divide-outline-dark">
                @forelse($instituciones as $institucion)
                <tr>
                    <td class="p-4">{{ $institucion->id }}</td>
                    <td class="p-4">{{ $institucion->codigo_modular }}</td>
                    <td class="p-4">{{ $institucion->nombre_ie }}</td>
                    <td class="p-4">{{ $institucion->nivel }}</td>
                    <td class="p-4">{{ $institucion->distrito }}</td>
                    <td class="p-4">{{ $institucion->provincia }}</td>
                    <td class="p-4">{{ $institucion->direccion }}</td>
                    <td class="p-4">{{ $institucion->estado_institucion }}</td>
                    <td class="p-4">{{ $institucion->latitud ?? 'N/A' }}</td>
                    <td class="p-4">{{ $institucion->longitud ?? 'N/A' }}</td>
                    <td class="p-4">{{ $institucion->director ? $institucion->director->nombres . ' ' . $institucion->director->apellidos : 'No asignado' }}</td>
                    <td class="p-4">{{ $institucion->created_at->format('d-m-Y H:i') }}</td>
                    <td class="p-4 flex items-center gap-2">
                        <a href="{{ route('instituciones.edit', $institucion) }}" wire:navigate >
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
                            wire:click="delete({{ $institucion }})"
                            wire:confirm="¿Estás seguro de que deseas eliminar este dato?" 
                            type="button" 
                            class="inline-flex justify-center items-center gap-2 whitespace-nowrap rounded-radius bg-danger border border-danger px-4 py-2 text-sm font-medium tracking-wide text-on-danger transition hover:opacity-75 text-center focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-danger active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:bg-danger dark:border-danger dark:text-onDanger dark:focus-visible:outline-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                            Eliminar
                        </button>

                        <!-- Botón Ver en Maps -->
                        <a href="https://www.google.com/maps/search/?api=1&query={{ $institucion->latitud }},{{ $institucion->longitud }}"
                        target="_blank" 
                        class="inline-flex items-center justify-center p-2 rounded-full bg-sky-500 text-white hover:bg-blue-600 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM6.262 6.072a8.25 8.25 0 1 0 10.562-.766 4.5 4.5 0 0 1-1.318 1.357L14.25 7.5l.165.33a.809.809 0 0 1-1.086 1.085l-.604-.302a1.125 1.125 0 0 0-1.298.21l-.132.131c-.439.44-.439 1.152 0 1.591l.296.296c.256.257.622.374.98.314l1.17-.195c.323-.054.654.036.905.245l1.33 1.108c.32.267.46.694.358 1.1a8.7 8.7 0 0 1-2.288 4.04l-.723.724a1.125 1.125 0 0 1-1.298.21l-.153-.076a1.125 1.125 0 0 1-.622-1.006v-1.089c0-.298-.119-.585-.33-.796l-1.347-1.347a1.125 1.125 0 0 1-.21-1.298L9.75 12l-1.64-1.64a6 6 0 0 1-1.676-3.257l-.172-1.03Z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <!-- <iframe
                            width="200"
                            height="150"
                            style="border:0"
                            loading="lazy"
                            allowfullscreen
                            referrerpolicy="no-referrer-when-downgrade"
                            src="https://www.google.com/maps?q={{ $institucion->latitud }},{{ $institucion->longitud }}&hl=es;z=16&output=embed">
                        </iframe> -->
                    </td> 
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
            {{ $instituciones->links() }} <!-- Pagination links -->
        </div>
    </div>
</div>
