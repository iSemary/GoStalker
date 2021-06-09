$(document).on('submit','#chema-form',function(e){
    e.preventDefault();
      $.ajax({
      url: "../gostalker/configs/ch-ema.php",
      type: "POST",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData:false,
      beforeSend:function(wait){
        $('#type-wait').html('Please wait...');
        $('#main-wait').show();
        $('#main-error').hide();
      },
      success:function(response){
        if (response = "VALID") {
          $('#main-wait').hide();
          $('#type-error').hide();
          $('#post-success').html('Email changed successfully !<br>You will be redirect to home...');
          $('#main-success').show();
          window.setTimeout(function(){
                  window.location.href = "http://localhost/GoStalker/login";
              }, 2000);
        }else{
        $('#main-wait').hide();
        $('#post-error').html(response);
        $('#type-error').fadeIn(1000);$('#type-error').fadeOut(5000);
      }
      },
      error:function(error){
        $('#main-wait').hide();
        $('#main-error').show();
      }
    });
  });
