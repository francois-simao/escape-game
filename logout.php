<!--page de déconnexion-->
<?php
session_start();
$_SESSION = array(); /*on vide les variables de session */
session_destroy();
header("Location:index.php");
?>