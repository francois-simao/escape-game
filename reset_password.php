<!--page de réinitialisation du mot de passe-->
<?php 
//connexion à la base de données
include 'connection.php';

// validation recaptcha
require_once 'recaptcha/autoload.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>    
    <form action="" method="post">
        <label for="reset_password">Veuillez renseigner votre adresse mail</label>
        <input type="email" name="reset_password" required/>
        <div class="g-recaptcha" data-sitekey="6LfbQf0UAAAAACVhp2sFMLRt6mEfvyYqPlqoRVIP"></div><br/>
        <input type="submit" value="Valider"  name="valider"/>
    </form>


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



<a href='index.php'>Revenir à la page d'accueil</a>


</body>
</html>