<!-- page de suppression d'une énigme-->
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
    <title>Suppression énigme</title>
</head>
<body>
    
<?php
    if(isset($_SESSION['id'])) {  
        if (isset($_GET['id'])) {
            $delete="DELETE FROM enigma WHERE id=".$_GET['id']." ";
            $stmt = $bdd->prepare($delete);
            $stmt->execute();
            header("Location: add_enigma.php");
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