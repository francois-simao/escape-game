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



        <div class="container">
            <div class="row flex-column">
                <div class="d-flex justify-content-center ">
                    <div class="col-12 col-sm-12 col-md-8 col-lg-6 col-xl-6 px-2">
                        <h1 class="title-form text-uppercase text-center mt-4 mt-sm-5 mt-md-5 mt-lg-0 mt-xl-0 mb-0 mb-sm-0 mb-md-0 mb-lg-4 mb-xl-4">Modifications du jeu</h1>
                        <?php
                            // if(isset($_SESSION['id'])) {  
                                
                                $sql="SELECT * FROM game WHERE id=".$_GET['id']." ";
                                $req = $bdd->query($sql);



                                    echo "<form action='' method='post' class='d-flex flex-column mt-5 mt-sm-5 mt-md-5 mt-lg-0 mt-xl-0'>";
                                    while ($row=$req->fetch()){

                                    echo "<div class='d-flex '>";
                                    echo $row['id']." <input type='text' class='border text-center mb-3 w-100 text-uppercase' name ='new_name' value='".$row['name']."'>";
                                    echo "</div>";

                                    echo"<div class='d-flex justify-content-between mb-3'>";
                                        echo "<input type='number' placeholder='Nombre de joueurs'>";
                                        echo "<label for='time_game' class='m-0'>Durée du jeu : </label>";
                                        echo "<input type='time' placeholder='Durée du jeu' name='time_game' >";
                                    echo "</div>";

                                    echo "<label for='new_history' class=''>Histoire : </label>";
                                    echo " <textarea rows='10' class='mb-4' name='new_history'> ".$row['history']." </textarea>";

                                    echo "<div class='d-flex flex-column'>";
                                    echo "<textarea name='' placeholder='Enigme 1' class='mb-3'></textarea>";
                                    echo "<textarea name='' placeholder='Solution énigme 1' class='mb-5'></textarea>";

                                    echo "<textarea name='' placeholder='Enigme 2' class='mb-3'></textarea>";
                                    echo "<textarea name='' placeholder='Solution énigme 2' class='mb-5'></textarea>";
                                    echo "</div>";
                                    
                                    }

                                    echo"<div class='button-edit d-flex justify-content-between d-flex mb-5'>";
                                    echo "<a href='#' class='btn-play-header text-light text-center mb-3 mb-sm-3 mb-md-0 mb-lg-0 mb-xl-0'>Ajouter une énigme</a>";
                                        echo "<input type='submit' class='btn-play-header  text-light text-center' value='Valider'>";
                                    echo "</div>";
                            echo "</form>";

                                if (isset($_POST) AND !empty($_POST) ){
                                    if (!empty($_POST['new_name']) AND !empty($_POST['new_history']) ) {	
                            
                                        $update = $bdd->prepare("UPDATE game SET name = ?, history = ?  WHERE id=".$_GET['id']." ");
                                        $update->execute(array($_POST['new_name'], $_POST['new_history'] ));
                                        // header("Location: page_admin.php");
                                        }
                                    }
                        ?> 
                    </div>     
                </div>
            </div>
        </div>

     
</div>


    <footer>
        <div class="container-fluid site-footer">
            <div class="contenu-footer text-light d-flex justify-content-around text-center">
                <p class="footer-realisation my-2 py-3">World Escape Game 2020 - Mentions légales</p>

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