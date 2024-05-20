{{-- <script type='text/javascript'
        src='https://maps.google.com/maps/api/js?language=en&key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&region=GB'>
    </script> --}}

<x-app-layout>
    <h2>select your circuit on the map</h2>
    <div id="map" style="width: 100%; height: 400px;"></div>
    <button id="submit" class="border px-2 py-1 rounded-md test-[1.2rem] bg-gray-500 text-white">add circuit</button>
    {{ $circuit->id }}

    <script type='text/javascript'
        src='https://maps.google.com/maps/api/js?language=en&key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&region=GB&libraries=directions'>
    </script>

    <script>
        let markers = [];

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


            // poly line that displayed on red to show the poly line that the user is currentely creating it
            let line = new google.maps.Polyline({
                strokeColor: '#FF0000',
                strokeWeight: 4,
                map: map,
            });

            map.addListener('click', function(event) {
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
                        const response = await axios.post('/circuit/path_post', cordinates);
                        markers.map(marker => marker.setMap(null))
                        window.location.href = response.data['route_to_building']

                    } catch (error) {
                        // Handle errors
                        console.error('Error posting data:', error.response.data);
                        // Display error message to the user
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



                // allCicruits.push(polyLine)


                // for (const polyLine of allCicruits) {
                //     polyLine.setOptions({
                //         path: polyline = polyLine.latLngs.Fg[0].Fg.map(path => {
                //             return {
                //                 lat: path.lat(),
                //                 lng: path.lng()
                //             }
                //         }),
                //     });

                //     polyLine.addListener('click', function() {
                //         console.log(polyLine.data);
                //     })
                // }
            })
        }


        window.onload = initMap;
    </script>
</x-app-layout>
