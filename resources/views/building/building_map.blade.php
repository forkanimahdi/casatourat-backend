<x-app-layout>

    <h2>add buildings</h2>
    <div id="map" style="width: 100%; height: 400px;"></div>
    {{-- <button id="submit" class="border px-2 py-1 rounded-md test-[1.2rem] bg-gray-500 text-white">add circuit</button>
 --}}
    @include('building.partials.add_building_modal')
    @include('building.partials.delete_building_modal')
    <script type='text/javascript'
        src='https://maps.google.com/maps/api/js?language=en&key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&region=GB&libraries=directions'>
    </script>

    {{ $buildings }}

    <script>
        let markers = [];

        let allBuildings = @json($buildings).map(building => {
            return {
                ...building,
                paths: {
                    lat: Number(building.latitude),
                    lng: Number(building.longitude),
                }
            }
        })

        console.log(allBuildings);

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

            allBuildings.forEach(building => {
                const marker = new google.maps.Marker({
                    position: building.paths,
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
                    document.getElementById('delete_building').click()
                })
            });

            map.addListener('click', function(event) {
                const marker = new google.maps.Marker({
                    position: {
                        lat: event.latLng.lat(),
                        lng: event.latLng.lng()
                    },
                    map: map,
                });
                document.getElementById('submit').click()

                const modal = document.getElementById('staticBackdrop');

                modal.addEventListener('hidden.bs.modal', function(event) {
                    marker.setMap(null)
                    markers = markers.filter(m => m !== marker);
                });
                document.getElementById('longitude').value = event.latLng.lng()
                document.getElementById('latitude').value = event.latLng.lat()

                markers.push(marker);
            });
        }


        window.onload = initMap;
    </script>
</x-app-layout>
