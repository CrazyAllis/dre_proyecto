<div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

    <a href="{{ route('proveedores.create') }}" wire:navigate class="w-fit whitespace-nowrap rounded-radius bg-primary border border-primary px-4 py-2 text-center text-sm font-medium tracking-wide text-on-primary transition hover:opacity-75 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary active:opacity-100 active:outline-offset-0 disabled:cursor-not-allowed disabled:opacity-75 dark:border-primary-dark dark:bg-primary-dark dark:text-on-primary-dark dark:focus-visible:outline-primary-dark" role="button">
        Agregar Proveedor
    </a>

    <div class="overflow-hidden w-full overflow-x-auto rounded-radius border border-outline dark:border-outline-dark">
        <table class="w-full text-left text-sm text-on-surface dark:text-on-surface-dark">
            <thead class="border-b border-outline bg-surface-alt text-sm text-on-surface-strong dark:border-outline-dark dark:bg-surface-dark-alt dark:text-on-surface-dark-strong">
                <tr>
                    <th scope="col" class="p-4">ProveedorID</th>
                    <th scope="col" class="p-4">Nombre</th>
                    <th scope="col" class="p-4">RUC</th>
                    <th scope="col" class="p-4">Teléfono</th>
                    <th scope="col" class="p-4">Correo</th>
                    <th scope="col" class="p-4">Tipo de Servicio</th>
                    <th scope="col" class="p-4">Created At</th>
                    <th scope="col" class="p-4">Acciones</th>                
                </tr>
            </thead>
            <tbody class="divide-y divide-outline dark:divide-outline-dark">
                @forelse($proveedores as $proveedor)
                    <tr class="hover:bg-surface-alt dark:hover:bg-surface-dark-alt">
                        <td class="p-4">{{ $proveedor->id }}</td>
                        <td class="p-4">{{ $proveedor->nombre }}</td>
                        <td class="p-4">{{ $proveedor->ruc }}</td>
                        <td class="p-4">{{ $proveedor->telefono_contacto ?? 'N/A' }}</td>
                        <td class="p-4">{{ $proveedor->correo_contacto ?? 'N/A' }}</td>
                        <td class="p-4">{{ $proveedor->tipo_servicio ?? 'N/A' }}</td>
                        <td class="p-4">{{ $proveedor->created_at->format('d-m-Y H:i') }}</td>
                        <td class="p-4 flex items-center gap-2">
                        <a href="{{ route('proveedores.edit', $proveedor) }}" wire:navigate >
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
                            wire:click="delete({{ $proveedor }})"
                            wire:confirm="¿Estás seguro de que deseas eliminar este dato?" 
                            type="button" 
                            class="inline-flex justify-center items-center gap-2 whitespace-nowrap rounded-radius bg-danger border border-danger px-4 py-2 text-sm font-medium tracking-wide text-on-danger transition hover:opacity-75 text-center focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-danger active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:bg-danger dark:border-danger dark:text-onDanger dark:focus-visible:outline-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                            Eliminar
                        </button>
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
            {{ $proveedores->links() }} <!-- Pagination links -->
        </div>
    </div>
</div>
