<!--page d'inscription-->
<h1>Formulaire d'inscription</h1>
<form action="" method="post">
    <p>
    <input type="text" name="last_name" required placeholder="entrez votre nom"/>
    <input type="text" name="first_name" required placeholder="entrez votre prénom"/>
    <input type="email" name="email" required placeholder="entrez votre email"/>
    <input type="email" name="confirmation_email" required placeholder="confirmez votre email"/>
    <input type="text" name="username" required placeholder="entrez votre nom d'utilisateur"/>
    <input type="password" name="password" required placeholder="entrez votre mot de passe"/>
    <input type="password" name="confirmation_password" required placeholder="confirmez votre mot de passe"/>
    <input type="submit" name="inscription" value="inscription" />
    </p>
</form>



<?php 
  include 'connection.php';

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
               $reqmail = $bdd->prepare("SELECT * FROM user WHERE e_mail = ?");
               $reqmail->execute(array($mail));
               $mailexist = $reqmail->rowCount();
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
}

?>







<a href='index.php'>Revenir à la page d'accueil</a>