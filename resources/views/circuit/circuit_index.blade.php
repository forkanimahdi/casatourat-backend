<x-app-layout>
    <x-slot name="header">
        <x-slot name="title">
            all circuits
        </x-slot>

        <a href='{{ route('circuits.create') }}'
            class="bg-alpha text-[#fff] no-underline px-[1.75rem] py-[0.5rem] rounded-xl font-medium border-2 border-alpha hover:bg-transparent hover:font-semibold hover:text-alpha transition-all duration-600">
            Create New Circuit
        </a>
    </x-slot>

    <div class="p-4 sm:p-6 lg:p-8">
        <div style="--gap: 0.75rem; --count: 4;" class="flex flex-wrap gap-[var(--gap)]">
            @foreach ($circuits as $circuit)
                <x-card title="{{ $circuit->name->en }}" image="{{ $circuit->images?->first()?->path }}"
                    route="{{ route('circuits.show', $circuit) }}">
                    <x-slot name="placeholder">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-10">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 6.75V15m6-6v8.25m.503 3.498 4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 0 0-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0Z" />
                        </svg>
                    </x-slot>
                </x-card>
            @endforeach
        </div>
    </div>
</x-app-layout>
