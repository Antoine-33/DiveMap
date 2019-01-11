var ny = [40.741895, -73.989308];
// création de la map
var map = L.map('map').setView(ny, 6);

// création du calque images
L.tileLayer('http://korona.geog.uni-heidelberg.de/tiles/roads/x={x}&y={y}&z={z}', {
    maxZoom: 20
}).addTo(map);

// ajout d'un markeur
var marker = L.marker(ny).addTo(map);

// ajout d'un popup
marker.bindPopup('<h3> New York, USA. </h3>');

alert("Hello");