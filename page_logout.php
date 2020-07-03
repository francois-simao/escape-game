<!--page de déconnexion-->
<?php
session_start();
$_SESSION = array(); /*on vide les variables de session */
session_destroy();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>W.E.G - Déconnexion</title>
</head>

<body>

    <div class="container-fluid p-0 bg-header">
        <div class="vh-100 d-flex justify-content-center align-items-center bg-opac">
            <div class="bloc-form bg-light px-4 py-5 text-center">
                <h1 class="text-uppercase text-center">A bientôt !</h1>
                <p>Vous avez été déconnecté avec succès!</p>
                <p class="mb-3 ">Vous allez être redirigé sur la page d'accueil automatiquement</p>
            </div>
        </div>
    </div>


<script>
// une fois la page completement chargée
document.addEventListener('DOMContentLoaded', function() {
    // mise en attente 5sec et redirection
      setTimeout(function(){
        window.location.href = 'index.php';
    }, 5000);
    }, false);
</script>

<!--scripts-->
    <script src="script.js"></script>
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