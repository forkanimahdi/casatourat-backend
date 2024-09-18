<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full">
            <h2 class="text-alpha leading-tight capitalize font-semibold text-2xl">
                create circuit
            </h2>
        </div>
    </x-slot>

    <div id="map" class="h-[85vh] relative"></div>
    <form id="myForm" enctype="multipart/form-data"
        class=" bg-white w-fit absolute top-[25%] left-[18%] px-3 py-4 rounded-xl flex flex-col gap-3 shadow-md">
        @csrf
        <div class="flex flex-col gap-1">
            <label class="text-gray-400 ps-1" for="">Name:</label>
            <input class="rounded-xl border-gray-300 bg-gray-50" required type="text" placeholder="Name"
                id="name" name="name">
        </div>
        <div class="flex flex-col gap-1">
            <label class="text-gray-400 ps-1" for="">Alternative:</label>
            <input class="rounded-xl border-gray-300 bg-gray-50" required type="text" placeholder="Alternative"
                id="alternative" name="alternative">
        </div>
        <div class="flex flex-col gap-1">
            <label class="text-gray-400 ps-1" for="">Description:</label>
            <input class="rounded-xl border-gray-300 bg-gray-50" required type="text" placeholder="Description"
                id="description" name="description">
        </div>

        <div class="flex flex-col gap-1">
            <label for="image" class="block text-gray-700">Add Images:</label>
            <input type="file" name="image[]" id="image" accept="image/png, image/jpeg" class="mt-2 border-2 rounded w-full" required multiple>
        </div>

        <div class="flex flex-col gap-1">
            <label class="block text-gray-700" for="audio">Audio:</label>
            <input
                class="mt-2 border-2 rounded w-full"
                required type="file" placeholder="Audio" id="audio" name="audio" accept="audio/*" >
        </div>
        <div class="flex justify-center mt-4">
            <button class="bg-alpha text-white px-4 py-1 rounded-xl font-thin w-fit shadow-lg">submit</button>
        </div>
    </form>
    @vite(['resources/js/create_circuit_map.js'])
</x-app-layout>
