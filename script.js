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


