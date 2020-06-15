<!--page de réinitialisation du mot de passe-->
<?php 
//connexion à la base de données
include 'connection_database.php';
// validation recaptcha
require_once 'recaptcha/autoload.php';
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>W.E.G - Mot de passe oublié</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>

<!--formulaire-->
    <div class="container-fluid p-0 bg-header-sombre">

        <div class="d-flex justify-content-center align-items-center vh-100 bg-opac " id="container-escape">
            <div class="bloc-form bg-light p-5 ">
                <h1>Réinitialiser mot de passe ?</h1>
                <p>Vous avez oublié votre mot de passe ?<br> Veuillez entrer votre adresse e-mail, vous
                    receverai un nouveau votre mot de passe.</p>

                <form action="" method="POST">
                    <div class="input-text mb-4">
                        <input type="email" class="form-control" placeholder="Email" name="reset_password" required>
                        <div class="g-recaptcha mt-3" data-sitekey="6LfbQf0UAAAAACVhp2sFMLRt6mEfvyYqPlqoRVIP"></div>
                        <input type="submit" value="Envoyer" class="mt-3" name="valider">
                    </div>
                </form>
                <a href="index.php" class="mb-3 text-left">Revenir à la page d'accueil</a>
            </div>
        </div>
    </div>

<!--traitement du formulaire-->
<?php
if(isset($_POST['valider'])) {
    if(isset($_POST['g-recaptcha-response'])){
    $recaptcha = new \ReCaptcha\ReCaptcha('6LfbQf0UAAAAADc4ysxuTUD9sOXc15VY6zI--4_q');
    $resp = $recaptcha->verify($_POST['g-recaptcha-response']);
        if ($resp->isSuccess()) {
            if(isset($_POST['reset_password'])){
            $password = uniqid(); /* génère un identifiant unique */
            $hashedPassword = sha1($password); /*password_hash hash l'identifiant contenu dans $password - PASSWORD_DEFAULT est l'algorithme de chiffrement par défaut à utiliser pour le hachage si aucun algorithme n'est fourni */

            $message = "Bonjour, voici votre nouveau mot de passe: $password";
            $headers = 'Content-Type: text/plain; charset="utf-8"'." ";

                if(mail($_POST['reset_password'], 'Mot de passe oublié', $message, $headers)) { /* fonction mail (à qui , le sujet, le message, le header que l'on passe) */               
                $sql = "UPDATE user SET password = ? WHERE e_mail = ?";
                $stmt = $bdd->prepare($sql);
                $stmt->execute([$hashedPassword, $_POST['reset_password']]);
                echo "Mail envoyé";
                }
            }
        }
        else{
            $errors = $resp->getErrorCodes();
            echo "captcha invalide";
            }
    }
}
?>











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