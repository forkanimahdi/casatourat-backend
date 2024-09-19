<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full">
            <h2 class="text-alpha leading-tight  font-semibold text-2xl">
                All buildings
            </h2>
        </div>
    </x-slot>
    <div class="flex flex-col items-center justify-center gap-3 py-4 ">
        <div class="w-full flex justify-end px-5">
            <a href='{{ route('building.create') }}'
                class="text-gray-50 no-underline text-md font-semibold border-2 border-alpha bg-alpha py-2 px-4 rounded-lg shadow-md hover:text-alpha hover:bg-gray-100">Create
                New Building</a>
        </div>
        <div class="w-[95%] flex flex-wrap gap-3">
            @foreach ($buildings as $building)
                <div
                    class="w-1/3 aspect-square p-3 bg-white max-w-sm rounded-lg overflow-hidden border ">
                    <img class="rounded-sm w-full h-[80%] object-cover"
                        src="{{ asset('storage/images/' . $building->images?->first()?->path) }}"
                        alt="No Image For This Building" />

                    <div class="flex justify-between pt-3 ">
                        <h1 class="text-xl w-[70%]">
                            {{ Str::limit($building->name, 55, '...') }}
                        </h1>
                        <a class="w-30%" href="{{ route('building.edit', $building) }}">
                            <button
                                class="text-gray-50 no-underline text-sm font-semibold bg-alpha p-2 rounded-sm hover:text-alpha hover:bg-gray-100 border-2 border-alpha">View
                                details
                            </button>
                        </a>
                    </div>
                    <!-- <p class="">{{ $building->description }}</p> -->
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
