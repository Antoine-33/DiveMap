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
            }

            .profil-title {
                padding-top: 10vh;
            }

            .img-profile {
                width: 18%;
                margin: 4%;
            }


        </style>
    </head>
    <body>
    <?php include_once 'navbar.php' ?>
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
        <img src="IMAGES/diver.png" class="img-profile">
        <br>
        <?php if ($userInfo['id'] == $_SESSION['id']) {
            ?>
            <a href="#" class="btn btn-success m-3 edit">Editer mon Profil</a>
            <?php
        }
        ?>
        </div>
        <h4 class="m-3">Vos Sites de plongées préférés</h4>
    </div>

    </body>
    </html>

<?php } else {
    echo "<h1 align='center'>Wrong Way !!</h1>";
} ?>