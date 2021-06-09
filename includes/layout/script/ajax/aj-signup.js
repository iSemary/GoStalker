$(document).on('submit','#signup-form',function(e){
    e.preventDefault();
      $.ajax({
      url: "../gostalker/configs/signup.php",
      type: "POST",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData:false,
      beforeSend:function(wait){
        $('#type-wait').html('Signup successfully !<br>Logging in, please wait...');
        $('#main-wait').show();
        $('#main-error').hide();
      },
      success:function(response){
        $('#main-wait').hide();
        $('#post-error').html(response);
        $('#type-error').fadeIn(1000);$('#type-error').fadeOut(5000);
        if (response == '') {
          $('#main-wait').hide();
          $('#type-error').hide();
          location.href = "https://localhost/GoStalker/home"
        }
      },
      error:function(error){
        $('#main-wait').hide();
        $('#main-error').show();
      }
    });
  });
  $(document).ready(function(){ $(".close-error").click(function(){ $(".main-error").css('display','none'); }); });
