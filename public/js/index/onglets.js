$(function() {

    console.log('CHARGEMENT   :    ONGLET.JS');

        $('.onglet-menu').click(function() {
            $('.optn-backpage').toggle();
        });


        $('.optn').click(function() {
            $('.optn-backpage').toggle();
        });


        $('.onglet-retour').click(function() {
            location.href = "http://localhost:8000";
        })

});