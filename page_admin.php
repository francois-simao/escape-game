<!-- page admin-->
<?php
session_start();
// connexion base de données
include 'connection_database.php';
?>




<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link rel="stylesheet" href="style.css">
    <title>W.E.G - Admin</title>
</head>

<body>
<?php
    // if(isset($_SESSION['id'])) {          
?>
    <div class="page-wrap">

        <div class="container-fluid bg-color p-0 mb-lg-5 mb-xl-5">
            <div class="container">
                <div class="row">
                    <div id="mySidenav" class="sidenav sidenav-color size-width-menu">
                        <div class="closebtn text-center text-light" onclick="closeNav(x)">&times;</div>
                        <div class="contenu-menu">
                            <ul class="d-flex d-flex flex-sm-column flex-md-column flex-lg-column flex-xl-row align-items-center">
                                <div class=" w-50">
                                    <!-- <li class="d-flex flex-column flex-sm-column flex-md-column flex-lg-column flex-xl-row align-items-center title-menu ">
                                    </li> -->
                                </div>
                                    <li><a href="page_logout.php" onclick="closeNav(x)"
                                            class="title-menu">Déconnexion</a>
                                    </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="container-fluid p-0 mb-4">
            <div class="d-flex justify-content-center">
<<<<<<< HEAD
                <input type="button" value="Ajouter un nouveau jeu" onclick="window.location.href ='add_game.php';"
                    class="text-light btn-play-header button-admin-creation my-3 mt-5">
=======
                <input type="button" value="Ajouter un nouveau jeu" onclick="window.location.href ='add_game.php';" class="text-light btn-play-header button-admin-creation my-3 mt-5">
>>>>>>> df0620c4913f7254732fea0f9b6dc235f2b62726
            </div>
            <div class="container  ">
                <div class="row row-cols-1 row-cols-md-3">
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-4 p-sm-0 ">
                        <div class="post-admin mx-2 mb-5">
                            <div class="img-admin-01">
                                <img src="img/monde-post-apo.jpg" alt="" class="img-admin-02 w-100">
                            </div>

                            <div class="post-info p-2">
                                <h4 class="title-game-slider text-center my-2 text-uppercase">warrior game</h4>
                                <div class="d-flex flex-column align-items-center">
                                    <input type="button" value="Modifier"
                                        class="btn-play-header button-admin-slide text-light my-3">
                                    <input type="button" value="Supprimer"
                                        class="btn-play-header button-admin-slide text-light my-3">
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-4 p-sm-0 ">
                        <div class="post-admin mx-2 mb-5">
                            <div class="img-admin-01">
                                <img src="img/princess-world.jpg" alt="" class="img-admin-02 w-100">
                            </div>
                            <div class="post-info p-2">
                                <h4 class="title-game-slider text-center my-2 text-uppercase">warrior game</h4>
                                <div class="d-flex flex-column align-items-center">
                                    <input type="button" value="Modifier"
                                        class="btn-play-header button-admin-slide text-light my-3">
                                    <input type="button" value="Supprimer"
                                        class="btn-play-header button-admin-slide text-light my-3">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-4 p-sm-0">
                        <div class="post-admin mx-2 mb-5">
                            <div class="img-admin-01">
                                <img src="img/escape-the-planet.jpg" alt="" class="img-admin-02 w-100">
                            </div>
                            <div class="post-info p-2">
                                <h4 class="title-game-slider text-center my-2 text-uppercase">warrior game</h4>
                                <div class="d-flex flex-column align-items-center">
                                    <input type="button" value="Modifier"
                                        class="btn-play-header button-admin-slide text-light my-3">
                                    <input type="button" value="Supprimer"
                                        class="btn-play-header button-admin-slide text-light my-3">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-4 p-sm-0">
                        <div class="post-admin mx-2 mb-5">
                            <div class="img-admin-01">
                                <img src="img/monde-post-apo.jpg" alt="" class="img-admin-02 w-100">
                            </div>
                            <div class="post-info p-2">
                                <h4 class="title-game-slider text-center my-2 text-uppercase">warrior game</h4>
                                <div class="d-flex flex-column align-items-center">
                                    <input type="button" value="Modifier"
                                        class="btn-play-header button-admin-slide text-light my-3">
                                    <input type="button" value="Supprimer"
                                        class="btn-play-header button-admin-slide text-light my-3">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-4 mx-card-game p-sm-0">
                        <div class="post-admin mx-2 mb-5">
                            <div class="img-admin-01">
                                <img src="img/princess-world.jpg" alt="" class="img-admin-02 w-100">
                            </div>
                            <div class="post-info p-2">
                                <h4 class="title-game-slider text-center my-2 text-uppercase">warrior game</h4>
                                <div class="d-flex flex-column align-items-center">
                                    <input type="button" value="Modifier"
                                        class="btn-play-header button-admin-slide text-light my-3">
                                    <input type="button" value="Supprimer"
                                        class="btn-play-header button-admin-slide text-light my-3">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-4 p-sm-0">
                        <div class="post-admin mx-2 mb-5">
                            <div class="img-admin-01">
                                <img src="img/escape-the-planet.jpg" alt="" class="img-admin-02 w-100">
                            </div>
                            <div class="post-info p-2">
                                <h4 class="title-game-slider text-center my-2 text-uppercase">warrior game</h4>
                                <div class="d-flex flex-column align-items-center">
                                    <input type="button" value="Modifier"
                                        class="btn-play-header button-admin-slide text-light my-3">
                                    <input type="button" value="Supprimer"
                                        class="btn-play-header button-admin-slide text-light my-3">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-4 p-sm-0">
                        <div class="post-admin mx-2 mb-5">
                            <div class="img-admin-01">
                                <img src="img/monde-post-apo.jpg" alt="" class="img-admin-02 w-100">
                            </div>
                            <div class="post-info p-2">
                                <h4 class="title-game-slider text-center my-2 text-uppercase">warrior game</h4>
                                <div class="d-flex flex-column align-items-center">
                                    <input type="button" value="Modifier"
                                        class="btn-play-header button-admin-slide text-light my-3">
                                    <input type="button" value="Supprimer"
                                        class="btn-play-header button-admin-slide text-light my-3">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-4 mx-card-game p-sm-0">
                        <div class="post-admin mx-2 mb-5">
                            <div class="img-admin-01">
                                <img src="img/princess-world.jpg" alt="" class="img-admin-02 w-100">
                            </div>
                            <div class="post-info p-2">
                                <h4 class="title-game-slider text-center my-2 text-uppercase">warrior game</h4>
                                <div class="d-flex flex-column align-items-center">
                                    <input type="button" value="Modifier"
                                        class="btn-play-header button-admin-slide text-light my-3">
                                    <input type="button" value="Supprimer"
                                        class="btn-play-header button-admin-slide text-light my-3">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <footer>
        <div class="container-fluid site-footer ">
            <div class="contenu-footer text-light d-flex justify-content-around text-center">
                <p class="footer-realisation my-2 py-3">World Escape Game 2020 - Mentions légales</p>

            </div>
        </div>
    </footer>





























<!-- sécurité page-->         
<?php   
// }
// else {
//     header("Location: index.php");
//     }
    ?>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Slick Carousel -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script>




    </script>



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