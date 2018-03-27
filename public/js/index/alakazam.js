$(function() {

    console.log('CHARGEMENT   :    ALAKAZAM.JS');

    // INITIALISATIONS
    var i = 1;
    var responses = [];

    // GESTION DES RESPONSE BUTTONS

        $('.response').click(function() {
            if($(this).hasClass('selected-response')) {
                // On retire la classe .selected-response si le button ne la comprennait déjà
                $(this).removeClass('selected-response')
            } else {
                // On ajoute la classe .selected-response si le button ne la comprennait pas
                $(this).addClass('selected-response');

                // On test si la question suivante est caché ou non
                if($(this).parent().parent().next().hasClass('alakazam-question-hide')) {
                    // Affichage de la prochaine question
                    $(this).parent().parent().next().removeClass('alakazam-question-hide');

                    // Redirection vers la prochaine question
                    i++
                    var redirection = "http://localhost:8000/alakazamResponse#" + i;
                    location.href = redirection;
                }
            }
        });



    // GESTION DU BUTTON "NOMBRE DE PERSONNES"

        $('.nbrPers').click(function(e) {
            console.log('click');
            $('.output').text($(this).value)
        })




              // ---------------------- //
            //   BUTTONS VALIDATION   //
          // ---------------------- //

    // EFFACER BUTTON
    $('#alakazam-effacer').click(function(e) {
        location.href = "http://localhost:8000/alakazamResponse";
    })

    // RETOUR BUTTON
    $('#alakazam-retour').click(function(e) {
        location.href = "http://localhost:8000";
    })

    // VALIDER BUTTON
    $('#alakazam-valider').click(function(e) {
        for(var j = 0; j<$('.selected-response').length ; j++) {
            responses.push($('.selected-response')[j].textContent);
        }

        console.log(responses)

        /* REDIRECTIONS */

        // location.href = "http://localhost:8000";

        /* AJAX
        $.post("", {
            responses : responses
        });
        */
    })
});