<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full">
            <h2 class="text-alpha leading-tight capitalize font-semibold text-2xl">
                Create a build
            </h2>
        </div>
    </x-slot>
    <div class="flex justify-center py-4">
        <div class="w-[95%] flex flex-wrap gap-3">
            @foreach ($buildings as $building)
            <div class="w-1/3 p-4 bg-white max-w-sm rounded-2xl overflow-hidden shadow-md hover:shadow-2xl hover:scale-105 transition duration-300">

                @foreach ($building->images as $image)
                <img class="rounded-xl w-full h-[80%]" src="{{ asset('storage/images/' . $image->path) }}" alt="" />
                @endforeach

                <div class="flex justify-between items-center pt-3">
                    <div>
                        <h1 class=" text-2xl font-semibold">{{ $building->name }}</h1>
                    </div>
                    <button>
                        <a href="{{ route('building.detail', $building) }}" class="text-gray-100 no-underline text-md font-semibold bg-alpha py-2 px-4 rounded-lg shadow-md hover:shadow-lg hover:text-alpha hover:bg-gray-100 hover:border-2 hover:border-alpha transition duration-200 transform-gpu hover:scale-110 ">View</a>
                    </button>
                </div>
                <!-- <p class="">{{ $building->description }}</p> -->
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>