// Initialisation de la latitude et la longitude.


var lat = 44.65;
var lon = -1.1667;
var macarte = null;
var height = 0;

var places = {

    "Hortense Bassin d'Arcachon": {"lat": 44.630716, "lon": -1.244348, "height": -1}, //rajouter la hauteur
    "Port de la Vigne": {"lat": 44.674036, "lon": -1.239100, "height": 1},
    "Le Chariot": {"lat": 44.516241, "lon": -1.354705, "height": 2},
    "Sablonneys - Blockhaus": {"lat": 44.586821, "lon": -1.224787, "height": 3},


};


// Fonction d'initialisation de la carte
function initMap() {
    var iconBase = 'http://localhost:63342/DiveMap/IMAGES/';
    // Créer l'objet "macarte" et l'insèrer dans l'élément HTML qui a l'ID "map"
    macarte = L.map('map').setView([lat, lon, height], 10);
    // Leaflet ne récupère pas les cartes (tiles) sur un serveur par défaut. Nous devons lui préciser où nous souhaitons les récupérer. Ici, openstreetmap.fr
    L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
        // Il est toujours bien de laisser le lien vers la source des données
        attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
        minZoom: 1,
        maxZoom: 20
    }).addTo(macarte);
    // Liste des lieux
    var myIconG = L.icon({ // on tient compte de la hauteur pour définir la couleur.
        iconUrl: iconBase + "green-marker.png",
        iconSize: [40, 40],
        iconAnchor: [25, 30],
        popupAnchor: [-3, -76],
    });

    var myIconR = L.icon({
        iconUrl: iconBase + "red-marker.png",
        iconSize: [40, 40],
        iconAnchor: [25, 50],
        popupAnchor: [-3, -76],
    });

        for (place in places) {

            var marker = L.marker([places[place].lat, places[place].lon]).addTo(macarte);
           // L.marker([44.630716, -1.244348].addTo(macarte));
            /* L.marker([44.674036, -1.239100], {icon: myIconG}).addTo(macarte);
            L.marker([44.516241, -1.354705], {icon: myIconR}).addTo(macarte);
            L.marker([44.586821, -1.224787], {icon: myIconR}).addTo(macarte);
            */
            marker.bindPopup(place);


        }


}

window.onload = function () {
// Fonction d'initialisation qui s'exécute lorsque le DOM est chargé
    initMap();
};

