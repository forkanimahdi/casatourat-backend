
<x-app-layout>
    @include('circuit.partials.unassign_building_modal')
    {{ $circuit->published }}
    <h2>assign a building to the circuit</h2>
    <div id="map" style="width: 100%; height: 400px;"></div>
    <form action="{{ route('circuit.update_draft' , $circuit) }}" method="post">
        @method('PUT')
        @csrf
        <button
            class="border px-2 py-1 rounded-md test-[1.2rem] bg-gray-500 text-white">{{ $circuit->published ? 'unpublish' : 'publish' }}
            the circuit</button>
    </form>
    @foreach ($buildings as $building)
        <div>
            <h5>name : {{ $building->name }}</h5>
            <form action="{{ route('circuit.assign_building', $building) }}" method="post">
                @csrf
                @method('PUT')
                <input type="text" class="d-none" value="{{ $id }}" name="circuit_id">
                <button>add</button>
            </form>
        </div>
    @endforeach

    <script>
        console.log(@json($circuit->buildings));
        paths = @json($path_of_circuit).map(path => {
            return {
                ...path,
                lat: Number(path.lat),
                lng: Number(path.lng),
            }
        })

        building_of_circuit = @json($circuit->buildings).map(building => {
            return {
                ...building,
                path: {
                    lat: Number(building.latitude),
                    lng: Number(building.longitude),
                }

            }
        })

        function initMap() {
            let allCicruits = [];
            const casablanca = {
                lat: 33.57,
                lng: -7.60
            }
            const map = new google.maps.Map(document.getElementById('map'), {
                zoom: 9,
                center: casablanca,
                mapTypeId: google.maps.MapTypeId.HYBRID
            });

            // poly line that displayed on red to show the poly line that the user is currentely creating it
            let line = new google.maps.Polyline({
                path: paths,
                strokeColor: '#FF0000',
                strokeWeight: 4,
                map: map,
            });

            building_of_circuit.forEach(building => {
                const marker = new google.maps.Marker({
                    position: building.path,
                    map: map,
                    data: {
                        id: building.id
                    }
                });
                var infowindow = new google.maps.InfoWindow({
                    content: building.name
                });
                infowindow.open(map, marker)

                marker.addListener('click', function() {
                    document.getElementById('building_id').value = marker.data.id
                    document.getElementById('unassign_building').click()
                })
            });
        }


        window.onload = initMap;
    </script>
</x-app-layout>
