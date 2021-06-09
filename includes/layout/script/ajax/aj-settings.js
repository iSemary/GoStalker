$(document).on('submit', '#settings-form', function(e) {
  e.preventDefault();
  $.ajax({
      url: "../gostalker/configs/setting.php",
      type: "POST",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
      beforeSend: function(wait) {
          $('#main-wait').show();
          $('#submit-btn').prop('disabled', true);
          $('#submit-btn').css("filter","contrast(0)");
      },
      success: function(response) {
          $('#main-wait').hide();
          $('#type-error').fadeIn(1000);
          $('#type-error').fadeOut(5000);
          $('#submit-btn').prop('disabled', false);
          $('#submit-btn').css("filter","contrast(1)");

          if (response === "VALID") {
              $('#main-wait').hide();
              $('#type-error').hide();
              $('#main-success').fadeIn(1000);
              $('#main-success').fadeOut(5000);
            //   window.setTimeout(function() {
            //       window.location.href = "http://localhost/GoStalker/myprofile";
            //   }, 2000);
          }else{
            $('#main-wait').hide();
            $('#type-error').hide();
            $('#post-success').html(response);
            $('#post-success').fadeIn(1000);
            $('#post-success').fadeOut(5000);
          }
          
      },
      error: function(error) {
          $('#main-wait').hide();
          $('#main-error').show();
      }
  });
});
$(document).keypress(
  function(event) {
      if (event.which == '13') {
          event.preventDefault();
      }
  });