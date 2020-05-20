<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

<?php
try{
$bdd = new PDO('mysql:host=localhost;dbname=escape_game', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));}
catch (Exception $e){
die('Erreur : ' . $e->getMessage());}

$reponse = $bdd->query('SELECT * FROM enigma');
while ($donnees = $reponse->fetch())
{
?>
        
    <p><h1>Durée du jeu</h1> <?php echo $donnees['duration']; ?><br />
    <h1>Histoire</h1> <?php echo $donnees['content'];?>
    <h1>Image</h1> <img src="<?php echo $donnees['image']?>" alt="image" width=500 />
    <h1>Video</h1><video src="<?php echo $donnees['video']?>" controls poster="<?php echo $donnees['image']?>" width="600"></video></p>
    <?php
    }
    
$reponse->closeCursor();
?>




</body>
</html>