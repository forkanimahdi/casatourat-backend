<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full">
            <h2 class="text-alpha leading-tight capitalize font-semibold text-2xl">
                all circuits
            </h2>

            <a href='{{ route('circuit.create') }}'
                class="bg-alpha text-[#fff] no-underline px-[1.75rem] py-[0.5rem] rounded-xl font-medium border-2 border-alpha hover:bg-transparent hover:font-semibold hover:text-alpha transition-all duration-600">
                {{-- class="text-gray-100 no-underline text-md font-semibold bg-alpha py-2 px-4 rounded-lg shadow-md hover:shadow-lg hover:text-alpha hover:bg-gray-100 hover:border-2 hover:border-alpha transition duration-200 transform-gpu hover:scale-110 "> --}}
                Create New Circuit
            </a>
        </div>
    </x-slot>

    <div class="flex flex-col items-center justify-center gap-3 py-4 ">
        <div class="w-[95%] flex flex-wrap gap-3">
            @foreach ($circuits as $circuit)
                <x-card title="{{ $circuit->name }}" image="{{ $circuit->images?->first()?->path }}"
                    route="{{ route('circuit.show', $circuit) }}" />
            @endforeach
        </div>
    </div>
</x-app-layout>
