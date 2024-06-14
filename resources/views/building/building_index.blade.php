<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full">
            <h2 class="text-alpha leading-tight capitalize font-semibold text-2xl">
                Create a build
            </h2>
        </div>
    </x-slot>
    <div class="flex flex-col items-center justify-center gap-3 py-4 ">
        <div class="w-full flex justify-end px-5">
            <a href='{{ route('building.create') }}' class="text-gray-100 no-underline text-md font-semibold bg-alpha py-2 px-4 rounded-lg shadow-md hover:shadow-lg hover:text-alpha hover:bg-gray-100 hover:border-2 hover:border-alpha transition duration-200 transform-gpu hover:scale-110 ">Create New Building</a>
        </div>
        <div class="w-[95%] flex flex-wrap gap-3">
            @foreach ($buildings as $building)
            <div class="w-1/3 p-4 h-[40vh] bg-white max-w-sm rounded-2xl overflow-hidden shadow-md hover:shadow-2xl hover:scale-105 transition duration-300">
                <div class="rounded-xl w-full h-[80%]">
                    <img class="rounded-xl w-full h-full" src="{{ asset('storage/images/' . $building->images->first()->path) }}" alt="" />
                </div>

                <div class="flex justify-between items-center pt-3">
                    <div>
                        <h1 class=" text-2xl font-semibold">{{ $building->name }}</h1>
                    </div>
                    <button>
                        <a href="{{ route('building.detail', $building) }}" class="text-gray-100 no-underline text-md font-semibold bg-alpha py-2 px-4 rounded-lg shadow-md hover:shadow-lg hover:text-alpha hover:bg-gray-100 hover:border-2 hover:border-alpha transition duration-200 transform-gpu hover:scale-110 ">View details</a>
                    </button>
                </div>
                <!-- <p class="">{{ $building->description }}</p> -->
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>