<x-app-layout>
    <x-slot name="header">
        <x-slot name="title">
            All buildings
        </x-slot>

        <a href='{{ route('building.create') }}'
            class="text-gray-50 no-underline text-md font-semibold border-2 border-alpha bg-alpha py-2 px-4 rounded-lg shadow-md hover:text-alpha hover:bg-gray-100">Create
            New Building
        </a>
    </x-slot>

    <div class="py-4 px-6">
        <div class="flex flex-wrap gap-[0.75rem]">
            @foreach ($buildings as $building)
                <x-card title="{{ $building->name->en }}" image="{{ $building->images?->first()?->path }}"
                    route="{{ route('building.edit', $building) }}" />
            @endforeach
        </div>
    </div>
</x-app-layout>
