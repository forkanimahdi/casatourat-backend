<x-app-layout>
    <div id="map" style="width: 100%; height: 600px;"></div>
    <button class="btn btn-secondary" id="submit">submit circuit</button>

    <form action="{{ route('circuit.update', $circuit) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div>
            <label for="">name</label>
            <input value="{{ $circuit->name }}" type="text" placeholder="name" name="name">
        </div>
        <div>
            <label for="">alternative</label>
            <input value="{{ $circuit->alternative }}" type="text" placeholder="alternative" name="alternative">
        </div>
        <div>
            <label for="">description</label>
            <input value="{{ $circuit->description }}" type="text" placeholder="description" name="description">
        </div>
        <div>
            <label for="">audio</label>
            <input type="file" placeholder="audio" name="audio">
        </div>
        <button>submit</button>
    </form>



    <script>
        let circuitPath = @json($circuit->paths).map((path) => {
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
                zoom: 10,
                center: casablanca,
                mapTypeId: google.maps.MapTypeId.HYBRID
            });

            let line = new google.maps.Polyline({
                strokeColor: '#FF0000',
                strokeWeight: 4,
                map: map,
                path: circuitPath
            });

            circuitPath.forEach(path => {
                const svgMarker = {
                    path: "M-1.547 12l6.563-6.609-1.406-1.406-5.156 5.203-2.063-2.109-1.406 1.406zM0 0q2.906 0 4.945 2.039t2.039 4.945q0 1.453-0.727 3.328t-1.758 3.516-2.039 3.070-1.711 2.273l-0.75 0.797q-0.281-0.328-0.75-0.867t-1.688-2.156-2.133-3.141-1.664-3.445-0.75-3.375q0-2.906 2.039-4.945t4.945-2.039z",
                    fillColor: "red",
                    fillOpacity: 0.7,
                    strokeWeight: 0,
                    rotation: 0,
                    scale: 2,
                    anchor: new google.maps.Point(0, 20),
                };

                const currentMarkers = new google.maps.Marker({
                    position: {
                        lat: path.lat,
                        lng: path.lng
                    },
                    icon: svgMarker,
                    map: map,
                });

                currentMarkers.addListener('click', function(event) {
                    currentMarkers.setMap(null)
                    circuitPath = circuitPath.filter(m => m.lat !== currentMarkers.getPosition().lat())
                    line.setPath(circuitPath);
                    // submitData()
                });
            });


            map.addListener('click', function(event) {
                const marker = new google.maps.Marker({
                    position: {
                        lat: event.latLng.lat(),
                        lng: event.latLng.lng()
                    },
                    map: map,
                });
                circuitPath.push({
                    lat: marker.getPosition().lat(),
                    lng: marker.getPosition().lng(),
                });
                marker.addListener('click', function() {
                    marker.setMap(null);
                    circuitPath = circuitPath.filter(m => m.lat !== marker.getPosition().lat())
                    line.setPath(circuitPath);
                });

                line.setPath(circuitPath);
            })

        };

        document.getElementById('submit').addEventListener('click', function() {
            submitData()
        })

        async function submitData() {
            let cordinates = circuitPath.map((marker) => {
                return {
                    circuit_id: @json($circuit).id,
                    latitude: marker.lat,
                    longitude: marker.lng
                }
            })
            if (cordinates.length < 2) return
            try {
                const response = await axios.put('/circuit/update_circuit/' + @json($circuit).id,
                    cordinates);
                if (response.status == 200) {
                    console.log('circuit updated successfully');
                    // alert('circuit updated successfully')
                    location.reload()
                }
            } catch (error) {
                console.error('Error posting data:', error);
            }
        }

        window.onload = initMap;
    </script>
</x-app-layout>
