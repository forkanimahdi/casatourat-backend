<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full">
            <h2 class="text-alpha leading-tight capitalize font-semibold text-2xl">
                {{-- {{ $circuit->name }} --}}
                circuit
            </h2>
        </div>
    </x-slot>

    <div class="flex pt-3 items-start justify-between gap-2 px-3 h-[85vh]">
        <div
            class="relative bg-white shadow-md rounded-xl  max-h-[100%] w-fit px-2 py-1 flex flex-col justify-between items-center ">
            <div
                class="absolute left-0 bottom-0 h-[50%] w-full z-10 rounded-xl bg-gradient-to-t from-white pointer-events-none">
            </div>
            <div class="absolute z-50 bottom-4">
                <a class="px-4 py-2 rounded-full bg-alpha text-white font-thin no-underline"
                    href="{{ route('assign_building.index', $circuit->id) }}">
                    assign building
                </a>
            </div>
            <p class="text-gray-400 font-bold text-center m-0 py-2">BUILDINGS</p>
            <div class="overflow-y-auto scrollbar-hide [&::-webkit-scrollbar]:hidden max-h-[100%] pb-10">
                @if (count($circuit->buildings) > 0)
                    @foreach ($circuit->buildings as $building)
                        <div class="relative w-[20vw] h-[20vh] mb-3 rounded-xl pointer-events: auto"
                            style="background-image: url('{{ asset('storage/images/' . $building->images[0]->path) }}'); background-size: cover">
                            <div class="absolute inset-0 bg-black/50 h-[20vh] w-[20vw] rounded-xl">
                            </div>
                            <div class="absolute bottom-0 left-0 w-full px-2 pb-3">
                                <div class="flex justify-between rounded-xl items-center">
                                    <div>
                                        </p>
                                        <p class="text-gray-200 text-[0.8rem] font-thin m-0">
                                            {{ Str::limit($building->description, 35, '...') }}</p>
                                    </div>
                                    <form action="{{ route('circuit.unassign_building') }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" class="d-none" value="{{ $building->id }}"
                                            name="building_id">
                                        <button
                                            class="border border-white px-3 py-1 rounded-full text-white font-medium">Unassign</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center h-[15vh] w-[20vw] ">
                        <p class="m-0 text-gray-600 text-[1.2rem] font-medium">No buildings assigned</p>
                        <a href="{{ route('assign_building.index', $circuit->id) }}" class="">Assign a
                            Building</a>
                    </div>
                @endif
            </div>
        </div>
        <div class="flex flex-col w-full bg-white p-2 rounded-xl">
            <div class="h-[40vh] rounded-xl shadow-md" id="map">
            </div>
            <div class="w-full py-4 px-2 flex justify-between gap-6">
                <div class="w-[60%]">
                    <p class="font-medium text-[1.1rem]">{{ $circuit->name }}</p>
                    <p class="text-gray-400  h-[25vh] overflow-auto p-2 w-fit">
                        {{ $circuit->description }}</p>
                </div>
                <div class="w-[40%] flex flex-col justify-between gap-3">
                    <audio controls class=" w-full">
                        <source src="{{ asset('storage/audios/' . $circuit->audio) }}">
                        Your browser does not support the audio element.
                    </audio>
                    <div class="flex justify-between items-center">
                        <form action="{{ route('circuit.update_draft', $circuit) }}" method="post" class="">
                            @method('PUT')
                            @csrf
                            <button
                                class="px-4 py-2 rounded-full  w-[10vw] bg-alpha text-white font-thin">{{ $circuit->published ? 'unpublish' : 'publish' }}
                                circuit
                            </button>
                        </form>
                        <div class="flex gap-1 justify-end w-full">
                            <a class="" href="{{ route('circuit.update_map', $circuit) }}">
                                <button
                                    class="bg-blue-600 px-2 py-1 rounded-md text-white flex items-center justify-center gap-1">
                                    <svg fill="#000000" width="15px" height="15px" viewBox="0 0 24 24"
                                        id="update-alt-2" data-name="Flat Color" xmlns="http://www.w3.org/2000/svg"
                                        class="icon flat-color">
                                        <path id="primary"
                                            d="M21.71,10.29a1,1,0,0,0-1.42,0L19,11.59V7a3,3,0,0,0-3-3H6A1,1,0,0,0,6,6H16a1,1,0,0,1,1,1v4.59l-1.29-1.3a1,1,0,0,0-1.42,1.42l3,3a1,1,0,0,0,1.42,0l3-3A1,1,0,0,0,21.71,10.29Z"
                                            style="fill: rgb(0, 0, 0);"></path>
                                        <path id="secondary"
                                            d="M18,18H8a1,1,0,0,1-1-1V12.41l1.29,1.3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42l-3-3a1,1,0,0,0-1.42,0l-3,3a1,1,0,0,0,1.42,1.42L5,12.41V17a3,3,0,0,0,3,3H18a1,1,0,0,0,0-2Z"
                                            style="fill: rgb(44, 169, 188);"></path>
                                    </svg>
                                    <p class="m-0">Update</p>
                                </button>
                            </a>
                            <form action="{{ route('circuit.destroy', $circuit) }}" method="post" class="">
                                @csrf
                                @method('DELETE')
                                <button
                                    class="bg-red-600 px-2 py-1 rounded-md text-white flex items-center justify-center gap-1">
                                    <svg width="15px" height="15px" viewBox="0 0 1024 1024" class="icon"
                                        version="1.1" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M779.5 1002.7h-535c-64.3 0-116.5-52.3-116.5-116.5V170.7h768v715.5c0 64.2-52.3 116.5-116.5 116.5zM213.3 256v630.1c0 17.2 14 31.2 31.2 31.2h534.9c17.2 0 31.2-14 31.2-31.2V256H213.3z"
                                            fill="#3688FF" />
                                        <path
                                            d="M917.3 256H106.7C83.1 256 64 236.9 64 213.3s19.1-42.7 42.7-42.7h810.7c23.6 0 42.7 19.1 42.7 42.7S940.9 256 917.3 256zM618.7 128H405.3c-23.6 0-42.7-19.1-42.7-42.7s19.1-42.7 42.7-42.7h213.3c23.6 0 42.7 19.1 42.7 42.7S642.2 128 618.7 128zM405.3 725.3c-23.6 0-42.7-19.1-42.7-42.7v-256c0-23.6 19.1-42.7 42.7-42.7S448 403 448 426.6v256c0 23.6-19.1 42.7-42.7 42.7zM618.7 725.3c-23.6 0-42.7-19.1-42.7-42.7v-256c0-23.6 19.1-42.7 42.7-42.7s42.7 19.1 42.7 42.7v256c-0.1 23.6-19.2 42.7-42.7 42.7z"
                                            fill="#5F6379" />
                                    </svg>
                                    <p class="m-0">Delete</p>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let circuit_path = @json($circuit->paths).map(path => {
            return {
                ...path,
                lat: Number(path.latitude),
                lng: Number(path.longitude),
            }
        })

        let circuit_buildings = @json($circuit->buildings).map(building => {
            return {
                ...building,
                path: {
                    lat: Number(building.latitude),
                    lng: Number(building.longitude),
                }
            }
        })
    </script>
    @vite(['resources/js/show_circuit_map.js'])
</x-app-layout>
