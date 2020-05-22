<!--page d'inscription-->
<h1>Formulaire d'inscription</h1>
<form action="enigma.php" method="post">
    <p>
    <input type="text" name="last_name" required placeholder="entrez votre nom"/>
    <input type="text" name="first_name" required placeholder="entrez votre prénom"/>
    <input type="email" name="email" required placeholder="entrez votre email"/>
    <input type="email" name="email" required placeholder="confirmez votre email"/>
    <input type="text" name="username" required placeholder="entrez votre nom d'utilisateur"/>
    <input type="password" name="password" required placeholder="entrez votre mot de passe"/>
    <input type="submit" value="Valider" />
    </p>
</form>