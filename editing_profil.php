<?php
session_start();
    // connexion base de données
    include 'connection.php';
 
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
            $_SESSION['pseudo'] = $newpseudo;
         } else {
            $msgpseudo = "votre nom d'utilisateur est identique";
         }
      }

      //mise à jour adresse mail
      if(isset($_POST['newmail']) AND !empty($_POST['newmail'])) {
         $newmail = htmlspecialchars($_POST['newmail']);
         $mail = htmlspecialchars($user['e_mail']);
         if($newmail != $mail){
            $insertmail = $bdd->prepare("UPDATE user SET e_mail = ? WHERE id = ?");
            $insertmail->execute(array($newmail, $_SESSION['id']));
            $msgmail = "votre adresse email a bien été modifié";
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
               $chemin = "membres/avatars/".$_SESSION['id'].".".$extensionUpload; /* chemin vers lequel sera chargée l'image = l'image s'appèlera du numéro de l'id.l'extension*/
               $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin); /*move_uploaded_file: déplace un fichier téléchargé
               ( [nom du fichier][stockage temporaire du ficher chargé, là où on va le prendre pour le déplacer], sa destination) */
               if($resultat) {
                  $updateavatar = $bdd->prepare('UPDATE user SET image = :image WHERE id = :id');
                  $updateavatar->execute(array(
                     'image' => $_SESSION['id'].".".$extensionUpload,  /* image => nom du fichier */
                     'id' => $_SESSION['id']
                     ));
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
   <html>
      <head>
         <title>TUTO PHP</title>
         <meta charset="utf-8">
      </head>
      <body>
         <div align="center">
            <h2>Edition de mon profil</h2>
            <div align="left">
               <form method="POST" action="" enctype="multipart/form-data"> <!--enctype: encodage qui permet de charger des fichiers pour l'avatar -->
                  <label>Pseudo :</label>
                  <input type="text" name="newpseudo" placeholder="Pseudo" value="<?php echo $user['username']; ?>" /><br /><br />
                  <label>Mail :</label>
                  <input type="text" name="newmail" placeholder="Mail" value="<?php echo $user['e_mail']; ?>" /><br /><br />
                  <label>Mot de passe :</label>
                  <input type="password" name="newmdp1" placeholder="Mot de passe"/><br /><br />
                  <label>Confirmation - mot de passe :</label>
                  <input type="password" name="newmdp2" placeholder="Confirmation du mot de passe" /><br /><br />
                  <label>Avatar :</label>
                  <input type="file" name="avatar"/><br /><br />
                  <input type="submit" value="Mettre à jour mon profil !" />
               </form></br>

               <!-- affichage de l'avatar-->
               <?php
               if(!empty($user['image']))
               {
               ?>
               <img src="membres/avatars/<?php echo $user['image'];?>" width="150" /> <!-- ca va prendre la hauteur automatiquement-->
               <?php
               } else {
               ?>
               <img src="membres/avatars/default-avatar.jpg" width="150" />
               <?php
               }
               ?>

               <?php if(isset($msgmdp)) { echo $msgmdp; } ?> </br>
               <?php if(isset($msgpseudo)) { echo $msgpseudo; } ?> </br>
               <?php if(isset($msgmail)) { echo $msgmail; } ?>
               <?php if(isset($msgavatar)) { echo $msgavatar; } ?>
            </div>
         </div>
      </body>
   </html>
   <?php   
   }
   else {
      header("Location: index.php");
   }
   ?>

<a href='enigma.php'>Revenir à la page enigme</a>