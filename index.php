<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>DiveMap</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css"
          integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
          crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"
            integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="
            crossorigin=""></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <link rel="stylesheet" href="CSS/styles.css">
    <style>
        #mapid {
            height: 100vh;
        }
    </style>
</head>
<body>
<?php include_once 'navbar.php' ?>
<?php $bdd = new PDO('mysql:host=127.0.0.1;dbname=DiveMap', 'utest', ''); ?>
<div id="mapid"></div>
<script type="text/javascript">


</script>
<script type="text/javascript">

    var mymap = L.map('mapid').setView([44.65, -1.1667], 10);
    var myIconG = L.icon({
        iconUrl: 'IMAGES/green-marker.png',
        iconSize: [40, 40], // size of the icon
        iconAnchor: [25, 30], // point of the icon which will correspond to marker's location
        popupAnchor: [-3, -36] // point from which the popup should open relative to the iconAnchor
    });
    var myIconR = L.icon({
        iconUrl: 'IMAGES/red-marker.png',
        iconSize: [40, 40], // size of the icon
        iconAnchor: [25, 30], // point of the icon which will correspond to marker's location
        popupAnchor: [-3, -36] // point from which the popup should open relative to the iconAnchor
    });

    L.tileLayer('https://korona.geog.uni-heidelberg.de/tiles/roads/x={x}&y={y}&z={z}', {
        maxZoom: 18,
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
        '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
        'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox.streets'
    }).addTo(mymap);



        <?php
        $bdd = new PDO('mysql:host=127.0.0.1;dbname=DiveMap', 'utest', '');
        $places_count = 1;
        while ($places_count <= 4) {
        $places = $bdd->query('SELECT placeName, placeLat, placeLon FROM places WHERE id="' . $places_count . '"');
        while ($places_content = $places->fetch()) { ?>
        var marker<?php echo $places_count; ?> = L.marker([<?php echo $places_content['placeLat']?>, <?php echo $places_content['placeLon']?>], {icon: myIconG}).addTo(mymap);
        marker<?php echo $places_count; ?>.bindPopup("<?php echo $places_content['placeName'] ?>");
        <?php } ?>
        <?php $places_count++; }?>



    // connection (done)
    // select
    // hauteur
    // position des flag sur la map(done)


</script>

</body>
</html>