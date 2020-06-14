<?php
session_start();
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
    if(!empty($id) && is_numeric($id)){
        include 'connection_bdd.php';
        $query = "DELETE FROM user WHERE id=$id";
        $stmt = $bdd->prepare($query);
	    $stmt->execute();
        header("Location: index.php");
    }
}

//sécurité page           
   else {
      header("Location: index.php");
   }

?>



</body>
</html>

