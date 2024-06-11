
function initMap() {
    const svgMarkerBuilding = '/storage/markers/building_marker.svg';
    const svgMarkerPath = '/storage/markers/path_marker.svg';

    const circuit = {
        lat: circuit_path[1].lat,
        lng: circuit_path[1].lng
    }
    const map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: circuit,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        disableDefaultUI: true,
    });

    new google.maps.Polyline({
        path: circuit_path,
        strokeColor: '#002d55',
        strokeWeight: 4,
        map: map,
    });

    // circuit_path.forEach(path => {
    //     new google.maps.Marker({
    //         position: {
    //             lat: path.lat,
    //             lng: path.lng,
    //         },
    //         map: map,
    //         icon: {
    //             url: svgMarkerPath,
    //             scaledSize: new google.maps.Size(25, 25),
    //             anchor: new google.maps.Point(10, 26),
    //         },
    //     });
    // });

    circuit_buildings.forEach(building => {
        const marker = new google.maps.Marker({
            position: building.path,
            map: map,
            animation: google.maps.Animation.DROP,
            data: {
                id: building.id
            },
            icon: {
                url: svgMarkerBuilding,
                scaledSize: new google.maps.Size(45, 45),
                anchor: new google.maps.Point(20, 45),
            },
            title: building.name
        });
        // var infowindow = new google.maps.InfoWindow({
        //     content: building.name
        // });
        // infowindow.open(map, marker)
    });
}

window.onload = initMap;
