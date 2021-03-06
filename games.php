<!--page des jeux-->
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
    <title>W.E.G - Jeux</title>
</head>

<body>
<?php
if(isset($_SESSION['id'])) {          
?>
    <!--header -->
    <div class="page-wrap">
        <div class="container-fluid bg-color p-0 mb-lg-5 mb-xl-5">
            <div class="container ">
                <div class="row  ">
                    <div id="mySidenav" class="sidenav sidenav-color size-width-menu">
                        <div class="closebtn text-center text-light" onclick="closeNav(x)">&times;</div>
                        <div class=" contenu-menu-user ">
                            <ul
                                class="d-flex d-flex flex-sm-column flex-md-column flex-lg-column flex-xl-row align-items-center">
                                <div class=" w-50">
                                    <li
                                        class="d-flex flex-column flex-sm-column flex-md-column flex-lg-column flex-xl-row align-items-center title-menu ">
                                        <!--affichage de l'avatar-->
                                        <?php if (isset($_SESSION['pseudo']) AND isset($_SESSION['avatar'])) {
                                                ?>
                                        <div class="img-avatar-ronde-games-01 mr-xl-3">
                                            <img src="membres/avatars/<?php echo ($_SESSION['avatar']);?>" width="100"
                                                class="img-fluid img-avatar" />
                                        </div>
                                        <?php
                                                } else {
                                                ?>
                                        <div class="img-avatar-ronde-games-02">
                                            <img src="membres/avatars/default-avatar.jpg" width="100"
                                                class="img-fluid img-avatar " />
                                        </div>
                                        <?php
                                                }
                                                ?>
                                        <!--affichage du pseudo-->
                                        <p class="pl-3 pt-3"><?php echo ($_SESSION['pseudo']);?></p>
                                    </li>
                                </div>
                                <div
                                    class="d-flex flex-column flex-sm-column flex-md-column flex-lg-column flex-xl-row text-center">
                                    <!--liens-->
                                    <li><a href="my_account.php" onclick="closeNav(x)" class="title-menu">Mon compte</a>
                                    </li>
                                    <li><a href="page_logout.php" onclick="closeNav(x)"
                                            class="title-menu">Déconnexion</a>
                                    </li>
                                </div>
                            </ul>
                        </div>
                    </div>
                    <div id="ecart-menu">
                        <div class="icon-menu ml-3 text-light" onclick="openNav(y)">&#9776;</div>
                    </div>
                </div>
            </div>
        </div>


    <!-- choix du jeu -->
    <?php
    $sql = $bdd->prepare("SELECT * FROM game ");
    $sql->execute(array());         
    ?>
        <div class="container-fluid p-0 mb-4">
            <h1 class="title-form text-center text-uppercase mt-4 mt-sm-5 mt-md-5 mt-lg-0 mt-xl-0">Choix des jeux</h1>
            <div class="page-wrapper">
                <div class="post-slider position-relative">
                    <i class="fas fa-chevron-left prev position-absolute"></i>
                    <i class="fas fa-chevron-right next position-absolute"></i>

                    <div class="post-wrapper">
                        <?php
                    while ($row=$sql->fetch()){
                    ?>
                        <div class="post">
                            <!--affichage de l'image du jeu-->
                            <?php if($row['image'] == NULL) { ?>
                            <img src="membres/jeux/default-game.jpg" alt="" class="slider-image w-100">
                            <?php } else {?>
                            <img src="membres/jeux/<?php echo ($row['image']);?>" alt="" class="slider-image w-100">
                            <?php } ?>
                            <div class="circle-singleline">
                            <!--affichage des caractéristiques du jeu-->
                                <p><?php echo ($row['number_players']);?> personnes</p>
                                <p><?php echo ($row['duration']);?> minutes</p>
                            </div>
                            <div class="post-info p-2">
                                <div class="title-game-slider-width">
                                <h4 class="title-game-slider text-center my-2 text-uppercase">
                                    <?php echo ($row['name']);?></h4>
                                    </div>
                                <div class="text-overflow-game">
                                    <p class="text-game-slider"><?php echo ($row['history']);?></p>
                                    <div class="d-flex justify-content-around">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--footer -->
    <footer>
        <div class="container-fluid site-footer">
            <div class="contenu-footer text-light d-flex justify-content-around text-center">
                <p class="footer-realisation my-2 py-3">World Escape Game 2020 - Mentions légales</p>

            </div>
        </div>
    </footer>



<!-- sécurité page-->
<?php   
} else {
    header("Location: index.php");
}
?>

    
    <!-- Slick Carousel -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script>
        $('.post-wrapper').slick({
            infinite: true,
            speed: 300,
            slidesToShow: 4,
            slidesToScroll: 1,
            nextArrow: $('.next'),
            prevArrow: ('.prev'),
            responsive: [
                {
                    breakpoint: 1400,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        infinite: true,

                    }
                },
                {
                    breakpoint: 1034,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        infinite: true,

                    }
                },
                {
                    breakpoint: 890,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 660,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 590,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });

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