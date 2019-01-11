<?php

function haut($moment ) {
    $json = file_get_contents("https://www.worldtides.info/api?heights&lat=44,516&lon=-1.354705&start=".$moment."&length=1&key=f3b03528-dcd0-4272-adf2-bb03a98cbb2e");
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




