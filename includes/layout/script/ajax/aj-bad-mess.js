$(document).on('submit', '#bad-form', function(e) {
  e.preventDefault();
  if ($('#emojiPickBad').val().length < 1 || $('#emojiPickNice').val().length > 255) {
      $('#post-error').html('Something went wrong, Please check this:<br>Message more than 1 letter.<br>Message less than 255 letter.');
      $('#type-error').fadeIn(1000);
      $('#type-error').fadeOut(5000);
  } else {
      $.ajax({
          url: "../gostalker/configs/anon-bad.php",
          type: "POST",
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData: false,
          beforeSend: function(wait) {
              $('#main-wait').show();
          },
          success: function(response) {
              if (response = "VALID") {
                $('.emojionearea-editor').html('');
                $('#main-wait').hide();
                $('#post-success').html('Your bad message has been sent.');
                $('#main-success').show();
                $('#main-success').fadeOut(5000);
              } else {
                $('.emojionearea-editor').html('');
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
  }
});