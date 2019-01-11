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

        .signUp-title {

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
        <button type="submit" class="btn btn-primary" name="signIn" Value="Connexion">Connexion</button>
    </form>
</div>


</body>
</html>