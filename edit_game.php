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
    <title>Modifier un jeu</title>
</head>
<body>
    
<?php
    // if(isset($_SESSION['id'])) {  
        
        $sql="SELECT * FROM game WHERE id=".$_GET['id']." ";
        $req = $bdd->query($sql);



            echo "<form action='' method='post'>";
            while ($row=$req->fetch()){

	        echo $row['id']." <input type='text' name ='new_name' value='".$row['name']."'>";
            echo " <textarea rows='10' cols='50' name='new_history'> ".$row['history']." </textarea>";
            }
    echo "<input type='submit' value='modifier'>";
    echo "</form>";

        if (isset($_POST) AND !empty($_POST) ){
            if (!empty($_POST['new_name']) AND !empty($_POST['new_history']) ) {	
	
	            $update = $bdd->prepare("UPDATE game SET name = ?, history = ?  WHERE id=".$_GET['id']." ");
	            $update->execute(array($_POST['new_name'], $_POST['new_history'] ));
                // header("Location: page_admin.php");
                }
            }
?>




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