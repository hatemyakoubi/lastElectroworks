// $("#abscence_form").on("submit", function(event) {
//     // on récupère les valeurs du formulaire
//     var values = $(this).serialize();
//     // On affiche des messages à travers Ajax
//     $.ajax({
//         type        : "POST",
//         url         : "{{ path('presence_abscence_new') }}",
//         data        : values,
//         success     : function(datas) {
//             if(datas == "ok") {

//                 console.log('hello');
//                 setTimeout(function() {
//                 $("#exampleModal").modal("toggle");
//                 }, 1000);
//             }
//         }
//     });
// });
// $(function () {
//     $('#abscence_form').submit(function (event) {
//         event.preventDefault();
//         var data = $('#abscence_form').serialize();
//         var values = $(this).serialize();
//         $.ajax({
//             url: "{{path('presence_abscence_new')}}",
//             type: 'POST',
//             data: data,
//             dataType: "json",
//             success: function (response) {
//                 console.log(response);
//             }
//         });
//     });
// });
// $(document).ready(function(){
//         $("#openBtn").on("click",function(e){
//            $.ajax({
//         url : path('App\\Controller\\PresenceAbscenceController::newAbscence'),
//         data: {"donnees":[]},//tes données à envoyer
//         type : POST,
//         success : function(data){
//             $('.modal-body').html(data); // Utiliser un id serait plus précis        
// }
//         });
//         return false;
//        });
//  });