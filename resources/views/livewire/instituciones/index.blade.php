<div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
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
                    <td class="p-4">{{ $institucion->latitud }}</td>
                    <td class="p-4">{{ $institucion->longitud }}</td>
                    <td class="p-4">{{ $institucion->director ? $institucion->director->name : 'No asignado' }}</td>
                    <td class="p-4">{{ $institucion->created_at->format('d-m-Y H:i') }}</td>
                    <td class="p-4"></td> 
                @empty
                <tr>  
                    <td colspan="6" class="p-4 text-center text-sm text-on-surface-strong dark:text-on-surface-dark-strong">
                        {{ __('Instituciones no encontradas.') }}
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
