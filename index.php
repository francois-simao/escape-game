<?php 
session_start();
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
    
<!--page de connexion-->
<h1>Me connecter</h1>
<form action="" method="post">
    <label for="email">Quel est votre adresse email? ?</label>
    <input type="email" name="email" required/>
    <label for="password">Quel est votre mot de passe ?</label>
    <input type="password" name="password" required />
    <input type="submit" value="se connecter" name="connection" />
</form>


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
          header("Location: enigma.php?id=".$_SESSION['id']);
       } else {
          $erreur = "Mauvais mail ou mot de passe !";
       }
    } else {
       $erreur = "Tous les champs doivent être complétés !";
    }
    echo($erreur);
 }






?>










    <a href='reset_password.php'>Mot de passe oublié?</a>

<!--lien d'inscription-->
<h1>Inscription</h1>
<a href='registration.php'>Je crée un compte</a>





</body>
</html>