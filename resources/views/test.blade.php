 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
     <link rel="stylesheet" href="style.css" />
     <title>Get Distances between two points</title>
     <style>
         body {
             color: #fff;
             padding: 20px;
             font-family: arial;
             background: #000;
         }

         * {
             padding: 0;
             margin: 0;
         }

         .result {
             padding: 30px;
             text-align: center;
         }

         #map {
             width: 100%;
             height: calc(100vh - 100px);
         }
     </style>
 </head>

 <body>

     <div class="result">
         Distance (in meters):

         <!-- displaying the distance here:  -->
         <span id="length"></span>
     </div>
     <div id="map"></div>

     <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
     <script src="leaflet.geometryutil.js"></script>
     <script>
         let mapOptions = {
             center: [-8.498108231812953, 117.41270731682353],
             zoom: 13
         };

         let map = new L.map('map', mapOptions);
         let layer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');

         map.addLayer(layer);

         let _firstLatLng, _secondLatLng, _polyline, markerA = null,
             markerB = null;

         let markersLayer = new L.LayerGroup();
         const a = [-8.498105865801874, 117.41270572197267]
         const b = [-8.4981098, 117.4127073]
         map.on('click', function(e) {
             if (!_firstLatLng) {
                 _firstLatLng = e.latlng;
                 markerA = L.marker(_firstLatLng).addTo(map).bindPopup('Point A<br/>' + e.latlng).openPopup();
             } else if (!_secondLatLng) {
                 _secondLatLng = e.latlng;
                 markerB = L.marker(_secondLatLng).addTo(map).bindPopup('Point B<br/>' + e.latlng).openPopup();
                 _polyline = L.polyline([_firstLatLng, _secondLatLng], {
                     color: 'red'
                 });
                 _polyline.addTo(map);
                 let _length = _firstLatLng.distanceTo(_secondLatLng);
                 document.getElementById('length').innerHTML = 'Distance: ' + _length.toFixed(2) + ' meters';
             } else {
                 if (_polyline) {
                     map.removeLayer(_polyline);
                     _polyline = null;
                 }
                 _firstLatLng = e.latlng;
                 map.removeLayer(markerA);
                 map.removeLayer(markerB);
                 _secondLatLng = null;
                 markerA = L.marker(_firstLatLng).addTo(map).bindPopup('Point A<br/>' + e.latlng).openPopup();
             }
         });
     </script>

 </body>

 </html>