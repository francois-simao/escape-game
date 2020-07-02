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
            $sql = $bdd->prepare("DELETE FROM enigma WHERE id_game = ?");
            $sql->execute(array($_GET['id']));


            //suppression du jeu
            $sql = $bdd->prepare("DELETE FROM game WHERE id = ?");
            $sql->execute(array($_GET['id']));
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