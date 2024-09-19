<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full">
            <h2 class="text-alpha leading-tight capitalize font-semibold text-2xl">
                all circuits
            </h2>

            <a href='{{ route('circuit.create') }}'
                class="bg-alpha text-[#fff] no-underline px-[1.75rem] py-[0.5rem] rounded-xl font-medium border-2 border-alpha hover:bg-transparent hover:font-semibold hover:text-alpha transition-all duration-600">
                Create New Circuit
            </a>
        </div>
    </x-slot>

    <div class="py-4 px-6">
        <div class="flex flex-wrap gap-[0.75rem]">
            @foreach ($circuits as $circuit)
                <x-card title="{{ $circuit->name }}" image="{{ $circuit->images?->first()?->path }}"
                    route="{{ route('circuit.show', $circuit) }}" />
            @endforeach
        </div>
    </div>
</x-app-layout>
