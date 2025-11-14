<div class="flex flex-col gap-6 w-full">

    <!-- Mensaje de éxito -->
    @if (session('status'))
        <div class="rounded-radius border border-success bg-success/10 p-4 text-success">
            {{ session('status') }}
        </div>
    @endif

    <!-- Ficha de Registro -->
    <div class="rounded-radius border border-outline bg-surface-alt dark:bg-surface-dark-alt p-6">
        <h2 class="text-lg font-semibold mb-4">Ficha de Registro de Responsables</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 max-w-220">
            <div>
                <input wire:model.defer="form.nombres" type="text" placeholder="Nombres"
                    class="w-full rounded-radius border border-outline px-3 py-2 text-sm focus-visible:outline-primary" />
                @error('form.nombres') <p class="text-danger text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <input wire:model.defer="form.apellidos" type="text" placeholder="Apellidos"
                    class="w-full rounded-radius border border-outline px-3 py-2 text-sm focus-visible:outline-primary" />
                @error('form.apellidos') <p class="text-danger text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <input wire:model.defer="form.dni" type="text" placeholder="DNI"
                    class="w-full rounded-radius border border-outline px-3 py-2 text-sm focus-visible:outline-primary" />
                @error('form.dni') <p class="text-danger text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <input wire:model.defer="form.cargo" type="text" placeholder="Cargo"
                    class="w-full rounded-radius border border-outline px-3 py-2 text-sm focus-visible:outline-primary" />
            </div>

            <div>
                <input wire:model.defer="form.telefono" type="text" placeholder="Teléfono"
                    class="w-full rounded-radius border border-outline px-3 py-2 text-sm focus-visible:outline-primary" />
            </div>
        </div>

        <div class="mt-4 flex gap-2">
            <button wire:click="agregarDirector"
                class="rounded-radius bg-primary border border-primary px-4 py-2 text-sm font-medium text-on-primary hover:opacity-75">
                Agregar a la lista
            </button>
        </div>
    </div>

    <!-- Lista de Directores Temporales -->
    @if (count($directoresTemp) > 0)
        <div class="rounded-radius border border-outline bg-surface dark:bg-surface-dark-alt p-6">
            <h3 class="text-md font-semibold mb-3">Lista de Responsables ({{ count($directoresTemp) }})</h3>

            <div class="overflow-x-auto">
                <table class="w-full text-sm border-collapse">
                    <thead class="border-b border-outline">
                        <tr>
                            <th class="p-2 text-left">#</th>
                            <th class="p-2 text-left">Nombres</th>
                            <th class="p-2 text-left">Apellidos</th>
                            <th class="p-2 text-left">DNI</th>
                            <th class="p-2 text-left">Cargo</th>
                            <th class="p-2 text-left">Teléfono</th>
                            <th class="p-2 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($directoresTemp as $index => $dir)
                            <tr class="border-b border-outline/50 hover:bg-surface-alt">
                                <td class="p-2">{{ $index + 1 }}</td>
                                <td class="p-2">{{ $dir['nombres'] }}</td>
                                <td class="p-2">{{ $dir['apellidos'] }}</td>
                                <td class="p-2">{{ $dir['dni'] }}</td>
                                <td class="p-2">{{ $dir['cargo'] }}</td>
                                <td class="p-2">{{ $dir['telefono'] }}</td>
                                <td class="p-2 text-center">
                                    <button wire:click="eliminarDirector({{ $index }})"
                                        class="rounded-radius bg-danger border border-danger px-3 py-1 text-xs text-on-danger hover:opacity-80">
                                        Quitar
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4 flex justify-end">
                <button wire:click="guardarTodo"
                    class="rounded-radius bg-success border border-success px-5 py-2 text-sm text-on-success hover:opacity-80">
                    Guardar todos
                </button>
            </div>
        </div>
    @endif
</div>

