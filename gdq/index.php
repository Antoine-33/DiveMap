<?php
//gestion erreurs
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html>
<head>
	<title>index</title>
</head>
<body background="911401.jpg">

	<center>
	<h1>Saisi d'un nouveau contact</h1>
	</center>

<form action="tableau.php" method="post">
 	<center>
<label >Nom : </label>
<input type="text" name="nom">
<br><br>

<label >Prénom :</label>
<input type="text" name="pren">
<br><br>

<label >Téléphone :</label>
<input type="text" name="tel">
<br><br>

<label >Commentaires :</label><br><br>
<textarea rows="10" cols="40" name="mess"></textarea>
<br><br>

<input type="submit" name="valid" value="SUBMIT">
	</center>
<a href="ind.html">accueil</a>	
<br><br>
</form>
</body>
</html>