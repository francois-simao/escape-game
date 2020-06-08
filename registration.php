<!--page d'inscription-->
<h1>Formulaire d'inscription</h1>
<form action="" method="post" enctype="multipart/form-data">
    <p>
    <input type="text" name="last_name" required placeholder="entrez votre nom"/>
    <input type="text" name="first_name" required placeholder="entrez votre prénom"/>
    <input type="email" name="email" required placeholder="entrez votre email"/>
    <input type="email" name="confirmation_email" required placeholder="confirmez votre email"/>
    <input type="text" name="username" required placeholder="entrez votre nom d'utilisateur"/>
    <input type="password" name="password" required placeholder="entrez votre mot de passe"/>
    <input type="password" name="confirmation_password" required placeholder="confirmez votre mot de passe"/>
    <label>Avatar :</label>
    <input type="file" name="avatar"/><br /><br />
    <input type="submit" name="inscription" value="inscription" />
    </p>
</form>



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
   echo($erreur);




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
      }


}

?>

<?php
if(!empty($userinfo['image'])){
?>
<img src="membres/avatars/<?php echo $userinfo['image'];?>" width="150" /> <!-- ca va prendre la hauteur automatiquement-->
<?php
} else {
?>
<img src="membres/avatars/default-avatar.jpg" width="150" />
<?php
}
?>





<a href='index.php'>Revenir à la page d'accueil</a>