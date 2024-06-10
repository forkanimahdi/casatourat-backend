
let markers = [];
function initMap() {
    const casablanca = {
        lat: 33.57,
        lng: -7.60
    }
    const map = new google.maps.Map(document.getElementById('map'), {
        zoom: 12,
        center: casablanca,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
    });
    const lineSymbol = {
        path: "M 0,-1 0,1",
        strokeOpacity: 0.7,
        scale: 3,
    };

    let line = new google.maps.Polyline({
        map: map,
        strokeOpacity: 0,
        icons: [
            {
                icon: lineSymbol,
                offset: "0",
                repeat: "15px",
            },
        ],
    });

    map.addListener('click', function (event) {
        const svgMarkerPath = '/storage/markers/path_marker.svg';
        const marker = new google.maps.Marker({
            position: {
                lat: event.latLng.lat(),
                lng: event.latLng.lng()
            },
            map: map,
            icon: {
                url: svgMarkerPath,
                scaledSize: new google.maps.Size(40, 40),
                anchor: new google.maps.Point(20, 40),
            }
        });

        marker.addListener('click', function () {
            marker.setMap(null);
            markers = markers.filter(m => m !== marker);
            line.setPath(markers.map(marker => marker.getPosition()));
        });
        markers.push(marker);
        line.setPath(markers.map(marker => marker.getPosition()));
    });
    const form = document.querySelector('#myForm')

    form.addEventListener('submit', function (e) {
        e.preventDefault()
        const formData = new FormData(form)
        let cordinates = markers.map((marker) => {
            return {
                latitude: marker.getPosition().lat(),
                longitude: marker.getPosition().lng()
            }
        })
        formData.append('cordinates', JSON.stringify(cordinates))
        function submitData() {
            if (markers.length < 2) return
            try {
                axios.post('/circuit/store', formData).then(response => {
                    window.location.href = response.data['route_to_building']
                });
                markers.map(marker => marker.setMap(null))

            } catch (error) {
                console.error('Error posting data:', error);
            }
        }
        submitData()

        const markersOfPlyLine = markers.map(marker => marker.getPosition())
        new google.maps.Polyline({
            path: markersOfPlyLine,
            strokeColor: '#5A5A5A',
            strokeWeight: 4,
            map: map,
        });

    })
}

window.onload = initMap;
