<?php
$bdd = new PDO('mysql:host=127.0.0.1;dbname=DiveMap', 'utest', '');
if (isset($_POST['signUp'])) {
    $mail = htmlspecialchars($_POST['mail']);
    $username = htmlspecialchars($_POST['username']);
    $password = sha1($_POST['password']);
    $password_2 = sha1($_POST['password_2']);
    if (!empty($_POST['mail']) AND !empty($_POST['username']) AND !empty($_POST['password']) AND !empty($_POST['password_2'])) {

        $usernamelenght = strlen($username);
        if ($usernamelenght <= 255) {
            if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                $reqmail = $bdd->prepare("SELECT * FROM users WHERE mail = ?");
                $reqmail->execute(array($mail));
                $mailexist = $reqmail->rowCount();
                if ($mailexist == 0) {
                    if ($password == $password_2) {
                        $insertMbr = $bdd->prepare('INSERT INTO users(username, mail, password) VALUES (?, ?, ?)');
                        $insertMbr->execute(array($username, $mail, $password));
                        $message = "Votre compte a bien été créé";
                    } else {
                        $error = "Vos mots de passes ne correspondent pas !";
                    }
                }
                else {
                    $error = "Adresse mail déja utilisée";
                }
            } else {
                $error = "Votre adresse mail n'est pas valide !";
            }

        } else {
            $error = "Votre nom d'utilisateur ne doit pas dépasser 255 caractères !";
        }
    } else {
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
    <h2 class="signUp-title text-center p-3 m-4">Inscription</h2>
    <form method="post" action="">
        <div class="form-group">
            <label for="username"><b>Username</b></label>
            <input type="text" class="form-control" placeholder="Enter Username" name="username" id="username"
                   value="<?php if (isset($username)) {
                       echo $username;
                   } ?>">
        </div>
        <div class="form-group">
            <label for="mail"><b>Mail</b></label>
            <input type="email" class="form-control" placeholder="Enter Mail" name="mail" id="mail"
                   value="<?php if (isset($mail)) {
                       echo $mail;
                   } ?>">
        </div>
        <div class="form-group">
            <label for="password"><b>Password</b></label>
            <input type="password" class="form-control" placeholder="Enter Password" name="password" id="password">
        </div>
        <div class="form-group">
            <label for="password_2"><b>Confirmation Password</b></label>
            <input type="password" class="form-control" placeholder="Enter Password Again" name="password_2"
                   id="password_2">
        </div>
        <button type="submit" class="btn btn-primary" name="signUp">Inscription</button>
    </form>
</div>


</body>
</html>