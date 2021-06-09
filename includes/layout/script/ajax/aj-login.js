$(document).on('submit','#login-form',function(e){
    e.preventDefault();
      $.ajax({
      url: "../gostalker/configs/login.php",
      type: "POST",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData:false,
      beforeSend:function(wait){
        $('#type-wait').html('Logging in, please wait...');
        $('#main-wait').show();
        $('#main-error').hide();
      },
      success:function(response){
        if (response = 'VALID') {
          $('#main-wait').hide();
          $('#type-error').hide();
          location.href = "http://localhost/GoStalker/home"
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
