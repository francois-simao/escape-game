<!-- page administrateur-->
<?php
session_start();
// connexion base de données
include 'connection_database.php';
?>

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

<!--traitement du formulaire-->
<?php 

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

    //connexion automatique après enregistrement de l'utilisateur
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
        } 
    } 
}
?>



    <!--formulaire-->
    <header class="create-game">
        <div class="container-fluid bg-opac p-0">
            <div class="h-100 d-flex justify-content-center py-0 py-sm-3 py-md-3 py-lg-3 py-xl-3">

                <div class="bg-light px-5 py-2 text-center ">
                    <h1 class="title-form text-uppercase my-3">Inscription</h1>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="row justify-content-between ">
                            <div class="input-text input-text-name mb-3 mr-2">
                                <input type="text" class="form-control" placeholder="Nom*" name="last_name" required>
                            </div>
                            <div class="input-text input-text-name mb-3">
                                <input type="text" class="form-control" placeholder="Prénom*" name="first_name"
                                    required>
                            </div>
                        </div>
                        <div class="row flex-column">
                            <div class="input-text mb-3">
                                <input type="text" class="form-control" placeholder="Nom d'utilisateur*" name="username"
                                    required>
                            </div>
                            <div class="input-text mb-3">
                                <input type="email" class="form-control" placeholder="Email*" name="email" required>
                            </div>
                            <div class="input-text mb-3">
                                <input type="email" class="form-control" placeholder="Confirmez email*"
                                    name="confirmation_email" required>
                            </div>
                            <div class="input-text mb-3">
                                <input type=password class="form-control" placeholder="Mot de passe*" name="password"
                                    required>
                            </div>
                            <div class="input-text mb-3">
                                <input type="password" class="form-control" placeholder="Confirmez le mot de passe*"
                                    name="confirmation_password" required>
                            </div>
                            <div class="row flex-row-reverse justify-content-around mb-2">
                                <div class="input-text mb-3">
                                    <input type="file" placeholder="Avatar*" name="avatar">
                                </div>


                                <!-- affichage de l'avatar-->
                                <?php
                                if(!empty($userinfo['image'])){
                                ?>
                                    <img src="membres/avatars/<?php echo $userinfo['image'];?>" width="100" />
                                    <!-- ca va prendre la hauteur automatiquement-->
                                <?php
                                } else {
                                ?>
                                <img src="membres/avatars/default-avatar.jpg" width="100" />
                                <?php
                                }
                                ?>
                            </div>

                            <!-- affichage des messages-->
                            <?php if(isset($erreur)) { echo $erreur; } ?> </br>
                            <?php if(isset($msgavatar)) { echo $msgavatar; } ?> </br>

                            <a href="index.php" class="mb-3 text-left">Revenir à la page d'accueil</a>
                            <div class="d-flex justify-content-center">
                                <input type="submit" value="S'inscrire"
                                    class="mb-3 btn-play-header text-light btn-inscription-width" name="inscription">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </header>



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