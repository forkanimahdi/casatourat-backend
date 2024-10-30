function initMap() {
    const circuit = {
        lat: circuit_path[1].lat,
        lng: circuit_path[1].lng,
    };
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 15,
        center: circuit,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
    });

    const lineSymbol = {
        path: "M 0,-1 0,1",
        strokeOpacity: 0.7,
        scale: 3,
    };

    let line = new google.maps.Polyline({
        map: map,
        path: circuit_path,
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

    circuit_path.forEach((path) => {
        const svgMarkerPath = "/assets/markers/path.svg";

        const currentMarkers = new google.maps.Marker({
            position: {
                lat: path.lat,
                lng: path.lng,
            },
            icon: {
                url: svgMarkerPath,
                scaledSize: new google.maps.Size(25, 25),
                anchor: new google.maps.Point(10, 26),
            },
            map: map,
        });

        currentMarkers.addListener("click", function (event) {
            currentMarkers.setMap(null);
            circuit_path = circuit_path.filter(
                (m) => m.lat !== currentMarkers.getPosition().lat()
            );
            line.setPath(circuit_path);
        });
    });

    map.addListener("click", function (event) {
        const marker = new google.maps.Marker({
            position: {
                lat: event.latLng.lat(),
                lng: event.latLng.lng(),
            },
            map: map,
        });
        circuit_path.push({
            lat: marker.getPosition().lat(),
            lng: marker.getPosition().lng(),
        });
        marker.addListener("click", function () {
            marker.setMap(null);
            circuit_path = circuit_path.filter(
                (m) => m.lat !== marker.getPosition().lat()
            );
            line.setPath(circuit_path);
        });
        line.setPath(circuit_path);
    });
}

const form = document.querySelector("#myForm");
form.addEventListener("submit", function (e) {
    e.preventDefault();
    let formData = new FormData(form);
    let cordinates = circuit_path.map((marker) => {
        return {
            circuit_id: circuit_id,
            latitude: marker.lat,
            longitude: marker.lng,
        };
    });
    formData.append("cordinates", JSON.stringify(cordinates));
    console.log(formData);
    function submitData() {
        if (cordinates.length < 2) return;
        try {
            axios
                .post(`/update/path/${circuit_id}`, formData)
                .then((response) => {
                    if (response.status == 200) {
                        console.log("response : ", response.data);
                        location.reload();
                    }
                });
        } catch (error) {
            console.error("Error posting data:", error);
        }
    }
    submitData();
});

window.onload = initMap;
