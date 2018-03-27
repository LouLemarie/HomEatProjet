$(function() {

    console.log('CHARGEMENT     :   SIDEBAR.JS')





    $('.button-collapse').sideNav({
        menuWidth: 200, // Default is 300
        edge: 'left', // Choose the horizontal origin
        closeOnClick: true, // Closes side-nav on <a> clicks, useful for Angular/Meteor
        draggable: true, // Choose whether you can drag to open on touch screens,

    });


    $(document).ready(function() {
        $('select').material_select();
    });
    //Script pour heure de dejeuner
    $('.timepicker').pickatime({
        default: 'now', // Set default time: 'now', '1:30AM', '16:30'
        fromnow: 0,       // set default time to * milliseconds from now (using with default = 'now')
        twelvehour: false, // Use AM/PM or 24-hour format
        donetext: 'OK', // text for done-button
        cleartext: 'Clear', // text for clear-button
        canceltext: 'Cancel', // Text for cancel-button
        autoclose: false, // automatic close timepicker
        ampmclickable: true, // make AM PM clickable
        aftershow: function(){} //Function for after opening timepicker
    });


    //------------------------------------------------ remplacement du bouton connexion par le formulaire de connexion

    $('#connexion').click(function(){

        $( "div.background" ).replaceWith( "<div class=\"background-connexion\">\n" +
            "            <form action=\"\">\n" +
            "                <div class=\"row\" id=\"row-connexion\">\n" +
            "                    <div class=\"input-field col s12\">\n" +
            "                        <input id=\"email\" type=\"email\" class=\"validate\">\n" +
            "                        <label for=\"email\">Email</label>\n" +
            "                    </div>\n" +
            "                </div>\n" +
            "                <div class=\"row\" id=\"row-connexion\">\n" +
            "                    <div class=\"input-field col s12\">\n" +
            "                        <input id=\"password\" type=\"password\" class=\"validate\">\n" +
            "                        <label for=\"password\">Password</label>\n" +
            "                    </div>\n" +
            "                </div>\n" +
            "                <button class=\"btn waves-effect waves-light submit-login\"  type=\"submit\" name=\"action\">Connexion\n" +
            "\n" +
            "                </button>\n" +
            "            </form>\n" +
            "        </div>" );




        $('.submit-login').click(function(e) {
            e.preventDefault()
            location.href = "http://localhost:8000/login"
        })
    });



    $('#inscription').click(function(){
        document.getElementById("overlay").style.display = "block";
    });
    $('#overlay-off').click(function(){
        document.getElementById("overlay").style.display = "none";
    });
    $(document).ready(function(){
        // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
        $('.modal').modal();
    });
})