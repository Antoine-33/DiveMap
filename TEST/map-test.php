<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <!-- Nous chargeons les fichiers CDN de Leaflet. Le CSS AVANT le JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
          integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
          crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
            integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
            crossorigin=""></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <style type="text/css">
        #map { /* la carte DOIT avoir une hauteur sinon elle n'apparaît pas */
            height: 70vh;
        }
    </style>
    <title>Carte</title>
</head>
<body>

<?php $DB = new PDO('mysql:host=127.0.0.1;dbname=DiveMap', 'utest', ''); ?>

<script>
    var lat = 44.65;
    var lon = -1.1667;
    var mark = {
        "Port de la Vigne": {"lat": 44.674036, "lon": -1.239100},
        "Le Chariot": {"lat": 44.516241, "lon": -1.354705}
    };
    var h = 0;
    var CH = ("<?php
        $json = file_get_contents("https://www.worldtides.info/api?heights&lat=44,516&lon=-1.354705&start=1412272800&length=1&key=f3b03528-dcd0-4272-adf2-bb03a98cbb2e");
        $parsed_json = json_decode($json);
        //$date_jour = $parsed_json->{'status'}->{'features'}->{'date'};
        $height = $parsed_json->{'heights'}[0]->{'height'};
        $heightint = intval($height);
        if ($heightint < 1)
        echo $height;
        else
        ?>");
    var macarte = null;
</script>
<script type="text/javascript">
    // On initialise la latitude et la longitude de Paris (centre de la carte)


    // Fonction d'initialisation de la carte
    function initMap() {
        // Créer l'objet "macarte" et l'insèrer dans l'élément HTML qui a l'ID "map"
        macarte = L.map('map').setView([lat, lon], 11);
        // Leaflet ne récupère pas les cartes (tiles) sur un serveur par défaut. Nous devons lui préciser où nous souhaitons les récupérer. Ici, openstreetmap.fr
        L.tileLayer('https://korona.geog.uni-heidelberg.de/tiles/roads/x={x}&y={y}&z={z}', {
            // Il est toujours bien de laisser le lien vers la source des données
            attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
            minZoom: 1,
            maxZoom: 20
        }).addTo(macarte);
        var myIconG = L.icon({
            iconUrl: '../IMAGES/green-marker.png',
            iconSize: [40, 40], // size of the icon
            iconAnchor: [25, 30], // point of the icon which will correspond to marker's location
            popupAnchor: [-3, -36] // point from which the popup should open relative to the iconAnchor
        });
        var myIconR = L.icon({
            iconUrl: '../IMAGES/red-marker.png',
            iconSize: [40, 40], // size of the icon
            iconAnchor: [25, 30], // point of the icon which will correspond to marker's location
            popupAnchor: [-3, -36] // point from which the popup should open relative to the iconAnchor
        });

        for (place in mark) {
            if (CH < h) {
                var marker = L.marker([mark[place].lat, mark[place].lon], {icon: myIconG}).addTo(macarte);
                marker.bindPopup(place);
            }
            else {
                var marker = L.marker([mark[place].lat, mark[place].lon], {icon: myIconR}).addTo(macarte);
                marker.bindPopup(place);
            }
        }
    }

    window.onload = function () {
        // Fonction d'initialisation qui s'exécute lorsque le DOM est chargé
        initMap();
    };
</script>
<div id="map">
    <!-- Ici s'affichera la carte -->
</div>

</body>
</html>