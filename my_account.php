<!-- page d'édition profil-->
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
    <title>W.E.G - Editeur de profil</title>
</head>

<body>
<!-- traitement du formulaire-->
<?php
if(isset($_SESSION['id'])) {
    //mise à jour username
    $msgerror = array();
    $msgsucces = "";
    $requser = $bdd->prepare("SELECT * FROM user WHERE id = ?");
    $requser->execute(array($_SESSION['id']));
    $user = $requser->fetch(); /*inutile de faire une boucle while car il n'y a qu'un résultat par id, on peut donc le stocker directement dans une variable*/
    if(isset($_POST['newpseudo']) AND !empty($_POST['newpseudo'])) {
        $newpseudo = htmlspecialchars($_POST['newpseudo']);
        $pseudo = htmlspecialchars($user['username']);
        if($newpseudo != $pseudo){
            $insertpseudo = $bdd->prepare("UPDATE user SET username = ? WHERE id = ?");
            $insertpseudo->execute(array($newpseudo, $_SESSION['id']));
            $msgerror[] = "vos modifications ont été effectuées avec succès";
            $user['username'] = $newpseudo;
            $_SESSION['pseudo'] = $newpseudo;
        } else {
        $msgpseudo = "votre nom d'utilisateur est identique";
        $msgerror[] = "votre nom d'utilisateur est identique";
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
            $msgerror[] = "vos modifications ont été effectuées avec succès";
            $user['e_mail'] = $newmail;
        } else {
        $msgmail = "votre mail existe déjà dans la base de donnée";
        $msgerror[] = "votre mail existe déjà dans la base de données";
        }
    }

    //mise à jour mot de passe
    if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2'])) {
        $mdp1 = sha1($_POST['newmdp1']);
        $mdp2 = sha1($_POST['newmdp2']);
        if($mdp1 == $mdp2) {
            $insertmdp = $bdd->prepare("UPDATE user SET password = ? WHERE id = ?");
            $insertmdp->execute(array($mdp1, $_SESSION['id']));
            $msgerror[] = "vos modifications ont été effectuées avec succès";
        } else {
        $msgmdp = "Vos deux mdp ne correspondent pas !";
        $msgerror[] = "vos deux mot de passe ne correspondent pas !";
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
                    $_SESSION['avatar'] = $user['image'];
                    $msgerror[] = "vos modifications ont été effectuées avec succès";
                } else {
                $msgavatar = "Erreur durant l'importation de votre photo de profil";
                $msgerror[] = "Erreur durant l'importation de votre photo de profil";
                }
            } else {
            $msgavatar = "Votre photo de profil doit être au format jpg, jpeg, gif ou png";
            $msgerror[] = "Votre photo de profil doit être au format jpg, jpeg, gif ou png";
            }
        } else {
        $msgavatar = "Votre photo de profil ne doit pas dépasser 2Mo";
        $msgerror[] = "Votre photo de profil ne doit pas dépasser 2Mo";
        }
    }
?>


    <div class="page-wrap">
        <div class="container-fluid create-game p-0">
            <div class="container">
                <div class="row flex-column">
                    <div class="bloc-page bg-light d-flex justify-content-center ">
                        <div class="col-12 col-sm-12 col-md-8 col-lg-6 col-xl-6">
                            <h1 class="title-form text-uppercase mb-4 text-center mt-4">Editer votre profil</h1>

                            <div class="d-flex justify-content-center mb-4">
                                <!-- affichage de l'avatar-->
                                <?php
                                if(!empty($user['image']))
                                {
                                ?>
                                <div class="img-avatar-ronde-account-01">
                                    <img src="membres/avatars/<?php echo $user['image'];?>" width="130"
                                        class="img-fluid img-avatar" /> <!-- ca va prendre la hauteur automatiquement-->
                                </div>
                                <?php
                                } else {
                                ?>
                                <div class="img-avatar-ronde-account-02">
                                    <img src="membres/avatars/default-avatar.jpg" width="130"
                                        class="img-fluid img-avatar" />
                                </div>
                                <?php
                                }
                                ?>
                            </div>
                            
                             <!-- formulaire-->
                            <form id="myForm" action="" method="POST" enctype="multipart/form-data">
                                <div class="input-text mb-4">
                                    <input type="text" class="form-control" placeholder="Pseudo" name="newpseudo"
                                        value="<?php echo $user['username']; ?>">
                                </div>
                                <div class="input-text mb-4">
                                    <input type="email" class="form-control" placeholder="Email" name="newmail"
                                        value="<?php echo $user['e_mail']; ?>">
                                </div>
                                <div class="input-text mb-4">
                                    <input type="email" class="form-control" placeholder="Confirmation de votre email"
                                        name="newmail2">
                                </div>
                                <div class="input-text mb-4">
                                    <input type=password class="form-control" placeholder="Mot de passe" name="newmdp1">
                                </div>
                                <div class="input-text mb-4">
                                    <input type="password" class="form-control" placeholder="Confirmation mot de passe"
                                        name="newmdp2">
                                </div>
                                <div class="input-text mb-4">
                                    <p>Veuillez choisir votre avatar :</p>
                                    <input type="file" name="avatar" id="avatar">
                                </div>



                                <!-- affichage des messages-->
                                <div class="d-flex justify-content-center">
                                    <button type="submit"
                                        class="mb-4 mt-3 btn-play-header text-light btn-inscription-width">Enregistrez
                                        vos modifications</button>
                                </div>
                            </form>

                            <!-- suppression compte-->
                            <div class="d-flex justify-content-around mt-2 mb-3 text-center">
                                <a href="delete_account.php" class=" text-danger" data-toggle="modal"
                                    data-target="#modal_confirm_delete">Supprimer mon compte</a>
                                <a href="games.php">Revenir à la page des jeux</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal pour afficher un message de confirmation de la suppression du compte-->
    <div class="modal fade" id="modal_confirm_delete" tabindex="-1" role="dialog"
        aria-labelledby="modal_confirm_deleteTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_confirm_deleteLongTitle">Confirmez la suppression</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Voulez-vous supprimez votre compte?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="button" onclick="window.location.href ='delete_account.php';"
                        class="btn btn-primary">Confirmez la suppression</button>
                </div>
            </div>
        </div>
    </div>


    <!-- footer -->
    <footer>
        <div class="container-fluid site-footer">
            <div class="contenu-footer text-light d-flex justify-content-around text-center">
                <p class="footer-realisation my-2 py-3">World Escape Game 2020 - Mentions légales</p>

            </div>
        </div>
    </footer>


    <!-- Modal d'affichage messages d'erreur-->
    <div class="modal fade" id="Modal_messageCenter" tabindex="-1" role="dialog"
        aria-labelledby="Modal_messageCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="Modal_messageLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php if (count($msgerror) == 0 ) {
                            echo "vos modifications ont été effectuées avec succès";
                        } else { ?>
                        <p class="text-success"> <?php echo implode($msgerror, "<br>");?> </p>
                        <?php
                        }?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>




<!-- sécurité page-->
<?php   
} else {
    header("Location: index.php");
}
?>



    <!--scripts-->
    <script src="script.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
        crossorigin="anonymous"></script>

    <!--affichage modal -->
    <?php if( isset($msgavatar) || isset($msgmail) || isset($msgmdp) || isset($msgpseudo) ){ ?>
    <script>$("#Modal_messageCenter").modal('show');</script>
    <?php } ?>

    
</body>

</html>