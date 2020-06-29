<!-- page de modifications de jeux-->
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
    <link rel="stylesheet" href="style.css">
    <title>Modifier un jeu</title>
</head>
<body class="bg-color-body">

<?php
if(isset($_SESSION['id'])) {  

    if(isset($_POST['enigmaIds']) && count($_POST['enigmaIds']) > 0){
        // $i = 0;
        // while ($i < count($_POST['enigmaIds'])) {
        //     $enigmaId = $_POST['enigmaIds'][$i];
        //     $i++;
        // }
        foreach($_POST['enigmaIds'] as $enigmaId){
            if (!empty($_POST['new_name_enigma'][$enigmaId]) AND !empty($_POST['new_content_enigma'][$enigmaId]) AND !empty($_POST['new_duration_enigma'][$enigmaId]) AND !empty($_POST['new_solution_enigma'][$enigmaId]) ) {	                    
                $update = $bdd->prepare("UPDATE enigma SET name_enigma = ?, id_game = ?, duration_enigma = ?, content_enigma = ?, solution_enigma = ?  WHERE id = ? ");
                $update->execute(array($_POST['new_name_enigma'][$enigmaId], $_GET['id'], $_POST['new_duration_enigma'][$enigmaId], $_POST['new_content_enigma'][$enigmaId], $_POST['new_solution_enigma'][$enigmaId], $enigmaId ));                
            }
        }
    }
?>
<!--header-->
<div class="page-wrap">
        <div class="container-fluid bg-color p-0 mb-lg-5 mb-xl-5">
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
                    <div id="ecart-menu">
                        <div class="icon-menu ml-3 text-light" onclick="openNav(y)">&#9776;</div>
                    </div>
                </div>
            </div>
        </div>


<!-- formulaire -->
        <div class="container">
            <div class="row flex-column">
                <div class="d-flex justify-content-center ">
                    <div class="col-12 col-sm-12 col-md-8 col-lg-6 col-xl-6 px-2">
                        <h1 class="title-form text-uppercase text-center mt-4 mt-sm-5 mt-md-5 mt-lg-0 mt-xl-0 mb-0 mb-sm-0 mb-md-0 mb-lg-4 mb-xl-4">Modifications du jeu</h1>
                        <?php                                
                        $sql="SELECT *, enigma.id AS idEnigma FROM game INNER JOIN enigma ON enigma.id_game = game.id WHERE game.id=".$_GET['id']." ";
                        $req = $bdd->query($sql);
                        ?>

                        <form action='' method='post' enctype="multipart/form-data" class='d-flex flex-column mt-5 mt-sm-5 mt-md-5 mt-lg-0 mt-xl-0'>

                        <?php 
                        $index = 0;
                        while ($row=$req->fetch()){
                        $index++ ;
                        ?>

<!-- affichage détails jeu-->
                        <?php if ($index == 1) { ?>
                            <div class='d-flex '>
                                <input type='text' class='border text-center mb-3 w-100 text-uppercase' name ='new_name' value="<?php echo $row['name'] ?>">
                            </div>
                            <div class='d-flex justify-content-between mb-3'>
                                <label for='time_game' class='m-0'>Nombre de joueurs : </label>
                                <input type='text' name="new_number_players" value="<?php echo $row['number_players'] ?>">
                                <label for='time_game' class='m-0'>Durée du jeu : </label>
                                <input type='text' name="new_duration" value="<?php echo $row['duration'] ?>">
                            </div>
                            <label for='new_history' class=''>Histoire : </label>
                            <textarea rows='10' class='mb-4' name='new_history'><?php echo $row['history'] ?> </textarea>


                            <?php if($row['image'] == NULL) { ?>
                            <div class="img-admin-01">
                                <img src="membres/jeux/default-game.jpg" alt="" class="img-admin-02 w-100">
                            </div>
                            <?php } else {?>
                            <div class="img-admin-01">
                                <img src="membres/jeux/<?php echo ($row['image']);?>" alt="" class="img-admin-02 w-100">
                            </div>
                            <?php } ?>
                            <div class="input-text mb-4">
                            <p>Veuillez choisir votre image de fond :</p>
                                <input type="file" name="new_image" id="avatar">
                            </div>
                                        <?php } ?>

<!-- affichage des énigmes du jeu -->
                        <input type="hidden" name="enigmaIds[]" value="<?php echo $row['idEnigma'] ?>">
                        <div class='d-flex flex-column'>
                            <label for='new_history' class=''>Enigme : </label>
                            <input type='text' name="new_name_enigma[<?php echo $row['idEnigma'] ?>]" value="<?php echo $row['name_enigma'] ?>">
                            <textarea name='new_content_enigma[<?php echo $row['idEnigma'] ?>]' placeholder='Enigme' class='mb-3'><?php echo $row['content_enigma'] ?></textarea>
                            <label for='new_history' class=''>Durée : </label>
                            <input type='text' name="new_duration_enigma[<?php echo $row['idEnigma'] ?>]" value="<?php echo $row['duration_enigma'] ?>">
                            <label for='new_history' class=''>Solution : </label>
                            <textarea name='new_solution_enigma[<?php echo $row['idEnigma'] ?>]' placeholder='Solution énigme' class='mb-5'><?php echo $row['solution_enigma'] ?></textarea>
                        </div>
                                    
                        <?php } ?>    

                        <div class='button-edit d-flex justify-content-between d-flex mb-5'>
                        <a href='add_enigma.php' class='btn-play-header text-light text-center mb-3 mb-sm-3 mb-md-0 mb-lg-0 mb-xl-0'>Ajouter une énigme</a>
                        <input type='submit' class='btn-play-header  text-light text-center' value='Valider'>
                        </div>
                        </form>

                    </div>     
                </div>
            </div>
        </div>
</div>

<!-- traitement formulaire -->
<?php
if (isset($_POST) AND !empty($_POST) ){
    if (!empty($_POST['new_name']) AND !empty($_POST['new_number_players']) AND !empty($_POST['new_duration']) AND !empty($_POST['new_history']) ) {	                            
    $update = $bdd->prepare("UPDATE game SET name = ?, duration = ?, number_players = ?, history = ?  WHERE id=".$_GET['id']." ");
    $update->execute(array($_POST['new_name'], $_POST['new_number_players'], $_POST['new_duration'], $_POST['new_history'] ));            
     }


    //mise à jour image
    $reqgame = $bdd->prepare("SELECT * FROM game WHERE id=".$_GET['id']."");
    $reqgame->execute(array($_GET['id']));
    $game = $reqgame->fetch(); 

      if(isset($_FILES['new_image']) AND !empty($_FILES['new_image']['name'])) {  
         $tailleMax = 2097152; 
         $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
         if($_FILES['new_image']['size'] <= $tailleMax) {
            $extensionUpload = strtolower(substr(strrchr($_FILES['new_image']['name'], '.'), 1)); 
            if(in_array($extensionUpload, $extensionsValides)) {
                                if(file_exists("membres/jeux/". $game['id'] . "/" . $game['image']) && isset($game['image'])){
                                    unlink("membres/jeux/". $game['id'] . "/" . $game['image']);
                                }
               $chemin = "membres/jeux/".$game['id'].".".$extensionUpload; 
               $resultat = move_uploaded_file($_FILES['new_image']['tmp_name'], $chemin); 
               if($resultat) {
                  $updateavatar = $bdd->prepare("UPDATE game SET image = :image WHERE id=".$_GET['id']."");
                  $updateavatar->execute(array(
                     'image' => $game['id'].".".$extensionUpload,  
                     ));
                     $game['image'] = $game['id'].".".$extensionUpload;
                     $row['image'] = $game['image'];
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

    
}
?> 

<!--footer-->
    <footer>
        <div class="container-fluid site-footer">
            <div class="contenu-footer text-light d-flex justify-content-around text-center">
                <p class="footer-realisation my-2 py-3">World Escape Game 2020 - Mentions légales</p>

            </div>
        </div>
    </footer>

<!-- sécurité page-->         
<?php   
}
else {
    header("Location: index.php");
    }
    ?>


<script>
    function openNav(y) {
            if (y.matches) { //openNav est le nom donné au onclick qui, lorsqu'on clique sur le menu, il s'ouvrira grâce au getElementById qui récupère l'id "mySidenav" dans la div principale
                document.getElementById("mySidenav").style.width = "100%"; //style.width permet de donner une largeur au menu lorsque celui-ci est ouvert (mettre en 100% pour qu'il puisse prendre toute la page)
                // document.getElementById("ecart-menu").style.marginLeft = "50%"; // permet de faire décaler le texte et l'icon du menu
            }
        }

        function closeNav(x) {
            if (x.matches) {//closeNav est le nom donné au onclick pour fermer le menu (même système que celui du openNav)
                document.getElementById("mySidenav").style.width = "0"; // mettre 0 pour qu'il ne soit pas visible
                // document.getElementById("ecart-menu").style.marginLeft = "0";
            }
        }

        var y = window.matchMedia("(max-width: 1199.98px)")
        openNav(y) // Call listener function at run time
        y.addListener(openNav) // Attach listener function on state changes
        var x = window.matchMedia("(max-width: 1199.98px)")
        closeNav(x) // Call listener function at run time
        x.addListener(closeNav) // Attach listener function on state changes
</script> 

<!--scripts-->
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