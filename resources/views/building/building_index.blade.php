<x-app-layout>
    <x-slot name="header">
        <x-slot name="title">
            All buildings
        </x-slot>

        <a href='{{ route('buildings.create') }}'
            class="text-gray-50 no-underline text-md font-semibold border-2 border-alpha bg-alpha py-2 px-4 rounded-lg shadow-md hover:text-alpha hover:bg-gray-100">Create
            New Building
        </a>
    </x-slot>

    <div class="p-4 sm:p-6 lg:p-8  w-full">
        <div style="--gap: 0.75rem; --count: 4;" class="flex sm:flex-wrap sm:flex-row flex-col  gap-[var(--gap)] ">
            @foreach ($buildings as $building)
                <x-card title="{{ $building->name->en }}" image="{{ $building->images?->first()?->path }}"
                    route="{{ route('buildings.edit', $building) }}">
                    <x-slot name="placeholder">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-10">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z" />
                        </svg>
                    </x-slot>
                </x-card>
            @endforeach
        </div>
    </div>
</x-app-layout>
