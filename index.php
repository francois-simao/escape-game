<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>WORLD ESCAPE GAME</title>
</head>

<body>
<!-- partie utilisateur -->
<div class="page-wrap">
    <header>
        <div class="container-fluid bg-header">
            <div class="container">
                <div class="row  ">
                    <div id="mySidenav" class="sidenav size-width-menu">
                        <div class="closebtn text-center text-light" onclick="closeNav(x)">&times;</div>
                        <div class=" contenu-menu-user text-center">
                            <ul>
                                <div class="d-flex flex-column flex-sm-column flex-md-column flex-lg-column flex-xl-row">
                                <li><a href="connection_admin.php" onclick="closeNav(x)" class="title-menu btn-orange-create ">Créer son
                                        escape game</a></li>
                            </div>
                            <div class="d-flex flex-column flex-sm-column flex-md-column flex-lg-column flex-xl-row">
                                <li><a href="registration.php" onclick="closeNav(x)"
                                        class="title-menu">S'inscrire</a></li>
                                <li><a href="connection_user.php" onclick="closeNav(x)" class="title-menu ">Se connecter</a></li>
                                    </div>
                            </ul>
                        </div>
                    </div>
                    <div id="ecart-menu">
                        <div class="icon-menu ml-3 text-light" onclick="openNav(y)">&#9776;</div>
                    </div>
                </div>
            </div>
            <div class="container container-logo" >
                <div class="col-12">
                    <div class="img-logo-header d-flex justify-content-center">
                        <img src="img/logo-world.png" class="img-logo-head img-fluid" alt="logo-world">
                    </div>
                    <div class="container-text-header text-light text-center">
                        <h1 class="title-head text-uppercase">world escape game</h1>
                        <p class="text-head">BIENVENUE, venez vous éclater sur des games éclatés !</p>
                    </div>
                    <div class="content-btn-play text-center d-flex justify-content-center">
                        <div class="foo rectangle-right"></div>
                        <div class="foo triangle-right"></div> <a href="connection_user.php" class="btn-play-header btn-play-width text-light py-4 text-uppercase  ">Jouer</a>
                        <div class="foo triangle-left"></div>
                        <div class="foo rectangle-left"></div>
                    </div>
                </div>
            </div>
        </div>
    </header>

<!-- centre de la page -->
    <div class="container-fluid explication-escape  mt-5 mb-5">
        <div class="container">
            <div class="row ">
                <div class="col-12 ">
                    <div class="d-flex justify-content-center flex-column align-items-center">
                        <div class="content-text-explication text-center mb-3">
                            <h2 class="title-explication">Qu’est-ce qu’est Word Escape Games ?</h2>
                            <p class="text-explication">Un escape game est un jeu d'énigmes qui se vit en équipe. Les
                                joueurs
                                évoluent généralement
                                dans un lieu clos et thématisé. Ils doivent résoudre une série de casse-têtes dans
                                un temps imparti pour réussir à s'échapper ou à accomplir une mission.<br>
                                En résumé, c'est un peu comme Fort Boyard mais sans les épreuves physiques.</p>
                        </div>
                        <div class="content-img-explication d-flex justify-content-center col-12">
                            <div class="content-img-game-01 transition-01">
                                <img src="img/escape-the-planet.jpg" width="486" height="347"
                                    class="img-game-explication img-fluid">
                                <p class="title-game-explication-01 text-center bg-light pr-xl-5">Space Escape</p>
                            </div>
                            <div class="content-img-game-absolute transition-02">
                                <img src="img/monde-post-apo.jpg" width="486" height="347"
                                    class="img-game-explication img-absolute img-fluid">
                                <p class="title-game-explication-02 text-center bg-light">PostApo Escape</p>
                            </div>
                            <div class="content-img-game-02 ">
                                <img src="img/princess-world.jpg" width="486" height="347"
                                    class="img-game-explication img-fluid">
                                <p class="title-game-explication-03 text-center bg-light pl-xl-5">Medieval Escape</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- partie administrateur -->
    <div class="container-fluid create-game w-100 h-auto position-relative pt-5 pb-5">
        <div class="container">
            <div class="content-text-create-game d-flex flex-column align-items-center text-light text-center">
                <h2 class="title-create-game text-uppercase text-light">Créer vos niveaux ?</h2>
                <p class="text-create-game text-light">Word Escape Games vous permet de créer votre Escape game comme vous le
                    voulez,<br>
                    pour en faire un escape game unique !<br>
                    Votre seule limite, votre imagination !</p>
                <a href="connection_admin.php" class="btn-play-header btn-create-width text-light py-4 text-uppercase action-button">Créer</a>
            </div>
        </div>
    </div>
</div>

<!--footer -->
<footer>
        <div class="container-fluid site-footer ">
            <div class="contenu-footer text-light d-flex justify-content-around text-center">
                <p class="footer-realisation my-2 py-3">World Escape Game 2020 - Mentions légales</p>
            </div>
        </div>
    </footer>






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