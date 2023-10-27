<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Demo: Make a heatmap with Mapbox GL JS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="https://api.tiles.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.js"></script>
    <link href="https://api.tiles.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.css" rel="stylesheet" />
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

        .marker {
            background-image: url("{{ asset('mapbox-icon.png') }}");
            background-size: cover;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            cursor: pointer;
        }

        .floating-card {
            position: absolute;
            background: white;
            padding: 10px;
            border: 1px solid #ccc;
            max-width: 300px;
            z-index: 1;
            display: block;
            left: 10px;
            top: 10px;
        }

        .overflow {
            overflow-y: scroll;
            max-height: 80vh;
        }

        .overflow::-webkit-scrollbar {
            display: none;
        }

        .blue-circle {
            width: 32px;
            height: 32px;
            background-color: blue;
            border-radius: 50%;
            /* Membuatnya lingkaran */
            border: 2px solid #fff;
            /* Tambahkan border putih */
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.4);
            /* Efek bayangan */
        }
    </style>
</head>

<body>
    <div id="map"></div>
    <div id="floating-card" class="floating-card">
        <h3 onclick="deleteLayer()">Daftar SDM</h3>
        <div class="overflow">
            <ul>
            </ul>
        </div>
    </div>

    <script>
        mapboxgl.accessToken = 'pk.eyJ1IjoiYTJyaiIsImEiOiJja2g3OW11N3MwNmh1MzBsbDQ4NGVrYWNtIn0.uvhpm1k_6EIRZXyOhHq7QQ';
        const map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/satellite-streets-v11',
            center: [117.419130, -8.497193],
            zoom: 11
        });
        map.on('load', () => {
            for (const feature of @json($centerCoords)) {
                // create a HTML element for each feature
                const el = document.createElement('div');
                el.className = 'marker';

                // make a marker for each feature and add to the map
                new mapboxgl.Marker(el).setLngLat([feature['lon'], feature['lat']]).addTo(map);
            }
            for (const feature of @json($featureCollection['features'])) {
                // create a HTML element for each feature
                const el = document.createElement('div');
                el.className = 'blue-circle';

                // make a marker for each feature and add to the map
                new mapboxgl.Marker(el).setLngLat([feature.geometry.coordinates['0'], feature.geometry.coordinates['1']]).addTo(map);
            }

            map.addSource('trees', {
                'type': 'geojson',
                'data': @json($featureCollection)
            });

            map.addLayer({
                    'id': 'trees-heat',
                    'type': 'heatmap',
                    'source': 'trees',
                    'maxzoom': 15,
                    'paint': {
                        // increase weight as diameter breast height increases
                        'heatmap-weight': {
                            'property': 'dbh',
                            'type': 'exponential',
                            'stops': [
                                [1, 0],
                                [62, 1]
                            ]
                        },
                        // increase intensity as zoom level increases
                        'heatmap-intensity': {
                            'stops': [
                                [11, 1],
                                [15, 3]
                            ]
                        },
                        // use sequential color palette to use exponentially as the weight increases
                        'heatmap-color': [
                            'interpolate',
                            ['linear'],
                            ['heatmap-density'],
                            0,
                            'rgba(236,222,239,0)',
                            0.2,
                            'rgb(208,209,230)',
                            0.4,
                            'rgb(166,189,219)',
                            0.6,
                            'rgb(103,169,207)',
                            0.8,
                            'rgb(28,144,153)'
                        ],
                        // increase radius as zoom increases
                        'heatmap-radius': {
                            'stops': [
                                [11, 15],
                                [15, 20]
                            ]
                        },
                        // decrease opacity to transition into the circle layer
                        'heatmap-opacity': {
                            'default': 1,
                            'stops': [
                                [14, 1],
                                [15, 0]
                            ]
                        }
                    }
                },
                'waterway-label'
            );

            // map.addLayer({
            //         'id': 'trees-point',
            //         'type': 'circle',
            //         'source': 'trees',
            //         'minzoom': 14,
            //         'paint': {
            //             // increase the radius of the circle as the zoom level and dbh value increases
            //             'circle-radius': {
            //                 'property': 'dbh',
            //                 'type': 'exponential',
            //                 'stops': [
            //                     [{
            //                         zoom: 15,
            //                         value: 1
            //                     }, 5],
            //                     [{
            //                         zoom: 15,
            //                         value: 62
            //                     }, 10],
            //                     [{
            //                         zoom: 22,
            //                         value: 1
            //                     }, 20],
            //                     [{
            //                         zoom: 22,
            //                         value: 62
            //                     }, 50]
            //                 ]
            //             },
            //             'circle-color': {
            //                 'property': 'dbh',
            //                 'type': 'exponential',
            //                 'stops': [
            //                     [0, 'rgba(236,222,239,0)'],
            //                     [10, 'rgb(236,222,239)'],
            //                     [20, 'rgb(208,209,230)'],
            //                     [30, 'rgb(166,189,219)'],
            //                     [40, 'rgb(103,169,207)'],
            //                     [50, 'rgb(28,144,153)'],
            //                     [60, 'rgb(1,108,89)']
            //                 ]
            //             },
            //             'circle-stroke-color': 'white',
            //             'circle-stroke-width': 1,
            //             'circle-opacity': {
            //                 'stops': [
            //                     [14, 0],
            //                     [15, 1]
            //                 ]
            //             }
            //         }
            //     },
            //     'waterway-label'
            // );
        });

        // click on tree to view dbh in a popup
        const list = document.querySelector(".overflow ul");
        map.on('click', 'trees-point', (event) => { // Get the user property from the clicked feature
            const userValue = event.features[0].properties.user;

            const listItem = document.createElement("li");
            listItem.textContent = userValue;
            list.appendChild(listItem);

            new mapboxgl.Popup()
                .setLngLat(event.features[0].geometry.coordinates)
                .setHTML(`<strong>DBH:</strong> ${userValue}`)
                .addTo(map);
        });

        function deleteLayer() {
            // map.removeLayer('trees-point')
        }
    </script>
</body>

</html>