<!-- page admin-->
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link rel="stylesheet" href="style.css">
    <title>W.E.G - Admin</title>
</head>

<body>
<?php
    if(isset($_SESSION['id'])) { 
        $sql="SELECT * FROM game ";
        $req = $bdd->query($sql);         
?>
    <div class="page-wrap">

<!--header -->
        <div class="container-fluid bg-color p-0 mb-lg-5 mb-xl-5">
            <div class="container">
                <div class="row">
                    <div id="mySidenav" class="sidenav sidenav-color size-width-menu">
                        <div class="closebtn text-center text-light" onclick="closeNav(x)">&times;</div>
                        <div class="contenu-menu-admin">
                            <ul class="d-flex d-flex flex-sm-column flex-md-column flex-lg-column flex-xl-row align-items-center">
                                
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

<!-- bouton pour ajouter un jeu-->
        <div class="container-fluid p-0 mb-4">
            <div class="d-flex justify-content-center">
                <input type="button" value="Ajouter un nouveau jeu" onclick="window.location.href ='add_game.php';"
                    class="text-light btn-play-header button-admin-creation my-3 mt-5 px-3">
            </div>

<!-- affichage des jeux existants -->
            <div class="container">
                <div class="row row-cols-1 row-cols-md-3">
                    <?php
                    while ($row=$req->fetch()){
                    ?>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-4 p-sm-0 ">
                        <div class="post-admin mx-2 mb-5">
                            <?php if($row['image'] == NULL) { ?>
                            <div class="img-admin-01">
                                <img src="membres/jeux/default-game.jpg" alt="" class="img-admin-02 w-100">
                            </div>
                            <?php } else {?>
                            <div class="img-admin-01">
                                <img src="membres/jeux/<?php echo ($row['image']);?>" alt="" class="img-admin-02 w-100">
                            </div>
                            <?php } ?>

                            <div class="post-info p-2">
                                <h4 class="title-game-slider text-center my-2 text-uppercase"><?php echo $row['name'] ?></h4>
                                <div class="d-flex flex-column align-items-center">
                                    <input type="button" value="Modifier" onclick="window.location.href ='edit_game.php?id=<?= $row['id'] ?>';" class="btn-play-header button-admin-slide text-light my-3">
                                    <input type="button" value="Supprimer" class="btn-play-header button-admin-slide text-light my-3" data-toggle="modal" data-target="#exampleModalCenter<?php echo $row['id']; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                    
                </div>
            </div>
        </div>

    </div>


<!-- Modal de confirmation de suppression du jeu-->
<?php
$req = $bdd->query($sql);
while ($row=$req->fetch()){
?>
<div class="modal fade" id="exampleModalCenter<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Confirmez la suppression</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Voulez-vous supprimez le jeu <?php echo $row['name']; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button type="button" onclick="window.location.href ='delete_game.php?id=<?php echo $row['id']; ?>';" class="btn btn-primary">Confirmez la suppression</button>
      </div>
    </div>
  </div>
</div>
<?php } ?>


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
            if (y.matches) {
                document.getElementById("mySidenav").style.width = "100%";
            }
        }

        function closeNav(x) {
            if (x.matches) {
                document.getElementById("mySidenav").style.width = "0"; 
            }
        }

        var y = window.matchMedia("(max-width: 1199.98px)")
        openNav(y)
        y.addListener(openNav)
        var x = window.matchMedia("(max-width: 1199.98px)")
        closeNav(x)
        x.addListener(closeNav)
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