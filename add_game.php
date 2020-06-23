<!-- page d'ajout de jeux-->
<?php
session_start();
// connexion base de données
include 'connection_database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link rel="stylesheet" href="style.css">
    <title>Add Game</title>
</head>
<body class="bg-add-game">
<?php
    // if(isset($_SESSION['id'])) {  
        
?>
<div class="page-wrap">

    <div class="container-fluid bg-color p-0">
        <div class="container">
            <div class="row">
                <div id="mySidenav" class="sidenav sidenav-color size-width-menu">
                    <div class="closebtn text-center text-light" onclick="closeNav(x)">&times;</div>
                    <div class="contenu-menu">
                        <ul class="d-flex d-flex flex-sm-column flex-md-column flex-lg-column flex-xl-row align-items-center">
                            <div class=" w-50">
                                <!-- <li class="d-flex flex-column flex-sm-column flex-md-column flex-lg-column flex-xl-row align-items-center title-menu ">
                                </li> -->
                            </div>
                                <li><a href="page_admin.php" onclick="closeNav(x)"
                                                class="title-menu">Retour à la page admin</a>
                                </li>
                                <li><a href="page_logout.php" onclick="closeNav(x)"
                                                class="title-menu">Déconnexion</a>
                                </li>
                               
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>



<!-- traitement du formulaire-->
<?php
if(isset($_POST['ajouter'])) {
    $name = htmlspecialchars($_POST['name']);
    $number = intval(htmlspecialchars($_POST['number']));
    $duration = intval(htmlspecialchars($_POST['duration']));
    $enigma = htmlspecialchars($_POST['enigma']);
    $solution = intval(htmlspecialchars($_POST['solution']));
        if(!empty($_POST['name']) AND !empty($_POST['number']) AND !empty($_POST['duration']) AND !empty($_POST['enigma']) AND !empty($_POST['solution'])) {
            $reqgame = $bdd->prepare("SELECT * FROM game WHERE name = ?");
            $reqgame->execute(array($name));
            $nameexist = $reqgame->rowCount();
            if($nameexist == 0) {
            $insertmbr = $bdd->prepare("INSERT INTO game(name, duration, number_players, history, solution) VALUES(?, ?, ?, ?, ?)");
            $insertmbr->execute(array($name, $duration, $number, $enigma, $solution));
            } else {
                echo "Ce nom est déjà utilisé";
            }            
        }


        $reqgame->execute(array($name));    
        $nameexist = $reqgame->rowCount(); 
        if($nameexist == 1) {
        $gameinfo = $reqgame->fetch();
            if(isset($_FILES['image']) AND !empty($_FILES['image']['name'])) { 
                $tailleMax = 2097152;
                $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
                if($_FILES['image']['size'] <= $tailleMax) {
                $extensionUpload = strtolower(substr(strrchr($_FILES['image']['name'], '.'), 1));
                    if(in_array($extensionUpload, $extensionsValides)) {
                    $chemin = "membres/jeux/".$gameinfo['id'].".".$extensionUpload; 
                    $resultat = move_uploaded_file($_FILES['image']['tmp_name'], $chemin);
                        if($resultat) {
                        $updateavatar = $bdd->prepare('UPDATE game SET image = :image WHERE id = :id');
                        $updateavatar->execute(array(
                        'image' => $gameinfo['id'].".".$extensionUpload,  /* image => nom du fichier */
                        'id' => $gameinfo['id']
                        ));
                        $gameinfo['image'] = $gameinfo['id'].".".$extensionUpload;
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
    header("Location: page_admin.php");
}
?>



<!-- formulaire-->
            <div class="container-fluid p-0 ">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                                <h1 class="text-dark text-uppercase text-center pb-md-4 pt-md-5 pb-xl-4 pt-xl-5">Créer un nouveau jeu</h1>
                                <div class="d-flex justify-content-center">
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                        <form action="" method="POST" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <input type="text" class="form-control h-100"  placeholder="Entrer le nom du jeu" name ="name" required>
                                            </div>
                                            <div class="form-group">
                                                <label name="img-card-game">Choisissez un fond d'écran </label>
                                                <input type="file" class="form-control h-100" name="image">
                                            </div>
                                            <div class="form-group">
                                                <input type="number" class="form-control h-100" placeholder="Entrer le nombre de joueurs" name="number" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="number" class="form-control h-100" placeholder="Entrer la durée du jeu" name="duration" required>
                                            </div>
                                            <div class="form-group">
                                                <textarea class="form-control" placeholder="Entrer l'enigme/jeux/charades..." rows="6" name="enigma" required></textarea>
                                            </div>
                                            <div class="form-group">
                                                <textarea class="form-control" placeholder="Entrer la solution" rows="6" name="solution" required></textarea>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <button type="submit" class="btn-add-game btn btn-primary mb-4 px-5" name="ajouter">Validez</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>   
                        </div>
                    </div>
                </div>
            </div>
</div>





<footer>
    <div class="container-fluid site-footer ">
        <div class="col-12">
            <div class="contenu-footer text-light d-flex justify-content-around text-center">
            <p class="footer-realisation my-2 py-3">World Escape Game 2020 - Mentions légales</p>
            </div>
        </div>
    </div>
 </footer>




<!-- sécurité page-->         
<?php   
// }
// else {
//     header("Location: index.php");
//     }
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