<x-app-layout>

    <h2>add buildings</h2>
    <form action="">
        <label for="" class="text-white">search for place</label>
        <input type="text" name="map-input" placeholder="search" class="border border-black px-3 py-2">
        <button class="btn btn-primary">search</button>
    </form>
    <div id="map" style="width: 100%; height: 400px;"></div>

    @include('building.partials.add_building_modal')
    {{-- @include('building.partials.delete_building_modal') --}}
    
    <script>
        let markers = [];
        const svgMarkerBuilding = '/storage/markers/building_marker.svg';

        let allBuildings = @json($buildings).map(building => {
            return {
                ...building,
                paths: {
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
                zoom: 10,
                center: casablanca,
                mapTypeId: google.maps.MapTypeId.HYBRID
            });


            allBuildings.forEach(building => {

                const marker = new google.maps.Marker({
                    position: building.paths,
                    map: map,
                    data: {
                        id: building.id
                    },
                    icon: {
                        url: svgMarkerBuilding,
                        scaledSize: new google.maps.Size(45, 45),
                        anchor: new google.maps.Point(20, 45),
                    }
                });

                var infowindow = new google.maps.InfoWindow({
                    content: building.name
                });

                infowindow.open(map, marker)
                marker.addListener('click', function() {
                    try {
                        console.log(marker.data);
                        const response = axios.delete(`/building/destroy/` + marker.data.id, {
                            headers: {
                                'x-access-token': document.querySelector('meta[name="csrf-token"]')
                                    .content
                            },
                        }).then(response => console.log(response))
                    } catch (error) {
                        console.log(error);
                    }
                })
            });

            map.addListener('click', function(event) {
                const marker = new google.maps.Marker({
                    position: {
                        lat: event.latLng.lat(),
                        lng: event.latLng.lng()
                    },
                    map: map,
                    icon: {
                        url: svgMarkerBuilding,
                        scaledSize: new google.maps.Size(45, 45),
                        anchor: new google.maps.Point(20, 45),
                    }
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
