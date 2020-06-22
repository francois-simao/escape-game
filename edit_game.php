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
<body class="bg-warning">

<div class="page-wrap">
   <div class="container-fluid p-0">
<!-- MENU -->
   </div>



        <div class="container">
            <div class="row flex-column">
                <div class="bg-light d-flex justify-content-center ">
                    <div class="col-12 col-sm-12 col-md-8 col-lg-6 col-xl-6">
                        <?php
                            // if(isset($_SESSION['id'])) {  
                                
                                $sql="SELECT * FROM game WHERE id=".$_GET['id']." ";
                                $req = $bdd->query($sql);



                                    echo "<form action='' method='post' class='d-flex flex-column'>";
                                    while ($row=$req->fetch()){

                                    echo $row['id']." <input type='text' class='border' name ='new_name' value='".$row['name']."'>";

                                    echo"<div class='d-flex justify-content-between'>";
                                        echo "<input type='number' placeholder='Nombre de joueurs'>";
                                        echo "<label for='time_game' class='m-0'>Durée du jeu : </label>";
                                        echo "<input type='time' placeholder='Durée du jeu' name='time_game'>";
                                    echo "</div>";

                                    echo " <textarea rows='10' cols='50' class='' name='new_history'> ".$row['history']." </textarea>";

                                    
                                    }

                                    echo"<div class='d-flex justify-content-center'>";
                                        echo "<input type='submit' class='btn-play-header w-25' value='Modifier'>";
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