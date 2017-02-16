//quand le document est pret ( a la fin du chargeùent de la page)
$(document).ready(function () {
    center("button");
    center("#selection");
    center("form");
    center("#plateau");
    $("body").css("visibility", "visible");

});

$(window).resize(function () {
    center("button");
    center("#selection");
    center("form");
    center("#plateau");
});


//quand on clique sur le bouton
$("button").click(function (e) {
    $(this).fadeOut(600, function () {
        $("#selection").fadeIn(600);
    });
});

/**
 * Fonction qui centre le bouton
 * @returns {undefined}
 */

function center(object) {

// on récupere les dimensions de la fenetre
    var w = $(window).width();
    var h = $(window).height();
    // on récupere les  dimensions du bouton
    var buttonw = $(object).width();
    var buttonh = $(object).height();
    // on calcule la position du bouton afin qu'il soit au centre
    var top = (h - buttonh) / 2;
    var left = (w - buttonw) / 2;
    //on affecte les nouvelles positions calculées
    $(object).css({
        "position": "relative",
        "left": left + "px",
        "top": top + "px"
    });
}

