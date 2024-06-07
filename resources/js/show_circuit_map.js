
function initMap() {
    let allCicruits = [];
    const svgMarkerBuilding = '/storage/markers/building_marker.svg';

    const casablanca = {
        lat: 33.57,
        lng: -7.60
    }
    const map = new google.maps.Map(document.getElementById('map'), {
        zoom: 9,
        center: casablanca,
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
