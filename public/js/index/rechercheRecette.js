$(function() {

    console.log('CHARGEMENT   :    EDITOR.JS');

    $('.mesrecettes-recherche').keyup(function() {
        var recherche   = $(this)[0].value;
        var recettes    = $('.mesrecettes-titre');
        var li          = $('.mesrecettes-reponse-container');

        for(var i = 0; i < recettes.length; i++) {
            console.log(recettes[i].textContent.toLowerCase());
            console.log(recherche.toLowerCase());
            console.log(recettes[i].textContent.toLowerCase().indexOf(recherche.toLowerCase()) >= 0);
            if(recettes[i].textContent.toLowerCase().indexOf(recherche.toLowerCase()) >= 0) {
                li[i].classList = 'mesrecettes-reponse-container show';
            } else {
                li[i].classList = 'mesrecettes-reponse-container hide';
            }
        }
    })

})