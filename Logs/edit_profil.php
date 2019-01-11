<?php
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=DiveMap', 'utest', '');
if (isset($_SESSION['id'])) {
    $requser = $bdd->prepare("SELECT * FROM users WHERE id = ?");
    $requser->execute(array($_SESSION['id']));
    $user = $requser->fetch();
    if (isset($_POST['usernameEdit']) AND !empty($_POST['usernameEdit']) AND $_POST['usernameEdit'] != $user['username']) {
        $usernameEdit = htmlspecialchars($_POST['usernameEdit']);
        $insertUsername = $bdd->prepare("UPDATE users SET username = ? WHERE id = ?");
        $insertUsername->execute(array($usernameEdit, $_SESSION['id']));
        header('Location: profil.php?id=' . $_SESSION['id']);
    }
    if (isset($_POST['editMail']) AND !empty($_POST['editMail']) AND $_POST['editMail'] != $user['mail']) {
        $editMail = htmlspecialchars($_POST['editMail']);
        $insertMail = $bdd->prepare("UPDATE users SET mail = ? WHERE id = ?");
        $insertMail->execute(array($editMail, $_SESSION['id']));
        header('Location: profil.php?id=' . $_SESSION['id']);
    }
    if (isset($_POST['editPassword']) AND !empty($_POST['editPassword']) AND isset($_POST['editPassword2']) AND !empty($_POST['editPassword2'])) {
        $editPassword = sha1($_POST['editPassword']);
        $editPassword2 = sha1($_POST['editPassword2']);
        if ($editPassword == $editPassword2) {
            $insertmdp = $bdd->prepare("UPDATE users SET password = ? WHERE id = ?");
            $insertmdp->execute(array($editPassword, $_SESSION['id']));
            header('Location: profil.php?id=' . $_SESSION['id']);
        } else {
            $error = "Vos deux mdp ne correspondent pas !";
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>DiveMap - Edit Profil</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
              integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS"
              crossorigin="anonymous">
        <link rel="stylesheet" href="../CSS/styles.css">
        <style>
            .container {
                margin-bottom: 5%;
            }

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
                margin-bottom: 3%;
            }

            .profil-title {
                padding-top: 10vh;
            }

            .img-profile {
                width: 18%;
                margin: auto;
                margin-top: 4%;
                margin-bottom: 4%;
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

    <div class="container">
        <div class="header-profil border-bottom text-center">
            <h1 class="text-center m-auto profil-title">Vos informations</h1>
            <img src="../IMAGES/diver.png" class="img-profile"> <!-- future avatar-->
            <br>
        </div>
        <h2 class="edit-title text-center">Modifier vos informations</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="usernameEdit"><b>Username</b></label>
                <input type="text" class="form-control" placeholder="Enter Username" name="usernameEdit"
                       id="usernameEdit"
                       value="<?php
                       echo $user['username'];
                       ?>">
            </div>
            <div class="form-group">
                <label for="editMail">Adresse Mail</label>
                <input type="email" class="form-control" id="editMail" name="editMail" placeholder="Enter email"
                       value="<?php
                       echo $user['mail'];
                       ?>">
            </div>
            <div class="form-group">
                <label for="editPassword">Nouveau mot de passe</label>
                <input type="password" class="form-control" id="editPassword" name="editPassword"
                       placeholder="Nouveau mot de passe">
            </div>
            <div class="form-group">
                <label for="editPassword2">Confirmez votre nouveau Mot de Passe</label>
                <input type="password" class="form-control" id="editPassword2" name="editPassword2"
                       placeholder="Confirmez votre nouveau Mot de Passe">
            </div>
            <button type="submit" class="btn btn-success" name="updateBtn">Submit</button>
        </form>
    </div>

    </body>
    </html>

<?php } else {
    header("Location: connexion.php");
} ?>