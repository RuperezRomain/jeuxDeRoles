$(document).ready(function () {
// Recup valeur pv actuel
    var $pv = $('input[id=appbundle_stats_pv]').val();
    var $att = $('input[id=appbundle_stats_att]').val();


    var pool;
    var tries = 10;

    /**
     * Generateur de Points
     * @param {type} e
     * @returns {undefined}
     */
    var generator = function (e) {
        e.preventDefault();
        if (tries >= 0) {
            tries--;
            pool = Math.random() * 40 + 10;
            pool = Math.round(pool);
            $("#rdStats").val(pool);
        }
    };
    $("#generator").click(generator);

//quand je click sur pv 
    pvUpdate($pv);
    attUpdate($att);


    function pvUpdate($pv) {
        // empeche l'utilisation du clavier
        $('input[id=appbundle_stats_pv]').keypress(function (evt) {
            evt.preventDefault();
        });

        $('input[id=appbundle_stats_pv]').on("input propertychange", function () {
            $rd = parseInt($('input[id=rdStats]').val());
            // si les pv sont modifié 
            if ($pv < $('input[id=appbundle_stats_pv]').val()) {
                // je crée une variable avec la nouvelle valeur de rd 
                // j'affecte cette nouvelle valeur a rd 
                $rd = $rd - 1; //Set new valeur
                $('input[id=rdStats]').val($rd);//Get new valeur
                // je crée une variable avec la nouvelle valeur de pv 
                $newPv = parseInt($('input[id=appbundle_stats_pv]').val());
                // j'affecte cette nouvelle valeur a pv 
                $pv = $newPv;
                $('#appbundle_stats_pv').attr({
                    "max": $newPv + $rd
                });
            } else if ($pv > $('input[id=appbundle_stats_pv]').val()) {

                $rd = $rd + 1; //Set new valeur
                $('input[id=rdStats]').val($rd);//Get new valeur
                // je crée une variable avec la nouvelle valeur de pv 
                $newPv = parseInt($('input[id=appbundle_stats_pv]').val());
                // j'affecte cette nouvelle valeur a pv 
                $pv = $newPv;


            }


        });

    }

    function attUpdate($att) {
        // empeche l'utilisation du clavier
        $('input[id=appbundle_stats_att]').keypress(function (evt) {
            evt.preventDefault();
        });

        $('input[id=appbundle_stats_att]').on("input propertychange", function () {
            var $rd = parseInt($('input[id=rdStats]').val());

            // si les pv sont modifié 
            if ($att < $('input[id=appbundle_stats_att]').val()) {
                // je crée une variable avec la nouvelle valeur de rd 
                // j'affecte cette nouvelle valeur a rd 
                $rd = $rd - 1;
                $('input[id=rdStats]').val($rd);
                // je crée une variable avec la nouvelle valeur de att 
                $newAtt = parseInt($('input[id=appbundle_stats_att]').val());
                // j'affecte cette nouvelle valeur a att 
                $att = $newAtt;

                $('#appbundle_stats_att').attr({
                    "max": $newAtt + $rd
                });
            } else if ($att > $('input[id=appbundle_stats_att]').val()) {

                $rd = $rd + 1; //Set new valeur
                $('input[id=rdStats]').val($rd);//Get new valeur
                // je crée une variable avec la nouvelle valeur de att
                $newAtt = parseInt($('input[id=appbundle_stats_att]').val());
                // j'affecte cette nouvelle valeur a att 
                $att = $newAtt;


            }

        });
    }

});