<?php

function haut($moment)
{
    $json = file_get_contents("https://www.worldtides.info/api?heights&lat=33.768321&lon=-118.195617&start=".$moment."&key=a815b209-09f1-4538-a71d-79513d3af7c8");
    $parsed_json = json_decode($json);
//$date_jour = $parsed_json->{'status'}->{'features'}->{'date'};
    $height = $parsed_json->{'heights'}[0]->{'height'};
    $heightint = intval($height);
    return $heightint;
}


haut(time());


?>
<br>
<br>
<br>

<?php
$bdd = new PDO('mysql:host=127.0.0.1;dbname=DiveMap', 'utest', '');
$places_count = 1;
while ($places_count <= 4) {
    $places = $bdd->query('SELECT placeName, placeLat, placeLon FROM places WHERE id="' . $places_count . '"');
    while ($data = $places->fetch()) {
        echo $data['placeName'].'<br>';
        echo $data['placeLat'].'<br>';
        echo $data['placeLon'].'<br>';
    }
    $places_count++;
}



$h = time();
$d = 60* 15; // delta de trmps en minutes (60 * nb de secondes)

$haut_prec = haut($h - $d) ;
$haut_pres = haut($h) ;
$haut_suiv = haut($h+ $d) ;


    if( (($haut_prec > $haut_pres) && ($haut_pres > $haut_suiv)) || (($haut_prec < $haut_pres) && ($haut_pres < $haut_suiv)) ) {
        echo "yes";
    }
    else {
        echo "non";
    }

//echo(date('Y/m/d & h:i:s',$t));

?>



