<!-- page d'ajout de jeux-->
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


<!-- formulaire -->
<form action="" method="POST">
    <div class="form-group">
        <input type="text" class="form-control h-100"  placeholder="Entrer le nom de l'énigme" name ="name_enigma" required>
    </div>
                            
    <div class="form-group">
        <input type="number" class="form-control h-100" placeholder="Entrer la durée du jeu" name="duration_enigma" required>
    </div>
    <div class="form-group">
        <textarea class="form-control" placeholder="Entrer l'enigme/jeux/charades..." rows="6" name="content_enigma" required></textarea>
    </div>
    <div class="form-group">
        <textarea class="form-control" placeholder="Entrer la solution" rows="6" name="solution_enigma" required></textarea>
    </div>
    <div class="d-flex justify-content-center">
            <button type="submit" class="btn-add-game btn btn-primary mb-4 px-5" name="ajouter">Enregistrez votre énigme</button>
    </div>
</form>





<!-- affichage des énigmes ajoutées -->
<?php
   $reponse = $bdd->query("SELECT MAX(id) FROM game");
   $donnees = $reponse->fetch();
   $id_game = intval($donnees[0]);

    $sql="SELECT * FROM enigma WHERE id_game = $id_game ";
    $req = $bdd->query($sql); 
    while ($row=$req->fetch()){
?>
            
            <label >Enigme : <?php echo $row['name_enigma'] ?> </label>
            <textarea  class='mb-3'><?php echo $row['content_enigma'] ?></textarea>
            <label >Durée : <?php echo $row['duration_enigma'] ?> </label>
            <label >Solution : </label>
            <textarea class='mb-5'><?php echo $row['solution_enigma'] ?></textarea>
<?php
        }
?>







            <input type="button" value="Valider votre jeux" onclick="window.location.href ='page_admin.php';" class="btn-play-header button-admin-slide text-light my-3">
            <input type="button" value="Ne pas ajouter d'énigmes" onclick="window.location.href ='page_admin.php';" class="btn-play-header button-admin-slide text-light my-3">





<!-- sécurité page-->         
<?php   
}
else {
    header("Location: index.php");
    }
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