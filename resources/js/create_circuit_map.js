let markers = [];

function initMap() {
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 12,
        center: {
            lat: 33.57,
            lng: -7.6,
        },
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        disableDefaultUI: true

    });

    const line = new google.maps.Polyline({
        map: map,
        strokeOpacity: 0,
        icons: [
            {
                icon: {
                    path: "M 0,-1 0,1",
                    strokeOpacity: 0.7,
                    scale: 3,
                },
                offset: "0",
                repeat: "15px",
            },
        ],
        
    });

    map.addListener("click", function (event) {
        const svgMarkerPath = "/assets/markers/path.svg";
        const marker = new google.maps.Marker({
            position: {
                lat: event.latLng.lat(),
                lng: event.latLng.lng(),
            },
            map: map,
            icon: {
                url: svgMarkerPath,
                scaledSize: new google.maps.Size(40, 40),
                anchor: new google.maps.Point(20, 40),
            },
        });

        marker.addListener("click", function () {
            marker.setMap(null);
            markers = markers.filter((m) => m !== marker);
            line.setPath(markers.map((marker) => marker.getPosition()));
        });

        markers.push(marker);

        coordinates.value = JSON.stringify(
            markers.map((marker) => {
                return {
                    latitude: marker.getPosition().lat(),
                    longitude: marker.getPosition().lng(),
                };
            })
        );

        line.setPath(markers.map((marker) => marker.getPosition()));

        nextBtn.disabled = !(markers.length > 1);
    });



    // Search box for places
    var input = document.getElementById("search_input");
    var searchBox = new google.maps.places.SearchBox(input);
    map.controls[google.maps.ControlPosition.TOP_CENTER].push(input);

    // Bias the search results towards the map's viewport
    map.addListener('bounds_changed', function () {
        searchBox.setBounds(map.getBounds());
    });

    // Handle places changed event
    var search_markers = [];
    searchBox.addListener('places_changed', function () {
        var places = searchBox.getPlaces();

        if (places.length === 0) {
            return;
        }

        // Clear out the old markers
        search_markers.forEach(function (marker) {
            marker.setMap(null);
        });
        search_markers = [];

        // For each place, get the icon, name, and location
        var bounds = new google.maps.LatLngBounds();
        places.forEach(function (place) {
            console.log(place);

            if (!place.geometry || !place.geometry.location) {
                console.log("Returned place contains no geometry");
                return;
            }

            // Create a marker for each place
            var search_marker = new google.maps.Marker({
                map: map,
                title: place.name,
                position: place.geometry.location,
                icon: {
                    url: '/assets/markers/search_results.svg',
                    scaledSize: new google.maps.Size(45, 45),
                    anchor: new google.maps.Point(20, 45),
                }
            });
            search_markers.push(search_marker);

            if (place.geometry.viewport) {
                bounds.union(place.geometry.viewport);
            } else {
                bounds.extend(place.geometry.location);
            }
        });

        map.fitBounds(bounds);
    });
}

window.onload = initMap;
