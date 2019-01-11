<?php
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=DiveMap', 'utest', '');
if (isset($_GET['id']) AND $_GET['id'] > 0) {
    $getId = intval($_GET['id']);
    $requser = $bdd->prepare('SELECT * FROM users WHERE id = ?');
    $requser->execute(array($getId));
    $userInfo = $requser->fetch();
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>DiveMap / Inscription</title>

        <title>Navbar</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
              integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS"
              crossorigin="anonymous">
        <link rel="stylesheet" href="../CSS/styles.css">
        <style>
            .alert-send {
                padding: 10px;
                font-size: 22px;
                text-align: center;
                background: #5faf60;
                color: #ffffff;
                font-weight: bold;
            }

            .alert-error {
                padding: 10px;
                font-size: 22px;
                text-align: center;
                background: #f44336;
                color: #ffffff;
                font-weight: bold;
            }

            .header-profil {
                padding-bottom: 30px;
                margin-bottom: 4%;
            }

            .profil-title {
                padding-top: 10vh;
            }

            .img-profile {
                width: 18%;
                margin: 4%;
            }

            .show-block {
                display: flex;
                justify-content: center;
            }
            .site-frame{
                width: 35%;
                margin: 3%;
                padding: 10px;
                box-shadow: 5px 5px 10px #323232;
            }

            .site-title {
                width: 80%;
                margin: auto;
                padding-bottom: 10px;
                margin-bottom: 3%;
            }

            .img-site {
                width: 80%;
                padding-bottom: 10px;
                overflow: hidden;
                height: 17vh;
            }

        </style>
    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="../index.php">DiveMap</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link" href="deconnexion.php">Déconnexion</a>
                <a class="nav-item nav-link" href="../places.php">Ajouter un site</a>
            </div>
        </div>
    </nav>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
            integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
            integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
            crossorigin="anonymous"></script>
    <?php if (isset($message)) {
        echo '<h3 class="alert-send">' . $message . '</h3>';
    } ?>
    <?php
    if (isset($error)) {
        echo '<h3 class="alert-error">' . $error . '</h3>';
    }
    ?>

    <div class="container text-center">
        <div class="header-profil border-bottom">
            <h3 class="text-center m-auto profil-title">Bienvenue <?php echo $userInfo['username'] ?></h3>
            <img src="../IMAGES/diver.png" class="img-profile"><!-- future avatar-->
            <br>
            <?php if (isset($_SESSION['id']) AND $userInfo['id'] == $_SESSION['id']) { ?>
                <a href="edit_profil.php" class="btn btn-success m-3 edit">Editer mon Profil</a>
                <a href="deconnexion.php" class="btn btn-danger m-3 edit">Déconnexion</a>
            <?php } ?>


        </div>
        <h4 class="m-3">Vos Sites de plongées préférés</h4>
        <div class="show-block">
            <div class="site-frame">
                <h4 class="border-bottom site-title">Hortense</h4>
                <img src="../IMAGES/hortense.jpg" alt="hortense bassin d'arcachon" class="img-site border-bottom">
            </div>
            <div class="site-frame">
                <h4 class="border-bottom site-title">Le Port de la Vigne</h4>
                <img src="../IMAGES/port-vigne.jpg" alt="port de la vigne" class="img-site border-bottom">
            </div>
        </div>
    </div>

    </body>
    </html>

<?php } else {
    header("Location: index.php");
} ?>