<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Point Distance</title>
    <meta name="description" content="">
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no">
    <script src='https://unpkg.com/@turf/turf/turf.min.js'></script>
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.js"></script>

    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.min.js"></script>
    <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.css" type="text/css">
</head>
<style>
    body {
        margin: 0;
        padding: 0;
    }

    #map {
        position: absolute;
        top: 0;
        bottom: 0;
        width: 100%;
    }

    #map-overlay {
        position: absolute;
        top: 0;
        left: 10px;
        background: rgba(255, 255, 255, 1);
        margin-right: 20px;
        margin-top: 20px;
        padding: 10px 0 0 10px;
        font-family: Arial, sans-serif;
        overflow: auto;
        width: 300px;
        max-height: 80vh;
        border-radius: 3px;
    }

    ol {
        margin: 0;
        padding: 0;
    }

    li {
        display: flex;
        flex-direction: column;
        padding-bottom: 10px;
    }
</style>

<body>
    <div id='map'></div>
    <div id='map-overlay'>
        <small>Validasi lokasi map terlebih dahulu sebelum export.</small>
        <br>
        <a href="#" onclick="downloadData()">Export data</a>
        <p>List SDM:</p>
        <ol></ol>
    </div>
    <script>
        mapboxgl.accessToken = 'pk.eyJ1IjoiYTJyaiIsImEiOiJja2g3OW11N3MwNmh1MzBsbDQ4NGVrYWNtIn0.uvhpm1k_6EIRZXyOhHq7QQ';
        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [117.41332662201309, -8.498345817474537],
            zoom: 20
        });

        map.addControl(
            new MapboxGeocoder({
                accessToken: mapboxgl.accessToken,
                mapboxgl: mapboxgl
            })
        );

        var kerato = [117.41307181217832, -8.498422747467906]
        var kantorBupati = [117.419752, -8.489655]


        var greenMarker = new mapboxgl.Marker({
                color: 'purple'
            })
            .setLngLat(kerato)
            .addTo(map);

        var purpleMarker = new mapboxgl.Marker({
                color: 'green'
            })
            .setLngLat(kantorBupati)
            .addTo(map);

        var options = {
            units: 'meters'
        };

        const data = []

        for (const feature of @json($mergeCoords)) {
            let coord = [feature['lon'], feature['lat']];
            var distance = turf.distance(coord, kerato, options);
            if (distance <= 400) {
                data.push(feature)
                new mapboxgl.Marker({
                        color: 'green'
                    })
                    .setLngLat(coord)
                    .addTo(map);
            }
            var distance = turf.distance(coord, kantorBupati, options);
            if (distance <= 400) {
                data.push(feature)
                new mapboxgl.Marker({
                        color: 'purple'
                    })
                    .setLngLat(coord)
                    .addTo(map);
            }
        }

        const markers = [];
        const olElement = document.querySelector('#map-overlay ol');
        data.forEach(item => {
            const liElement = document.createElement('li');
            liElement.textContent = `Name: ${item.sdm_name} - [${item.lat},${item.lon}]`;
            const googleMapsLink = document.createElement('a');
            googleMapsLink.href = `https://www.google.com/maps?q=${item.lat},${item.lon}`;
            googleMapsLink.target = "_blank";
            googleMapsLink.textContent = `View on Google Maps`;
            liElement.appendChild(googleMapsLink);
            olElement.appendChild(liElement);

            liElement.addEventListener('click', () => {
                markers.forEach(m => m.remove());
                var marker = new mapboxgl.Marker({
                        color: 'red'
                    })
                    .setLngLat([item.lon, item.lat])
                    .addTo(map);
                markers.push(marker)
                map.flyTo({
                    center: [item.lon, item.lat],
                    zoom: 20,
                });
            });
        });

        function downloadData() {
            fetch("{{ route('map.download') }}", {
                    method: "POST",
                    body: JSON.stringify(data),
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": @json(csrf_token()),
                    },
                })
                .then((response) => {
                    if (response.ok) {
                        // Response yang berhasil
                        return response.blob();
                    } else {
                        // Tangani kesalahan jika ada
                        throw new Error("Gagal mengirim data");
                    }
                })
                .then((blob) => {
                    // console.log(blob);
                    // Membuat URL objek dari blob
                    const url = window.URL.createObjectURL(blob);

                    // Membuat elemen anchor untuk mengunduh file
                    const a = document.createElement('a');
                    a.style.display = 'none';
                    a.href = url;
                    a.download = 'data absensi dan lokasi maps.xlsx'; // Nama file yang ingin Anda berikan pada unduhan
                    document.body.appendChild(a);

                    // Klik elemen anchor untuk memulai unduhan
                    a.click();

                    // Hapus elemen anchor setelah unduhan selesai
                    window.URL.revokeObjectURL(url);
                })
                .catch((error) => {
                    console.error(error);
                });
        }
    </script>
</body>

</html>