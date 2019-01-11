<?php
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=DiveMap', 'utest', '');
if (isset($_POST['signIn'])) {
    $mailCO = htmlspecialchars($_POST['mailCo']);
    $passwordCO = sha1($_POST['passwordCo']);
    if (!empty($mailCO) AND !empty($passwordCO)) {
        $requser = $bdd->prepare("SELECT * FROM users WHERE mail = ? AND password = ?");
        $requser->execute(array($mailCO, $passwordCO));
        $userexist = $requser->rowCount();
        if ($userexist == 1) {
            $userInfo = $requser->fetch();
            $_SESSION['id'] = $userInfo['id'];
            $_SESSION['username'] = $userInfo['username'];
            $_SESSION['mail'] = $userInfo['mail'];
            header("Location: profil.php?id=".$_SESSION['id']);
        }
        else {
            $error = "Identifiants erronés";
        }
    }
    else {
        $error = "Tous les champs doivent être complétés !";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DiveMap / Inscription</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
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

        .btn-co {
           margin-bottom: 1.5%;
        }

        .question {
            font-style: italic;
            color: #a8a8a8;
            padding: 5px;
            width: 15%;
            text-align: center;
        }

        .signUp-btn {
            font-style: italic;
        }

    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="../index.php">DiveMap</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link" href="connexion.php">Connexion</a>
            <a class="nav-item nav-link" href="../places.php">Ajouter un site</a>
        </div>
    </div>
</nav>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

<?php if (isset($message)) {
    echo '<h3 class="alert-send">' . $message . '</h3>';
} ?>
<?php
if (isset($error)) {
    echo '<h3 class="alert-error">' . $error . '</h3>';
}
?>

<div class="container">
    <h2 class="signUp-title text-center p-3 m-4">Connexion</h2>
    <form method="post" action="">
        <div class="form-group">
            <label for="mailCo"><b>Mail</b></label>
            <input type="email" class="form-control" placeholder="Enter Mail" name="mailCo" id="mailCo">
        </div>
        <div class="form-group">
            <label for="passwordCo"><b>Password</b></label>
            <input type="password" class="form-control" placeholder="Enter Password" name="passwordCo" id="passwordCo">
        </div>
        <button type="submit" class="btn btn-success btn-co" name="signIn" Value="Connexion">Connexion</button>
        <p class="question border-top border-bottom">Pas encore inscrit ?</p>
        <a href="inscription.php" class="nav-link signUp-btn">Inscription</a>
    </form>
</div>


</body>
</html>