// $(function() {
//
//   'use strict';
//
//   $('.fullNameContact').blur(function(){
//     if ($(this).val().length < 3) {
//
//         $(this).parent().find('.fullnameError').fadeIn(200);
//
//         $('.fullnameError').css('display', 'flex');
//
//         $('.fullNameContact').css('border', '2px solid #bb4a4c');
//         error = true;
//
//     } else {
//
//         $(this).parent().find('.fullnameError').fadeOut(200);
//
//         $('.fullNameContact').css('border', '2px solid #047d3b');
//
//     }
//   });
//   $('.emailContact').blur(function(){
//       if ($(this).val() === '') {
//
//           $(this).parent().find('.emailError').fadeIn(200);
//
//           $('.emailError').css('display', 'flex');
//
//           $('.emailContact').css('border', '2px solid #bb4a4c');
//           error = true;
//
//       } else {
//
//           $(this).parent().find('.emailError').fadeOut(200);
//
//           $('.emailContact').css('border', '2px solid #047d3b');
//
//       }
//     });
//     $('.subjectContact').blur(function(){
//       if ($(this).val().length < 2) {
//
//           $(this).parent().find('.subjectError').fadeIn(200);
//
//           $('.subjectError').css('display', 'flex');
//
//           $('.subjectContact').css('border', '2px solid #bb4a4c');
//           error = true;
//
//       } else {
//
//           $(this).parent().find('.subjectError').fadeOut(200);
//
//           $('.subjectContact').css('border', '2px solid #047d3b');
//
//       }
//     });
//      $('.commentContact').blur(function(){
//         if ($(this).val().length < 10) {
//
//             $(this).parent().find('.commentError').fadeIn(200);
//
//             $('.commentError').css('display', 'flex');
//
//             $('.commentContact').css('border', '2px solid #bb4a4c');
//
//             error = true;
//
//         } else {
//
//             $(this).parent().find('.commentError').fadeOut(200);
//
//             $('.commentContact').css('border', '2px solid #047d3b');
//
//         }
//       });
//       if (error = false) {
//         $.ajax({ url: "api/contact.php", type: "POST", data: new FormData(this), contentType: false, cache: false, processData:false, beforeSend:function(wait){ $('#main-wait').show();},
//         success:function(response){
//           $('#main-wait').hide();
//           $('#main-success').show();},
//         error:function(error){
//           $('#main-wait').hide();
//           $('#main-error').show();}
//         });
//       }
// });
