$(function() {
  'use strict';
  $('#fullnameID').blur(function(){
    if ($(this).val().length < 3 || $(this).val().length > 30) {
        $('#fullnameID').css('border', '1px solid #bb4a4c');
        return false;
    } else if ($("#fullnameID").is(":focus")) {
      $('#fullnameID').css('border', '1px solid #8e859a');
    } else {
      $('#fullnameID').css('border', '1px solid #047d3b');
    }
  });
  $('#emailID').blur(function(){
      if ($(this).val() === '') {
          $('#emailID').css('border', '1px solid #bb4a4c');
          return false;
      } else {
          $('#emailID').css('border', '1px solid #047d3b');
      }
    });
    $('#usernameID').blur(function(){
      if ($(this).val().length < 3 || $(this).val().length > 40) {
          $('#usernameID').css('border', '1px solid #bb4a4c');
          return false;
      } else {
          $('#usernameID').css('border', '1px solid #047d3b');
      }
    });
    $('#password').blur(function(){
       if ($(this).val().length < 8 || $(this).val() === '') {
           $('#password').css('border', '1px solid #bb4a4c');
           return false;
       } else {
           $('#password').css('border', '1px solid #047d3b');
       }
     });
});
var password = document.getElementById("password")
  , confirm_password = document.getElementById("confirm_password");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
    $('#confirm_password').css('border', '1px solid #bb4a4c');
  } else {
    confirm_password.setCustomValidity('');
    $('#confirm_password').css('border', '1px solid #047d3b');
  }
}
password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
