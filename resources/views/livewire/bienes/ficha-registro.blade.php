<div class="flex flex-col gap-6 w-full">

    <!-- Mensaje de éxito -->
    @if (session('status'))
        <div class="rounded-radius border border-success bg-success/10 p-4 text-success">
            {{ session('status') }}
        </div>
    @endif

    <!-- Ficha de Registro -->
    <div class="rounded-radius border border-outline bg-surface-alt dark:bg-surface-dark-alt p-6">
        <h2 class="text-lg font-semibold mb-4">Ficha de Registro de Bienes</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="relative flex w-full max-w-xs flex-col gap-1 text-on-surface dark:text-on-surface-dark">
                <label for="institucion_id" class="w-fit pl-0.5 text-sm">Institución</label>
                <select wire:model.defer="form.institucion_id" 
                    wire:change="institucionChanged($event.target.value)"
                    class="w-full rounded-radius border border-outline px-3 py-2 text-sm focus-visible:outline-primary">
                    <option value="">Seleccione Institución</option>
                    @foreach ($instituciones as $institucion)
                        <option value="{{ $institucion->id }}">{{ $institucion->nombre_ie }}</option>
                    @endforeach
                </select>
                @error('form.institucion_id') <p class="text-danger text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="relative flex w-full max-w-xs flex-col gap-1 text-on-surface dark:text-on-surface-dark">
                <label for="codigo_patrimonial" class="w-fit pl-0.5 text-sm">Código patrimonial</label>
                <input wire:model.defer="form.codigo_patrimonial" type="text" placeholder="Código Patrimonial"
                    class="w-full rounded-radius border border-outline px-3 py-2 text-sm focus-visible:outline-primary" />
                @error('form.codigo_patrimonial') <p class="text-danger text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            @if ($this->esDre)
                <div class="relative flex w-full max-w-xs flex-col gap-1 text-on-surface dark:text-on-surface-dark">
                    <label for="dre_id" class="w-fit pl-0.5 text-sm">Oficina: Responsable</label>
                    <select wire:model.defer="form.dre_id"
                        class="w-full rounded-radius border border-outline px-3 py-2 text-sm focus-visible:outline-primary">
                        <option value="">Seleccione</option>
                        @foreach ($dres as $dre)
                            <option value="{{ $dre->id }}">{{ $dre->oficina }}: {{ $dre->responsable }}</option>
                        @endforeach
                    </select>
                    @error('form.dre_id') <p class="text-danger text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            @endif

            <div class="relative flex w-full max-w-xs flex-col gap-1 text-on-surface dark:text-on-surface-dark">
                <label for="detalle_id" class="w-fit pl-0.5 text-sm">Tipo de Bien</label>
                <select wire:model.defer="form.detalle_id" 
                    wire:change="detalleChanged($event.target.value)"
                    class="w-full rounded-radius border border-outline px-3 py-2 text-sm focus-visible:outline-primary">
                    <option value="">Seleccione</option>
                    @foreach ($detalles as $detalle)
                        <option value="{{ $detalle->id }}">{{ $detalle->tipo_componente }}</option>
                    @endforeach
                </select>
                @error('form.detalle_id') <p class="text-danger text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="relative flex w-full max-w-xs flex-col gap-1 text-on-surface dark:text-on-surface-dark">
                <label for="marca" class="w-fit pl-0.5 text-sm">Marca</label>
                <input wire:model.defer="form.marca" type="text" placeholder="ej. HP, Dell, Lenovo..."
                    class="w-full rounded-radius border border-outline px-3 py-2 text-sm focus-visible:outline-primary" />
                @error('form.marca') <p class="text-danger text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="relative flex w-full max-w-xs flex-col gap-1 text-on-surface dark:text-on-surface-dark">
                <label for="modelo" class="w-fit pl-0.5 text-sm">Modelo</label>
                <input wire:model.defer="form.modelo" type="text" placeholder="Modelo"
                    class="w-full rounded-radius border border-outline px-3 py-2 text-sm focus-visible:outline-primary" />
                @error('form.modelo') <p class="text-danger text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="relative flex w-full max-w-xs flex-col gap-1 text-on-surface dark:text-on-surface-dark">
                <label for="nro_serie" class="w-fit pl-0.5 text-sm">Número de serie</label>
                <input wire:model.defer="form.nro_serie" type="text" placeholder="Número de Serie"
                    class="w-full rounded-radius border border-outline px-3 py-2 text-sm focus-visible:outline-primary" />
                @error('form.nro_serie') <p class="text-danger text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            @if ($this->mostrarSpecs)
                <div class="relative flex w-full max-w-xs flex-col gap-1 text-on-surface dark:text-on-surface-dark">
                <label for="procesador" class="w-fit pl-0.5 text-sm">Procesador</label>
                    <input wire:model.defer="form.procesador" type="text" placeholder="ej. Intel Core i7"
                        class="w-full rounded-radius border border-outline px-3 py-2 text-sm focus-visible:outline-primary" />
                    @error('form.procesador') <p class="text-danger text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="relative flex w-full max-w-xs flex-col gap-1 text-on-surface dark:text-on-surface-dark">
                    <label for="ram" class="w-fit pl-0.5 text-sm">RAM</label>
                    <input wire:model.defer="form.ram" type="text" placeholder="ej. 8 GB"
                        class="w-full rounded-radius border border-outline px-3 py-2 text-sm focus-visible:outline-primary" />
                    @error('form.ram') <p class="text-danger text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="relative flex w-full max-w-xs flex-col gap-1 text-on-surface dark:text-on-surface-dark">
                    <label for="tipo_almacenamiento" class="w-fit pl-0.5 text-sm">Tipo de Almacenamiento</label>
                    <select
                        wire:model.defer="form.tipo_almacenamiento"
                        class="w-full rounded-radius border border-outline px-3 py-2 text-sm focus-visible:outline-primary"
                    >
                        <option value="">Seleccione</option>

                        @foreach ($almacenamientoBienes as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>

                    @error('form.tipo_almacenamiento')
                        <p class="text-danger text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="relative flex w-full max-w-xs flex-col gap-1 text-on-surface dark:text-on-surface-dark">
                    <label for="capacidad_almacenamiento" class="w-fit pl-0.5 text-sm">Capacidad de Almacenamiento</label>
                    <input wire:model.defer="form.capacidad_almacenamiento" type="text" placeholder="ej. 1 TB, 980 GB..."
                        class="w-full rounded-radius border border-outline px-3 py-2 text-sm focus-visible:outline-primary" />
                    @error('form.capacidad_almacenamiento') <p class="text-danger text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            @endif

            <div class="relative flex w-full max-w-xs flex-col gap-1 text-on-surface dark:text-on-surface-dark">
                <label for="descripcion" class="w-fit pl-0.5 text-sm">Descripción</label>
                <textarea
                    wire:model.defer="form.descripcion"
                    placeholder="Descripción"
                    class="w-full rounded-radius border border-outline px-3 py-2 text-sm focus-visible:outline-primary"
                    rows="3"
                ></textarea>

                @error('form.descripcion')
                    <p class="text-danger text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            @if (! $this->esDre)
                <div class="relative flex w-full max-w-xs flex-col gap-1 text-on-surface dark:text-on-surface-dark">
                    <label for="oficina_ubicacion" class="w-fit pl-0.5 text-sm">Oficina/Área</label>
                    <input wire:model.defer="form.oficina_ubicacion" type="text" placeholder="Oficina/Área"
                        class="w-full rounded-radius border border-outline px-3 py-2 text-sm focus-visible:outline-primary" />
                    @error('form.oficina_ubicacion') <p class="text-danger text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            @endif

            <div class="relative flex w-full max-w-xs flex-col gap-1 text-on-surface dark:text-on-surface-dark">
                <label for="estado" class="w-fit pl-0.5 text-sm">Estado</label>
                <select
                    wire:model.defer="form.estado"
                    class="w-full rounded-radius border border-outline px-3 py-2 text-sm focus-visible:outline-primary"
                >
                    <option value="">Seleccione</option>

                    @foreach ($estadosBienes as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>

                @error('form.estado')
                    <p class="text-danger text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="relative flex w-full max-w-xs flex-col gap-1 text-on-surface dark:text-on-surface-dark">
                <label for="fecha_adquisicion" class="w-fit pl-0.5 text-sm">Fecha de adquisición</label>
                <input wire:model.defer="form.fecha_adquisicion" type="date" placeholder="Fecha de Adquisición"
                    class="w-full rounded-radius border border-outline px-3 py-2 text-sm focus-visible:outline-primary" />
                @error('form.fecha_adquisicion') <p class="text-danger text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="relative flex w-full max-w-xs flex-col gap-1 text-on-surface dark:text-on-surface-dark">
                <label for="observaciones" class="w-fit pl-0.5 text-sm">Observaciones</label>
                <textarea
                    wire:model.defer="form.observaciones"
                    placeholder="Observaciones"
                    class="w-full rounded-radius border border-outline px-3 py-2 text-sm focus-visible:outline-primary"
                    rows="3"
                ></textarea>

                @error('form.observaciones')
                    <p class="text-danger text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mt-4 flex gap-2">
            <button wire:click="agregarBien"
                class="rounded-radius bg-primary border border-primary px-4 py-2 text-sm font-medium text-on-primary hover:opacity-75">
                Agregar a la lista
            </button>
        </div>
    </div>

    <!-- Lista de Bienes Temporales -->
    @if (count($bienesTemp) > 0)
        <div class="rounded-radius border border-outline bg-surface dark:bg-surface-dark-alt p-6">
            <h3 class="text-md font-semibold mb-3">Lista de Bienes ({{ count($bienesTemp) }})</h3>

            <div class="overflow-x-auto">
                <table class="w-full text-sm border-collapse">
                    <thead class="border-b border-outline">
                        <tr>
                            <th class="p-2 text-left">#</th>
                            <th class="p-2 text-left">Institución</th>
                            <th class="p-2 text-left">Código Patrimonial</th>
                            <th class="p-2 text-left">Oficina: Responsable</th>
                            <th class="p-2 text-left">Tipo de componente</th>
                            <th class="p-2 text-left">Marca</th>
                            <th class="p-2 text-left">Modelo</th>
                            <th class="p-2 text-left">Número de Serie</th>
                            <th class="p-2 text-left">Procesador</th>
                            <th class="p-2 text-left">RAM</th>
                            <th class="p-2 text-left">Tipo de almacenamiento</th>
                            <th class="p-2 text-left">Capacidad de almacenamiento</th>
                            <th class="p-2 text-left">Descripción</th>
                            <th class="p-2 text-left">Oficina/Área</th>
                            <th class="p-2 text-left">Estado</th>
                            <th class="p-2 text-left">Fecha de adquisición</th>
                            <th class="p-2 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bienesTemp as $index => $bien)
                            <tr class="border-b border-outline/50 hover:bg-surface-alt">
                                <td class="p-2">{{ $index + 1 }}</td>
                                <!--<td class="p-2">{{ $bien['institucion_id'] }}</td>-->
                                <td class="p-2">
                                    {{ $instituciones->firstWhere('id', $bien['institucion_id'])->nombre_ie ?? '—' }}
                                </td>
                                <td class="p-2">{{ $bien['codigo_patrimonial'] }}</td>
                                <td class="p-2">
                                    {{ $dres->firstWhere('id', $bien['dre_id'])->oficina . ': ' . optional($dres->firstWhere('id', $bien['dre_id']))->responsable ?? '—' }}
                                </td>
                                <td class="p-2">
                                    {{ $detalles->firstWhere('id', $bien['detalle_id'])->tipo_componente ?? '—' }}
                                </td>
                                <td class="p-2">{{ $bien['marca'] }}</td>
                                <td class="p-2">{{ $bien['modelo'] }}</td>
                                <td class="p-2">{{ $bien['nro_serie'] }}</td>
                                <td class="p-2">{{ $bien['procesador'] }}</td>
                                <td class="p-2">{{ $bien['ram'] }}</td>
                                <td class="p-2">{{ $bien['tipo_almacenamiento'] }}</td>
                                <td class="p-2">{{ $bien['capacidad_almacenamiento'] }}</td>
                                <td class="p-2">{{ $bien['descripcion'] }}</td>
                                <td class="p-2">{{ $bien['oficina_ubicacion'] }}</td>
                                <td class="p-2">{{ $bien['estado'] }}</td>
                                <td class="p-2">{{ $bien['fecha_adquisicion'] }}</td>
                                <td class="p-2 text-center">
                                    <button wire:click="eliminarBien({{ $index }})"
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