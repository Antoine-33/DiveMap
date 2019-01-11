
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DiveMap / Ajouter un site</title>
    <link rel="stylesheet" href="CSS/styles.css">
    <style>
        .alert-send {
            padding: 10px;
            font-size: 22px;
            text-align: center;
            background: #5faf60;
            color: #ffffff;
            font-weight: bold;
        }

        .container {
            margin-top: 10%;
        }

        .formulaire {
            margin: auto;
        }

        .form-title {
            padding-bottom: 30px;
            font-size: 30px;
            text-align: center;
        }

        label {
            color: #323232;
            font-style: italic;
            border-bottom: 1px solid #d9d9d9;
        }

        .alert-send {
            padding: 10px;
            font-size: 22px;
            text-align: center;
            background: #5faf60;
            color: #ffffff;
            font-weight: bold;
        }
    </style>

</head>
<body>
<?php include_once 'navbar.php' ?>
<?php
try {
    $bdd = new PDO('mysql:host=127.0.0.1;dbname=DiveMap;charset=utf8', 'utest', '');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

if (isset($_POST['send'])) {
    $placeName = htmlspecialchars($_POST['placeName']);
    $placeLat = htmlspecialchars($_POST['placeLat']);
    $placeLon = htmlspecialchars($_POST['placeLon']);

    $insert_places = $bdd->prepare('INSERT INTO places(placeName, placeLat, placeLon) VALUES(?, ?, ?)');
    $insert_places->execute(array($placeName, $placeLat, $placeLon));
    $message = "<h3 class='alert-send'>Un nouveau site de plongée a été ajouté.</h3>";
    echo $message;
}
?>
<div class="container">
    <div class="col-12">
        <div class="row">
            <div class="col-md-6 formulaire">
                <h2 class="m-3 form-title">Ajouter un nouveau site de plongée</h2>
                <form method="post" action="places.php">
                    <div class="form-group">
                        <label for="places_name">Nom du site :</label>
                        <input type="text" class="form-control" id="places_name" name="placeName"
                               placeholder="Entrez le nom"
                               autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="places_lat">Latitude :</label>

                        <input type="text" class="form-control" id="places_lat" name="placeLat"
                               placeholder="Entrez la latitude"
                               autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="places_lon">Longitude :</label>

                        <input type="text" class="form-control" id="places_lon" name="placeLon"
                               placeholder="Entrez la longitude"
                               autocomplete="off" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="send">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>

