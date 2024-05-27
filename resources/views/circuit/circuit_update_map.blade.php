<x-app-layout>
    <div id="map" style="width: 100%; height: 600px;"></div>
    <button class="btn btn-secondary" id="submit">submit update</button>
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
                const marker = new google.maps.Marker({
                    position: {
                        lat: path.lat,
                        lng: path.lng
                    },
                    map: map,
                });

                marker.addListener('click', function() {
                    marker.setMap(null);
                    circuitPath = circuitPath.filter(m => m.lat !== marker.getPosition().lat())
                    line.setPath(circuitPath);
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
            let cordinates = circuitPath.map((marker) => {
                return {
                    circuit_id: @json($circuit).id,
                    latitude: marker.lat,
                    longitude: marker.lng
                }
            })

            async function submitData() {
                if (cordinates.length < 2) return
                try {
                    const response = await axios.put('/circuit/update/' + @json($circuit).id,
                        cordinates);
                    console.log(response);
                } catch (error) {
                    console.error('Error posting data:', error.response.data);
                }
            }
            submitData()

        })


        window.onload = initMap;
    </script>
</x-app-layout>
