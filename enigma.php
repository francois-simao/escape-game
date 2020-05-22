<?php
if(isset($_POST['username']) && ($_POST['password']) && ($_POST['username']=== 'zlatan') && ($_POST['password']== 1234)  ){
 ?> 

    <!-- connexion base de données-->
<?php include("connection.php"); ?>

<!-- requête enigme-->
<?php
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


<?php
}
else 
{
echo '<p>Mot de passe ou nom d\'utilisateur incorrect</p>';
}
?>

<!--lien de déconnexion-->
<a href='logout.php'>déconnexion</a>








