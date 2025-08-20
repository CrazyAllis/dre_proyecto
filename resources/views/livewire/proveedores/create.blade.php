<div>
    <form wire:submit='save' class="space-y-4 max-w-2xl p-4 bg-surface-alt dark:bg-surface-dark-alt rounded-lg shadow-md">
        <x-form.input wire:model='form.nombre' label="Nombre" name="form.nombre" placeholder="Ingrese nombre"/>
        <x-form.input wire:model='form.ruc' label="RUC" name="form.ruc" placeholder="Ingrese RUC"/>
        <x-form.input wire:model='form.telefono_contacto' label="Teléfono de Contacto" name="form.telefono_contacto" placeholder="999999999"/>
        <x-form.input wire:model='form.correo_contacto' label="Correo de Contacto" name="form.correo_contacto" placeholder="Ingrese correo"/>
        <x-form.input wire:model='form.tipo_servicio' label="Tipo de Servicio" name="form.tipo_servicio" placeholder="Ingrese tipo de servicio"/>

        <button type="submit" class="whitespace-nowrap rounded-radius bg-primary border border-primary px-4 py-2 text-sm font-medium tracking-wide text-on-primary transition hover:opacity-75 text-center focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:bg-primary-dark dark:border-primary-dark dark:text-on-primary-dark dark:focus-visible:outline-primary-dark">
            {{ request()->routeIs('proveedores.create') ? 'Crear' : 'Actualizar' }}
        </button>

        <a href="{{ route('proveedores.index') }}" wire:navigate>
            <!-- danger Button -->
            <button type="button" class="whitespace-nowrap rounded-radius bg-danger border border-danger px-4 py-2 text-sm font-medium tracking-wide text-on-danger transition hover:opacity-75 text-center focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-danger active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:bg-danger dark:border-danger dark:text-onDanger dark:focus-visible:outline-danger">
                Cancelar
            </button>
        </a>
    </form>
</div>
