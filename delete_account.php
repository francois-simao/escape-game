<!--page de suppression du compte-->
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
    <title>deleted_account</title>
</head>
<body>
    
<?php
if(isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    if(!empty($id) && is_numeric($id)){   // is_numeric détermine si une variable est de type numérique
        $sql = $bdd->prepare("DELETE FROM user WHERE id = ?");
        $sql->execute(array($id));
        header("Location: index.php");
    }

//sécurité page           
} else {
    header("Location: index.php");
}
?>

</body>
</html>

