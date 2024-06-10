
function initMap() {
    let allCicruits = [];
    const svgMarkerBuilding = '/storage/markers/building_marker.svg';

    const circuit = {
        lat: paths[1].lat,
        lng: paths[1].lng
    }
    const map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: circuit,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
    });

    new google.maps.Polyline({
        path: paths,
        strokeColor: '#5A5A5A',
        strokeWeight: 4,
        map: map,
    });


    building_of_circuit.forEach(building => {
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
        var infowindow = new google.maps.InfoWindow({
            content: building.name
        });
        infowindow.open(map, marker)
        marker.addListener('click', function () {
            document.getElementById('building_id').value = marker.data.id
            document.getElementById('unassign_building').click()
        })
    });
}

window.onload = initMap;
