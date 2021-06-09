$(document).on('submit','#chpa-form',function(e){
    e.preventDefault();
      $.ajax({
      url: "../gostalker/configs/ch-pas.php",
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
          $('#main-success').html('Password changed successfully !');
          window.setTimeout(function(){
                  window.location.href = "https://localhost/GoStalker/login";
              }, 2000);
       }else{
        $('#main-wait').hide();
        $('#type-error').hide();
        $('#main-success').html(response);
        }    
      },
      error:function(error){
        $('#main-wait').hide();
        $('#main-error').show();
      }
    });
  });
