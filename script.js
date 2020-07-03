// document.getElementById("test").onclick = function(){
//     confirm('Etes-vous sûr de vouloir supprimer votre compte?');
//     window.location.href ='delete_game.php?id=<?= $row['id'] ?>';
// }



// $delete = document.getElementById("test").onclick
// if( $delete == true  ){
//     $("#exampleModalCenter").modal('show');
//     window.location.href ='delete_game.php?id=<?= $row['id'] ?>';
//  } 



// menu responsif
function openNav(y) {
    if (y.matches) { //openNav est le nom donné au onclick qui, lorsqu'on clique sur le menu, il s'ouvrira grâce au getElementById qui récupère l'id "mySidenav" dans la div principale
        document.getElementById("mySidenav").style.width = "100%"; //style.width permet de donner une largeur au menu lorsque celui-ci est ouvert (mettre en 100% pour qu'il puisse prendre toute la page)
        // document.getElementById("ecart-menu").style.marginLeft = "50%"; // permet de faire décaler le texte et l'icon du menu
    }
}

function closeNav(x) {
    if (x.matches) {//closeNav est le nom donné au onclick pour fermer le menu (même système que celui du openNav)
        document.getElementById("mySidenav").style.width = "0"; // mettre 0 pour qu'il ne soit pas visible
        // document.getElementById("ecart-menu").style.marginLeft = "0";
    }
}

var y = window.matchMedia("(max-width: 1199.98px)")
openNav(y) // Call listener function at run time
y.addListener(openNav) // Attach listener function on state changes
var x = window.matchMedia("(max-width: 1199.98px)")
closeNav(x) // Call listener function at run time
x.addListener(closeNav) // Attach listener function on state changes


// carousel games.php

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



