<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>W.E.G - Inscription</title>
</head>

<body>

<?php 
include 'connection_bdd.php';

if(isset($_POST['inscription'])) {
    $name1 = htmlspecialchars($_POST['last_name']);   /* htmlspecialchars convertit les caractères spéciaux en entité HTML pour éviter les injections de code*/
    $name2 = htmlspecialchars($_POST['first_name']);
    $mail = htmlspecialchars($_POST['email']);
    $mail2 = htmlspecialchars($_POST['confirmation_email']);
    $pseudo = htmlspecialchars($_POST['username']);
    $mdp = sha1($_POST['password']);
    $mdp2 = sha1($_POST['confirmation_password']);
   if(!empty($_POST['last_name']) AND !empty($_POST['first_name']) AND !empty($_POST['email']) AND !empty($_POST['confirmation_email']) AND !empty($_POST['username']) AND !empty($_POST['password']) AND !empty($_POST['confirmation_password'])) {
      $pseudolength = strlen($pseudo);  /* strlen calcule la longueur d'une chaîne de caractère*/
      if($pseudolength <= 255) {
         if($mail == $mail2) {
            if(filter_var($mail, FILTER_VALIDATE_EMAIL)) { /* filter_var sert à filter une variable avec un filtre spécifique, ici FILTER_VALIDATE_EMAIL qui valide une adresse mail selon la syntaxe défini par le standard RFC 822*/
               $requser = $bdd->prepare("SELECT * FROM user WHERE e_mail = ?");
               $requser->execute(array($mail));
               $mailexist = $requser->rowCount();
               if($mailexist == 0) { /* si aucun mail ne correspond au mail rentré par l'utilisateur et stocké dans la variable $mailexist*/
                  if($mdp == $mdp2) {
                     $insertmbr = $bdd->prepare("INSERT INTO user(username, password, e_mail, last_name, first_name) VALUES(?, ?, ?, ?, ?)");
                     $insertmbr->execute(array($pseudo, $mdp, $mail, $name1, $name2));
                     // var_dump($_POST);
                     $erreur = "Votre compte a bien été créé !";
                  } else {
                     $erreur = "Vos mots de passes ne correspondent pas !";
                  }
               } else {
                  $erreur = "Adresse mail déjà utilisée !";
               }
            } else {
               $erreur = "Votre adresse mail n'est pas valide !";
            }
         } else {
            $erreur = "Vos adresses mail ne correspondent pas !";
         }
      } else {
         $erreur = "Votre pseudo ne doit pas dépasser 255 caractères !";
      }
   } else {
      $erreur = "Tous les champs doivent être complétés !";
   }
   




      $requser->execute(array($mail));
      $mailexist = $requser->rowCount();      
      if($mailexist == 1) {
      $userinfo = $requser->fetch();
      // var_dump($_FILES);
      if(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name'])) { 
         $tailleMax = 2097152;
         $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
         if($_FILES['avatar']['size'] <= $tailleMax) {
            $extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
            if(in_array($extensionUpload, $extensionsValides)) {
               $chemin = "membres/avatars/".$userinfo['id'].".".$extensionUpload; 
               $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
               if($resultat) {
                  $updateavatar = $bdd->prepare('UPDATE user SET image = :image WHERE id = :id');
                  $updateavatar->execute(array(
                     'image' => $userinfo['id'].".".$extensionUpload,  /* image => nom du fichier */
                     'id' => $userinfo['id']
                     ));
                     $userinfo['image'] = $userinfo['id'].".".$extensionUpload;
                     $msgavatar = "votre avatar a été chargé avec succès";
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
      }
}
?>




    <header class="bg-header-sombre">
        <div class="container-fluid p-0">
            

            <div class="vh-100 d-flex justify-content-center align-items-center bg-opac" id="container-escape">

                <div class="bloc-form bg-light p-5 text-center">
                    <h1 class="title-form text-uppercase mb-4">Créer votre compte</h1>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="row ">
                            <div class="input-text mb-3 mr-2">
                                <input type="text" class="form-control" placeholder="Nom*" name="last_name" required>
                            </div>
                            <div class="input-text mb-3">
                                <input type="text" class="form-control" placeholder="Prénom*" name="first_name" required>
                            </div>
                        </div>
                        <div class="row flex-column">
                            <div class="input-text mb-3">
                                <input type="text" class="form-control" placeholder="Nom d'utilisateur*" name="username" required>
                            </div>
                            <div class="input-text mb-3">
                                <input type="email" class="form-control" placeholder="Email*" name="email" required>
                            </div>
                            <div class="input-text mb-3">
                                <input type="email" class="form-control" placeholder="Confirmez email*" name="confirmation_email" required>
                            </div>
                            <div class="input-text mb-3">
                                <input type=password class="form-control" placeholder="Mot de passe*" name="password" required>
                            </div>
                            <div class="input-text mb-3">
                                <input type="password" class="form-control" placeholder="Confirmez le mot de passe*" name="confirmation_password" required>
                            </div>
                            <div class="input-text mb-3">
                                <input type="file" class="form-control" placeholder="Avatar*" name="avatar">
                            </div>
                        
                            
<!-- affichage de l'avatar-->
<?php
if(!empty($userinfo['image'])){
?>
<img src="membres/avatars/<?php echo $userinfo['image'];?>" width="100" /> <!-- ca va prendre la hauteur automatiquement-->
<?php
} else {
?>
<img src="membres/avatars/default-avatar.jpg" width="100" />
<?php
}
?>

<!-- affichage des messages-->
<?php if(isset($erreur)) { echo $erreur; } ?> </br>
<?php if(isset($msgavatar)) { echo $msgavatar; } ?> </br>

                            <a href="index.php" class="mb-3 text-left">Revenir à la page d'accueil</a>
                            <div class="d-flex justify-content-center">
                                <input type="submit" value="S'inscrire" class="btn-play-header text-light btn-inscription-width" name="inscription">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </header>




</body>

</html>