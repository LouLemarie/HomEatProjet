// $(function() {
//
//     console.log('CHARGEMENT   :    TEMPLATE.JS');
//
//                                      /* *************************************
//                                                INITIALISATIONS
//                                    ************************************* */
//
//
//                                      console.log('---- TEMPLATE.JS ----')
//
//
//     // INITIALISATIONS VAR
//
//     var Yinit           = 0
//     var Ysave           = 0
//     var Y               = 0
//     var testDeplacement = false
//     var eGLOBAL         = null
//
//     var DeplacementMax  = 600
//
//     var H               = parseInt($('.container2').css('height'))
//     var Hmax            = H - parseInt($('.container1').css('height'))
//
//
//     // INIT LISTENER
//
//     document.getElementById("myDIV").addEventListener("mouseup", finDeplacement);
//     // document.getElementById("container3").addEventListener('mouseup', container3animation)
//
//
//
//
//
//
//
//     /* *************************************
//                      FUNCTIONS
//     ************************************* */
//
//
//
//     // ----------------------------------------------------------- DEPLACEMENT
//
//
//     function deplacement() {
//         Y = event.pageY - Yinit
//         Ysave = event.pageY
//
//
//
//         console.log(Y > 0)
//
//         if((Y > 20) || (testDeplacement == true) || Y < -20) {
//             testDeplacement = true
//             $('.container2').css('margin-top', Y)
//             // document.getElementById("container3").removeEventListener('mouseup', container3animation)
//         }
//
//     }
//
//
//
//
//     // ----------------------------------------------------------- FIN DE DEPLACEMENT
//
//
//     function finDeplacement() {
//         console.log('up')
//         removeHandler()
//
//         // console.log('EVENT.PAGEX : ' + event.pageY)
//         // console.log('DEBUT : ' + $('.container2').css('margin-top'))
//         // console.log('Ysave : ' + Ysave)
//         // console.log('IF : ' + (event.pageY - Ysave))
//
//         // RECUPERATION DU DEPLACEMENT
//         var deplacement = event.pageY - Ysave
//
//         console.log('DEPLACEMENT : ' + deplacement)
//         console.log('EVENT : ' + event.pageY)
//
//         if(((3 * deplacement) < DeplacementMax) && ((3 * deplacement) > -DeplacementMax)) {
//             deplacement *= 3
//         } else {
//             if(deplacement > 0) {
//                 deplacement = DeplacementMax;
//             } else {
//                 deplacement = -DeplacementMax;
//             }
//         }
//
//         // Animation de fin de déplacement
//         $('.container2').animate(
//             {
//                 marginTop: "+=" + deplacement
//             },
//             500,
//             function() {
//                 repositionnement()
//             }
//         )
//
//         // Réinitialisation du (des) Listener(s) précédement remove
//         // document.getElementById("container3").addEventListener('mouseup', container3animation)
//
//         // Réinitialisation de testDeplacement
//         testDeplacement = false
//
//     }
//
//
//
//
//
//
//
//
//     // ----------------------------------------------------------- REPOSITIONNEMENT
//
//
//     function repositionnement() {
//
//         // Repositionnement TOP
//         if(parseInt($('.container2').css('margin-top')) > 0) {
//             $('.container2').animate({
//                 marginTop: "0"
//             }, 150)
//         }
//
//
//         // Repositionnement BOTTOM
//         else if(parseInt($('.container2').css('margin-top')) < -Hmax) {
//             $('.container2').animate({
//                 marginTop: "-" + Hmax
//             }, 150)
//         }
//     }
//
//
//
//
//
//
//
//
//     // ----------------------------------------------------------- REMOVE HANDLER
//
//
//     function removeHandler() {
//         document.getElementById("myDIV").removeEventListener("mousemove", deplacement);
//     }
//
//
//
//
//
//
//
//     // ----------------------------------------------------------- ANIMATION RANDOM
//
//     function container3animation() {
//         $(this).css('background-color', 'blue')
//     }
//
//
//
//
//
//
//
//
//
//
//     /* *************************************
//                 EVENT LISTENER
//     ************************************* */
//
//
//     $('.container1').mousedown(function(e) {
//         console.log('down')
//         Ysave = e.pageY
//         Yinit = e.pageY - parseInt($('.container2').css('margin-top'))
//
//         var eGLOBAL = e
//         intervalID = setInterval(saveY(eGLOBAL), 500);
//
//         document.getElementById("myDIV").addEventListener("mousemove", deplacement);
//
//     });
//
//
//     function saveY(e) {
//         Ysave = e.pageY;
//         console.log(e);
//         // Ysave = event.pageY
//         console.log('Ysave :' + Ysave)
//     }
//
//
//
//
//
//
//     //    $('.container2').scroll()
//
// })