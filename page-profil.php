<!-- page d'édition profil-->
<?php
session_start();
// connexion base de données
include 'connection_bdd.php';
?>



<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>W.E.G - Editeur de profil</title>
</head>

<body>

<?php
    if(isset($_SESSION['id'])) {
       //mise à jour username
      $requser = $bdd->prepare("SELECT * FROM user WHERE id = ?");
      $requser->execute(array($_SESSION['id']));
      $user = $requser->fetch(); /*inutile de faire une boucle while car il n'y a qu'un résultat par id, on peut donc le stocker directement dans une variable*/
      if(isset($_POST['newpseudo']) AND !empty($_POST['newpseudo'])) {
         $newpseudo = htmlspecialchars($_POST['newpseudo']);
         $pseudo = htmlspecialchars($user['username']);
         if($newpseudo != $pseudo){
            $insertpseudo = $bdd->prepare("UPDATE user SET username = ? WHERE id = ?");
            $insertpseudo->execute(array($newpseudo, $_SESSION['id']));
            $msgpseudo = "votre nom d'utilisateur a bien été modifié";
            $user['username'] = $newpseudo;
            $_SESSION['pseudo'] = $newpseudo;
         } else {
            $msgpseudo = "votre nom d'utilisateur est identique";
         }
      }

      //mise à jour adresse mail
      if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND isset($_POST['newmail2']) AND !empty($_POST['newmail2'])) {
         $newmail = htmlspecialchars($_POST['newmail']);
         $newmail2 = htmlspecialchars($_POST['newmail2']);
         $mail = htmlspecialchars($user['e_mail']);
         if($newmail != $mail AND $newmail == $newmail2){
            $insertmail = $bdd->prepare("UPDATE user SET e_mail = ? WHERE id = ?");
            $insertmail->execute(array($newmail, $_SESSION['id']));
            $msgmail = "votre adresse email a bien été modifié";
            $user['e_mail'] = $newmail;
         } else {
            $msgmail = "votre mail existe déjà dans la base de donnée";
         }
      }

      //mise à jour mot de passe
      if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2'])) {
         $mdp1 = sha1($_POST['newmdp1']);
         $mdp2 = sha1($_POST['newmdp2']);
         if($mdp1 == $mdp2) {
            $insertmdp = $bdd->prepare("UPDATE user SET password = ? WHERE id = ?");
            $insertmdp->execute(array($mdp1, $_SESSION['id']));
            $msgmdp = "votre mot de passe a bien été modifié";
         } else {
            $msgmdp = "Vos deux mdp ne correspondent pas !";
         }
      }

      //mise à jour avatar
      if(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name'])) {  /* on vérifie si dans le dossier avatar il y a le name que la personne a entré*/
         $tailleMax = 2097152; /* taille en octets, limité à 2mega octets dans notre cas*/
         $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
         if($_FILES['avatar']['size'] <= $tailleMax) {
            $extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1)); /*strtolower: met le chaîne de caractère en miniscule,
            substr: igorera le 1er (car on a mit 1 à la fin de la lgien de code) caractère de la chaîne, strrchr: renvoie l'extension du fichier avec le .
            qui sera donc ignoré grâce à substr donc ca prendra l'extension qui est après le . */
            if(in_array($extensionUpload, $extensionsValides)) {
                                if(file_exists("membres/avatars/". $_SESSION['id'] . "/" . $_SESSION['avatar']) && isset($_SESSION['avatar'])){
                                    unlink("membres/avatars/". $_SESSION['id'] . "/" . $_SESSION['avatar']);
                                }
               $chemin = "membres/avatars/".$_SESSION['id'].".".$extensionUpload; /* chemin vers lequel sera chargée l'image = l'image s'appèlera du numéro de l'id.l'extension*/
               $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin); /*move_uploaded_file: déplace un fichier téléchargé
               ( [nom du fichier][stockage temporaire du ficher chargé, là où on va le prendre pour le déplacer], sa destination) */
               if($resultat) {
                  $updateavatar = $bdd->prepare('UPDATE user SET image = :image WHERE id = :id');
                  $updateavatar->execute(array(
                     'image' => $_SESSION['id'].".".$extensionUpload,  /* image => nom du fichier */
                     'id' => $_SESSION['id']
                     ));
                     $user['image'] = $user['id'].".".$extensionUpload;
                     $msgavatar = "votre avatar a bien été mis à jour";
               } else {
                  $msgavatar = "Erreur durant l'importation de votre photo de profil";
               }
            } else {
               $msgavatar = "Votre photo de profil doit être au format jpg, jpeg, gif ou png";
            }
         } else {
            $msgavatar = "Votre photo de profil ne doit pas dépasser 2Mo";
         }
      }
?>




    <div class="container-fluid bg-profil">        
        <div class="container" id="container-escape">
            <div class="row flex-column">
                <div class="bloc-page bg-light vh-100 d-flex justify-content-center ">
                    <div class="col-6">                        
                        <h1 class="title-form text-uppercase mb-4">Editer votre profil</h1>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="input-text mb-4">
                                <input type="text" class="form-control" placeholder="Pseudo" name="newpseudo" value="<?php echo $user['username']; ?>">
                            </div>
                            <div class="input-text mb-4">
                                <input type="email" class="form-control" placeholder="Email" name="newmail" value="<?php echo $user['e_mail']; ?>">
                            </div>
                            <div class="input-text mb-4">
                                <input type="email" class="form-control" placeholder="Confirmation de votre email" name="newmail2">
                            </div>
                            <div class="input-text mb-4">
                                <input type=password class="form-control" placeholder="Mot de passe" name="newmdp1">
                            </div>
                            <div class="input-text mb-4">
                                <input type="password" class="form-control" placeholder="Confirmation mot de passe" name="newmdp2">
                            </div>
                            <div class="input-text mb-4">
                                <input type="file" name="avatar" id="avatar">
                            </div>
                            
<!-- affichage de l'avatar-->
<?php
    if(!empty($user['image']))
    {
    ?>
    <img src="membres/avatars/<?php echo $user['image'];?>" width="130" /> <!-- ca va prendre la hauteur automatiquement-->
    <?php
    } else {
    ?>
    <img src="membres/avatars/default-avatar.jpg" width="130" />
    <?php
    }
    ?>

<!-- affichage des messages-->
    <?php if(isset($msgmdp)) { echo $msgmdp; } ?> </br>
    <?php if(isset($msgpseudo)) { echo $msgpseudo; } ?> </br>
    <?php if(isset($msgmail)) { echo $msgmail; } ?> </br>
    <?php if(isset($msgavatar)) { echo $msgavatar; } ?> </br>

                            <a href="enigma.php" class="mb-3 text-left">Revenir à la page énigme</a>
                            <div class="d-flex justify-content-center">
                            <input type="submit" value="Enregistrez vos modifications" class="mt-3 btn-play-header text-light btn-inscription-width">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>








<!-- sécurité page-->         
<?php   
   }
   else {
      header("Location: index.php");
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