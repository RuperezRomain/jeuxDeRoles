$(document).ready(function () {
    position();
});
//fonction pour attribuer les nouvelles positions pour se deplacer
var max = $("tr").length - 1;
//var y;
//var x;
function position() {
    $("td").click(function () {
        $(this).addClass("j1");
        var l = $(this).parent().index();
        var c = $(this).index();
//        var l = $("tr")[y];
//        var c = $(l).children("td")[x];
        $("#ligne").val(l);
        $("#colonne").val(c);
    });
}