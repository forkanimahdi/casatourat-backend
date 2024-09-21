<x-app-layout>
    <x-slot name="header">
        <x-slot name="title">
            all circuits
        </x-slot>

        <a href='{{ route('circuit.create') }}'
            class="bg-alpha text-[#fff] no-underline px-[1.75rem] py-[0.5rem] rounded-xl font-medium border-2 border-alpha hover:bg-transparent hover:font-semibold hover:text-alpha transition-all duration-600">
            Create New Circuit
        </a>
    </x-slot>

    <div class="p-4 sm:p-6 lg:p-8">
        <div style="--gap: 0.75rem; --count: 4;" class="flex flex-wrap gap-[var(--gap)]">
            @foreach ($circuits as $circuit)
                <x-card title="{{ $circuit->name }}" image="{{ $circuit->images?->first()?->path }}"
                    route="{{ route('circuit.show', $circuit) }}" />
            @endforeach
        </div>
    </div>
</x-app-layout>
