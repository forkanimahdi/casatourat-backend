<x-app-layout>
    <h2>select your circuit on the map</h2>z
    <div id="map" style="width: 100%; height: 500px;">
        <div class="w-8 h-8 bg-black z-20">
            <h1>content</h1>
        </div>
    </div>
    <button id="submit" class="border px-2 py-1 rounded-md test-[1.2rem] bg-gray-500 text-white">add circuit</button>

    <p class="text-white">{{ $circuit->paths }}</p>

    <script>
        let markers = [];

        let circuitPaths = @json($circuit->paths).map((path) => {
            return {
                lat: path.latitude,
                lng: path.longitude
            }
        })

        function initMap() {
            const casablanca = {
                lat: 33.57,
                lng: -7.60
            }
            const map = new google.maps.Map(document.getElementById('map'), {
                zoom: 9,
                center: casablanca,
                mapTypeId: google.maps.MapTypeId.HYBRID
            });


            let line = new google.maps.Polyline({
                strokeColor: '#FF0000',
                strokeWeight: 4,
                map: map,
            });

            map.addListener('click', function(event) {
                console.log(markers);
                const marker = new google.maps.Marker({
                    position: {
                        lat: event.latLng.lat(),
                        lng: event.latLng.lng()
                    },
                    map: map,
                });
                marker.addListener('click', function() {
                    marker.setMap(null);
                    markers = markers.filter(m => m !== marker);
                    line.setPath(markers.map(marker => marker.getPosition()));
                });
                markers.push(marker);
                line.setPath(markers.map(marker => marker.getPosition()));
            });

            document.getElementById('submit').addEventListener('click', function() {
                let cordinates = markers.map((marker) => {
                    return {
                        circuit_id: @json($circuit).id,
                        latitude: marker.getPosition().lat(),
                        longitude: marker.getPosition().lng()
                    }
                })

                async function submitData() {
                    if (markers.length < 2) return
                    try {
                        const response = await axios.post('/circuit/path_post',
                            cordinates);
                        markers.map(marker => marker.setMap(null))
                        window.location.href = response.data['route_to_building']

                    } catch (error) {
                        console.error('Error posting data:', error.response.data);
                    }
                }
                submitData()



                const markersOfPlyLine = markers.map(marker => marker.getPosition())
                const polyLine = new google.maps.Polyline({
                    path: markersOfPlyLine,
                    strokeColor: '#00FF00',
                    strokeWeight: 5,
                    map: map,
                    data: {
                        id: @json($circuit).id,
                        name: @json($circuit).name,
                        description: @json($circuit).description
                    }
                });

            })
        }

        window.onload = initMap;
    </script>

</x-app-layout>
