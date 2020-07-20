<!--page de connexion utilisateurs-->
<?php 
session_start();
// connexion base de données
include 'connection_database.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>W.E.G - Connexion</title>
</head>

<body>
    <!--formulaire-->
    <header class="bg-header">
        <div class="container-fluid p-0">
            <!-- <div class="container "> -->
            <div class="vh-100 d-flex justify-content-center align-items-center bg-opac">
                <div class="bloc-form bg-light p-5 text-center">
                    <h2 class="title-form text-uppercase mb-4">Se connecter</h2>
                    <form action="" method="POST">
                        <div class="row flex-column">
                            <div class="input-text mb-4">
                                <input type="email" class="form-control" placeholder="Email" name="email" required>
                            </div>
                            <div class="input-text mb-2">
                                <input type="password" class="form-control" placeholder="Mot de passe" name="password"
                                    required>
                            </div>
                            <a href="forgot_password.php" class="mb-3 text-left">Mot de passe oublié ?</a>
                            <div class="d-flex justify-content-center">
                                <input type="submit" value="Validez"
                                    class="btn-play-header text-light btn-connexion-width" name="connection">
                            </div>
                        </div>
                    </form>
                    <p class="mt-3 mb-0 ">Pas encore inscrit(e) ? <a href="registration.php">Inscrivez-vous
                            maintenant</a> <br>ou<br> </p>
                    <a href="index.php" class="mb-3 ">Revenir à la page d'accueil</a>
                </div>
            </div>
        </div>
    </header>

<!--traitement du formulaire-->
<?php
if(isset($_POST['connection'])) {
    $mailconnect = htmlspecialchars($_POST['email']);
    $mdpconnect = sha1($_POST['password']);
    if(!empty($mailconnect) AND !empty($mdpconnect)) {
       $requser = $bdd->prepare("SELECT * FROM user WHERE e_mail = ? AND password = ?");
       $requser->execute(array($mailconnect, $mdpconnect));
       $userexist = $requser->rowCount(); /*row=rangée, count=compte -> rowCount est une fonction qui permet de compter le nombre de rangées donc en l'occurence 2 dans notre requête pour s'assurer que les 2 rangées appelées, correspondent */
       if($userexist == 1) {
          $userinfo = $requser->fetch();
          $_SESSION['id'] = $userinfo['id'];
          $_SESSION['pseudo'] = $userinfo['username'];
          $_SESSION['mail'] = $userinfo['e_mail'];
          $_SESSION['avatar'] = $userinfo['image'];
          header("Location: games.php?id=".$_SESSION['id']);
        } else {
          $erreur = "Mauvais mail ou mot de passe !";
        }
    } else {
       $erreur = "Tous les champs doivent être complétés !";
    }
    echo($erreur);
}
?>

    <!--scripts-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
        crossorigin="anonymous"></script>
</body>

</html>