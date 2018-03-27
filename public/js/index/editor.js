$(function() {

    console.log('CHARGEMENT   :    EDITOR.JS');
    var etapes = 0;

    $('.add-etape').click(function(e) {
        e.preventDefault();
        etapes ++;
        $('.etape-container').append('<div><em class="col-xs-12">Etape <span class="etape">' + etapes + '</span> : </em><input name="etapes[]" type="text" class="col-xs-10"><button class="col-xs-1 rmv-etape">X</button></div>')


        // GESTION DES RMV-ETAPE BUTTON (important de le mettre DANS l'evènement ('.add-etape'), question de rafraichissement)
        $('.rmv-etape').click(function(e) {
            // On empeche me formulaire de s'envoyer
            e.preventDefault();

            // On delet la div parent
            $(this).parent().remove();

            // On compte le nombre d'étapes restantes
            etapes = $('.etape').length;

            // On parcours toutes les étapes pour ajuster leur valeur
            for(var i=0; i < etapes; i++) {
                $('.etape')[i].textContent = i + 1;
            }

        })
    })

})