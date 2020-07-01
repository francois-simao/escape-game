<!-- page de suppression de jeux-->
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
    <title>Suppression jeux</title>
</head>
<body>
    
<?php
    if(isset($_SESSION['id'])) {  
        if (isset($_GET['id'])) {
            //suppression des énigmes associées au jeu
            $delete="DELETE FROM enigma WHERE id_game=".$_GET['id']." ";
            $stmt = $bdd->prepare($delete);
            $stmt->execute();

            //suppression du jeu
            $delete="DELETE FROM game WHERE id=".$_GET['id']." ";
            $stmt = $bdd->prepare($delete);
            $stmt->execute();
            header("Location: page_admin.php");
        }
?>

<!-- sécurité page-->         
<?php   
}
else {
    header("Location: index.php");
    }
    ?>

</body>
</html>