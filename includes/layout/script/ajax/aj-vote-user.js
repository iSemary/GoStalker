$(document).on('submit', '#vote-form', function(e) {
  e.preventDefault();
  $.ajax({
      url: "../gostalker/configs/vote.php",
      type: "POST",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
      beforeSend: function(wait) {
          $('#main-success').hide();
          $('#main-error').hide();
          $('#main-wait').show();
      },
      success: function(response) {
          if (response = "VALID") {
            $('#main-wait').hide();
            $('#post-success').html('Vote successfully sent.');
            $('#main-success').show();
            $('#main-success').fadeOut(5000);
          } else {
            $('#main-wait').hide();
            $('#post-success').html(response);
            $('#main-success').show();
            $('#main-success').fadeOut(5000);
          }
          
      },
      error: function(error) {
          $('#main-wait').hide();
          $('#main-error').show();
      }
  });
});