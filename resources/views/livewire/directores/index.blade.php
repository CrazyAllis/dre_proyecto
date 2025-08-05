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

    <a href="{{ route('directores.create') }}" wire:navigate class="w-fit whitespace-nowrap rounded-radius bg-primary border border-primary px-4 py-2 text-center text-sm font-medium tracking-wide text-on-primary transition hover:opacity-75 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary active:opacity-100 active:outline-offset-0 disabled:cursor-not-allowed disabled:opacity-75 dark:border-primary-dark dark:bg-primary-dark dark:text-on-primary-dark dark:focus-visible:outline-primary-dark" role="button">
        Agregar Director
    </a>

    <div class="overflow-hidden w-full overflow-x-auto rounded-radius border border-outline dark:border-outline-dark">
        <table class="w-full text-left text-sm text-on-surface dark:text-on-surface-dark">
            <thead class="border-b border-outline bg-surface-alt text-sm text-on-surface-strong dark:border-outline-dark dark:bg-surface-dark-alt dark:text-on-surface-dark-strong">
                <tr>
                    <th scope="col" class="p-4">DirectorID</th>
                    <th scope="col" class="p-4">Nombres</th>
                    <th scope="col" class="p-4">Apellidos</th>
                    <th scope="col" class="p-4">DNI</th>
                    <th scope="col" class="p-4">Cargo</th>
                    <th scope="col" class="p-4">Teléfono</th>
                    <th scope="col" class="p-4">Created At</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline dark:divide-outline-dark">
                @forelse($directores as $director)
                <tr class="hover:bg-surface-alt dark:hover:bg-surface-dark-alt">
                    <td class="p-4">{{ $director->id }}</td>
                    <td class="p-4">{{ $director->nombres }}</td>
                    <td class="p-4">{{ $director->apellidos }}</td>
                    <td class="p-4">{{ $director->dni }}</td>
                    <td class="p-4">{{ $director->cargo ?? 'N/A' }}</td>
                    <td class="p-4">{{ $director->telefono ?? 'N/A' }}</td>
                    <td class="p-4">{{ $director->created_at->format('d-m-Y H:i') }}</td>
                @empty
                <tr>
                    <td colspan="6" class="p-4 text-center text-sm text-on-surface-strong dark:text-on-surface-dark-strong">
                        {{ __('No directors found.') }}
                    </td>
                </tr>
                @endforelse 
            </tbody>
        </table>
        <div class="p-4">
            {{ $directores->links() }} <!-- Pagination links -->
        </div>
    </div>
</div>


