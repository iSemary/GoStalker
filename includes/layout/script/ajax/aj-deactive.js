$(document).on('submit','#deactive-account',function(e){
    e.preventDefault();
          $.ajax({ url: "../gostalker/configs/deactivate.php", type: "POST", data: new FormData(this), contentType: false, cache: false, processData:false, beforeSend:function(wait){$('#main-wait').show();},
          success:function(response){
            $('#main-wait').hide();
            $('#post-error').html(response);
            $('#type-error').fadeIn(1000);$('#type-error').fadeOut(5000);
            if (response == '') {
              $('#main-wait').hide();
              $('#type-error').hide();
              $('#post-success').html('Your account has been deactivated !');
              $('#main-success').fadeIn(1000);
              window.setTimeout(function(){
                      window.location.href = "https://localhost/GoStalker/signup";
                  }, 2000);
                }
          },
          error:function(error){
            $('#main-wait').hide();
            $('#main-error').show();}
        });
  });
