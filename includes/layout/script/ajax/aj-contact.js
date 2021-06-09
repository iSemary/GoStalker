function isValidEmailAddress(emailAddress) {
  var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
  return pattern.test(emailAddress);
}

function contact() {
  $(document).on('submit', '#contact-form', function(e) {
      e.preventDefault();
      $.ajax({
          url: "../gostalker/configs/contact.php",
          type: "POST",
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData: false,
          beforeSend: function(wait) {
              $('#main-wait').show();
          },
          success: function(response) {
              $('#main-wait').hide();
              $('#post-error').html(response);
              $('#type-error').fadeIn(1000);
              $('#type-error').fadeOut(5000);
              if (response = 'VALID') {
                  $('#main-wait').hide();
                  $('#main-error').hide();
                  $('#type-error').hide();
                  $('#post-success').html('Your message has been sent.');
                  $('#main-success').fadeIn(1000);
                  $('#main-success').fadeOut(3000);
                  $('input[type]').val('');
                  $('.commentContact').val('');
              }else {
                $('#main-wait').hide();
                $('#main-error').hide();
                $('#type-error').hide();
                $('#post-success').html(response);
                $('#main-success').fadeIn(1000);
                $('#main-success').fadeOut(3000);
                $('input[type]').val('');
                $('.commentContact').val('');
              }
          },
          error: function(error) {
              $('#main-wait').hide();
              $('#main-error').show();
          }
      });
  });
}