<!-- page d'ajout d'énigmes-->
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
    <title>Ajout énigme</title>
</head>

<body>

    <?php

    if(isset($_SESSION['id'])) { 
        if(isset($_POST['ajouter'])) { 
       
        
// traitement du formulaire
    $reponse = $bdd->query("SELECT MAX(id) FROM game");
    $donnees = $reponse->fetch();
    $id_game = intval($donnees[0]);
        // var_dump($id_game);

        $name = htmlspecialchars($_POST['name_enigma']); 
        $duration = intval(htmlspecialchars($_POST['duration_enigma']));
        $content = htmlspecialchars($_POST['content_enigma']);
        $solution = htmlspecialchars($_POST['solution_enigma']);
            if(!empty($_POST['name_enigma']) AND !empty($_POST['duration_enigma']) AND !empty($_POST['content_enigma']) AND !empty($_POST['solution_enigma']) ) {
            $reqenigma = $bdd->prepare("SELECT * FROM enigma WHERE name = ?");
            $reqenigma->execute(array($name));
            $nameexist = $reqenigma->rowCount();
                if($nameexist == 0) {
                $insertmbr = $bdd->prepare("INSERT INTO enigma(name_enigma, id_game, duration_enigma, content_enigma, solution_enigma) VALUES(?, ?, ?, ?, ?)");
                $insertmbr->execute(array($name, $id_game, $duration, $content, $solution));
                } else {
                echo "Ce nom est déjà utilisé";
            }            
        }
    }
?>

    <div class="page-wrap">
        <div class="container-fluid bg-color p-0">
            <div class="container">
                <div class="row">
                    <div id="mySidenav" class="sidenav sidenav-color size-width-menu">
                        <div class="closebtn text-center text-light" onclick="closeNav(x)">&times;</div>
                        <div class="contenu-menu">
                            <ul
                                class="d-flex d-flex flex-sm-column flex-md-column flex-lg-column flex-xl-row align-items-center">

                                <li><a href="page_admin.php" onclick="closeNav(x)" class="title-menu">Retour à la page
                                        admin</a>
                                </li>
                                <li><a href="page_logout.php" onclick="closeNav(x)" class="title-menu">Déconnexion</a>
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

        <div class="container-fluid">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-sm-12 col-md-8 col-lg-6 col-xl-6 px-2">
                        <h1 class="title-form text-uppercase text-center mb-4 mt-5">
                            Ajout d'énigme</h1>

                        <!-- formulaire -->
                        <form action="" method="POST">
                            <div class="form-group">
                                <input type="text" class="form-control h-100" placeholder="Entrer le nom de l'énigme"
                                    name="name_enigma" required>
                            </div>

                            <div class="form-group">
                                <input type="number" class="form-control h-100" placeholder="Entrer la durée du jeu"
                                    name="duration_enigma" required>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" placeholder="Entrer l'enigme/jeux/charades..." rows="6"
                                    name="content_enigma" required></textarea>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" placeholder="Entrer la solution" rows="6"
                                    name="solution_enigma" required></textarea>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn-add-game btn btn-primary mb-4 px-5"
                                    name="ajouter">Enregistrez votre énigme</button>
                            </div>
                        </form>

                        <h1 class="title-form text-uppercase text-center my-3">
                            Récapitulatif</h1>

                        <!-- affichage des énigmes ajoutées -->
                        <?php
   $reponse = $bdd->query("SELECT MAX(id) FROM game");
   $donnees = $reponse->fetch();
   $id_game = intval($donnees[0]);

    $sql="SELECT * FROM enigma WHERE id_game = $id_game ";
    $req = $bdd->query($sql); 
    while ($row=$req->fetch()){
?>
                        <div class="d-flex flex-column ">
                            <label>Enigme : <?php echo $row['name_enigma'] ?> </label>
                            <textarea class='mb-3'><?php echo $row['content_enigma'] ?></textarea>
                            <label>Durée : <?php echo $row['duration_enigma'] ?> </label>
                            <label>Solution : </label>
                            <textarea><?php echo $row['solution_enigma'] ?></textarea>
                            <div class="d-flex justify-content-center">
                            <input type="button" value="Supprimer une énigme"
                                onclick="window.location.href ='delete_enigma.php?id=<?= $row['id'] ?>';"
                                class=" btn btn-primary mb-5 mt-3 ">
                            </div>
                        </div>
                        <?php
        }
?>


                        <div class="button-edit d-flex justify-content-center">
                            <!-- validation du jeu -->
                            <input type="button" value="Validez votre jeu"
                                onclick="window.location.href ='page_admin.php';"
                                class="btn-play-header text-light mb-5 mx-2">
                            <input type="button" value="Annuler" onclick="window.location.href ='page_admin.php';"
                                class="btn-play-header text-light mb-5 mx-2">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!--footer-->
    <footer>
        <div class="container-fluid site-footer ">
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