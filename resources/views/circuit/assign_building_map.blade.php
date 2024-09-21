<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full">
            <h2 class="text-alpha leading-tight capitalize font-semibold text-2xl">
                assign building
            </h2>
        </div>
    </x-slot>
    @include('circuit.partials.unassign_building_modal')
    <div id="map" class="h-[87vh] relative"></div>
    <div
        class="absolute top-[25%] left-[18%] bg-white shadow-md rounded-xl max-h-[80%] w-[21%] px-2 py-1 flex flex-col justify-between items-center ">
        <div
            class="absolute left-0 bottom-0 h-[50%] w-full z-10 rounded-xl bg-gradient-to-t from-white pointer-events-none">
        </div>
        <form action="{{ route('circuit.update_draft', $circuit) }}" method="post" class="absolute z-50 bottom-4">
            @method('PUT')
            @csrf
            <button
                class="border px-4 py-2 rounded-full test-[1.3rem] bg-alpha text-white font-thin">{{ $circuit->published ? 'unpublish' : 'publish' }}
                the circuit
            </button>
        </form>
        <h4 class="text-alpha text-center ">{{ $circuit->name }}</h4>
        <p class="text-gray-500 font-bold text-center m-0 py-2">BUILDINGS</p>
        <div class="overflow-y-auto scrollbar-hide [&::-webkit-scrollbar]:hidden max-h-[100%] pb-10">
            @if (count($buildings) > 0)
                @foreach ($buildings as $building)
                    <div class="relative w-[20vw] h-[20vh] mb-3 rounded-xl pointer-events: auto"
                        style="background-image: url('{{ asset('storage/images/' . $building->images[0]->path) }}'); background-size: cover">
                        <div class="absolute inset-0 bg-black/50 h-[20vh] w-[20vw] rounded-xl">
                        </div>
                        <div class="absolute bottom-0 left-0 w-full px-2 pb-3">
                            <div class="flex justify-between rounded-xl items-center">
                                <div>
                                    <p class="text-white text-[1.1rem] font-medium m-0">{{ $building->name }}</p>
                                    <p class="text-gray-200 text-[0.8rem] font-thin m-0">
                                        {{ Str::limit($building->description, 35, '...') }}</p>
                                </div>
                                <form action="{{ route('circuit.assign_building', $building) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <input type="text" class="d-none" value="{{ $id }}" name="circuit_id">
                                    <button
                                        class="border border-white px-3 py-1 rounded-full text-white font-medium">Assing</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center h-[15vh]">
                    <p class="m-0 text-gray-600 text-[1.2rem] font-medium">All buildings assigned</p>
                    <a href="{{ route('buildings.create') }}" class="">Add a Building</a>
                </div>
            @endif
        </div>
    </div>
    </div>

    <script>
        let paths = @json($path_of_circuit).map(path => {
            return {
                ...path,
                lat: Number(path.lat),
                lng: Number(path.lng),
            }
        })

        let building_of_circuit = @json($circuit->buildings).map(building => {
            return {
                ...building,
                path: {
                    lat: Number(building.latitude),
                    lng: Number(building.longitude),
                }
            }
        })
    </script>
    @vite(['resources/js/assign_building_map.js'])
</x-app-layout>
