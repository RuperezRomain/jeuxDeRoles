//quand le document est pret ( a la fin du chargeùent de la page)
$(document).ready(function () {
    centerButton();
    centerForm();
    centerCreaPerso();
    $("body").css("visibility", "visible");

});

$(window).resize(function () {
    centerButton();
    centerForm();
    centerCreaPerso();
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

function centerButton() {

// on récupere les dimensions de la fenetre
    var w = $(window).width();
    var h = $(window).height();
    // on récupere les  dimensions du bouton
    var buttonw = $("button").width();
    var buttonh = $("button").height();
    // on calcule la position du bouton afin qu'il soit au centre
    var top = (h - buttonh) / 2;
    var left = (w - buttonw) / 2;
    //on affecte les nouvelles positions calculées
    $("button").css({
        "left": left + "px",
        "top": top + "px"
    });
}

function centerForm() {

// on récupere les dimensions de la fenetre
    var w = $(window).width();
    var h = $(window).height();
    // on récupere les  dimensions du bouton
    var buttonw = $("#selection").width();
    var buttonh = $("#selection").height();
    // on calcule la position du bouton afin qu'il soit au centre
    var top = (h - buttonh) / 2;
    var left = (w - buttonw) / 2;
    //on affecte les nouvelles positions calculées
    $("#selection").css({
        "left": left + "px",
        "top": top + "px"
    });
}

    function centerCreaPerso() {

// on récupere les dimensions de la fenetre
        var w = $(window).width();
        var h = $(window).height();
        // on récupere les  dimensions du bouton
        var buttonw = $("form").width();
        var buttonh = $("form").height();
        // on calcule la position du bouton afin qu'il soit au centre
        var top = (h - buttonh) / 2;
        var left = (w - buttonw) / 2;
        //on affecte les nouvelles positions calculées
        $("form").css({
            "left": left + "px",
            "top": top + "px"
        });
    }
