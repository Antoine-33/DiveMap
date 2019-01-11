<!DOCTYPE html>
<html>
<body>

<h2>Get data as JSON from a PHP file on the server.</h2>

<p id="demo"></p>
<?php
$json = file_get_contents("https://www.worldtides.info/api?heights&lat=44.674036&lon=-1.239100&start=1412272800&length=1&key=f3b03528-dcd0-4272-adf2-bb03a98cbb2e");

$parsed_json = json_decode($json);
//$date_jour = $parsed_json->{'status'}->{'features'}->{'date'};
$height = $parsed_json->{'heights'}[0]->{'height'};
$heightint=intval($height);
if ($heightint<1)
	echo $height;
else 	
?>

</body>
</html>
