<!--page de réinitialisation du mot de passe-->
<?php 
include 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>    
    <form action="" method="post">
        <label for="reset_password">Veuillez renseigner votre adresse mail</label>
        <input type="email" name="reset_password" required/>
        <input type="submit" value="Valider" />
    </form>
</body>
</html>

<?php

if(isset($_POST['reset_password'])){
    $password = uniqid(); /* génère un identifiant unique */
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT); /*password_hash hash l'identifiant contenu dans $password - PASSWORD_DEFAULT est l'algorithme de chiffrement par défaut à utiliser pour le hachage si aucun algorithme n'est fourni */

    $message = "Bonjour, voici votre nouveau mot de passe: $password";
    $headers = 'Content-Type: text/plain; charset="utf-8"'." ";

    if(mail($_POST['reset_password'], 'Mot de passe oublié', $message, $headers)) /* fonction mail (à qui , le sujet, le message, le header que l'on passe) */
    {
        $sql = "UPDATE user SET password = ? WHERE e_mail = ?";
        $stmt = $bdd->prepare($sql);
        $stmt->execute([$hashedPassword, $_POST['reset_password']]);
        echo "Mail envoyé. Pensez à vérifier vos spams";
    }
    else{
        echo "une erreur est survenue";
    }
}


?>

<a href='index.php'>Revenir à la page d'accueil</a>