<!--page de connexion administrateur-->
<?php 
session_start();
include 'connection_database.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connection_admin</title>
</head>
<body>
    

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
          header("Location: page_admin.php?id=".$_SESSION['id']);
       } else {
          $erreur = "Mauvais mail ou mot de passe !";
       }
    } else {
       $erreur = "Tous les champs doivent être complétés !";
    }
    echo($erreur);
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