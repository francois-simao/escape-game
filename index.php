<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<!--page de connexion-->
<h1>Me connecter</h1>
<form action="enigma.php" method="post">
    <p>
    <label for="username">Quel est votre nom d'utilisateur ?</label>
    <input type="text" name="username" required/>
    <label for="password">Quel est votre mot de passe ?</label>
    <input type="password" name="password" required />
    <input type="submit" value="Valider" />
    </p>
    </form>

    <a href='reset_password.php'>Mot de passe oublié?</a>

<!--lien d'inscription-->
<h1>Inscription</h1>
<a href='registration.php'>Je crée un compte</a>





</body>
</html>