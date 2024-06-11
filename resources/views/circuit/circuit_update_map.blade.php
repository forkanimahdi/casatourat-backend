<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center w-full">
            <h5 class="text-alpha leading-tight capitalize font-semibold ">
                update <span class="font-medium text-2xl">{{ $circuit->name }}</span> circuit
            </h5>
        </div>
    </x-slot>

    <div id="map" class="w-full h-[85vh] relative"></div>

    <form id="myForm" enctype="multipart/form-data "
        class=" bg-white w-fit absolute top-[25%] left-[18%] px-3 py-4 rounded-xl flex flex-col gap-3 shadow-md">
        @csrf
        <div class="flex flex-col gap-1">
            <label class="text-gray-400 ps-1" for="">Name:</label>
            <input value="{{ $circuit->name }}" class="rounded-xl border-gray-300 bg-gray-50" required type="text"
                placeholder="Name" id="name" name="name">
        </div>
        <div class="flex flex-col gap-1">
            <label class="text-gray-400 ps-1" for="">Alternative:</label>
            <input value="{{ $circuit->alternative }}" class="rounded-xl border-gray-300 bg-gray-50" required
                type="text" placeholder="Alternative" id="alternative" name="alternative">
        </div>
        <div class="flex flex-col gap-1">
            <label class="text-gray-400 ps-1" for="">Description:</label>
            <input value="{{ $circuit->description }}" class="rounded-xl border-gray-300 bg-gray-50" required
                type="text" placeholder="Description" id="description" name="description">
        </div>
        <div class="flex flex-col gap-1">
            <label class="text-gray-400 ps-1" for="">Audio:</label>
            <input
                class="rounded-xl border text-gray-400 px-2 py-2 border-gray-300 bg-gray-50 file:border-0 file:bg-transparent file:text-alpha file:text-sm file:font-medium "
                type="file" placeholder="Audio" id="audio" name="audio">
        </div>
        <div class="flex justify-center mt-4">
            <button class="bg-alpha text-white px-4 py-1 rounded-xl font-thin w-fit shadow-lg">update</button>
        </div>
    </form>

    <script>
        let circuit_id = @json($circuit).id
        let circuit_path = @json($circuit->paths).map((path) => {
            return {
                lat: path.latitude,
                lng: path.longitude
            }
        })
    </script>
    @vite(['resources/js/update_circuit_map.js'])
</x-app-layout>
