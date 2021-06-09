$(document).on('submit', '#block-form', function(e) {
  e.preventDefault();
  $.ajax({
      url: "../gostalker/configs/block.php",
      type: "POST",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
      beforeSend: function(wait) {
          $('#main-wait').show();
          $('#main-error').hide();
      },
      success: function(response) {
        if (response = "VALID") {
          $('#main-wait').hide();
          $('#post-success').html('This user has been blocked.');
          $('#main-success').show();
          $('#main-success').fadeOut(2000);
          $('.block-section').fadeOut(2000);
          setTimeout(function() {
              window.location.reload(1);
          }, 2000);
        }else{
            $('#main-wait').hide();
            $('#post-success').html(response);
            $('#main-success').show();
            $('#main-success').fadeOut(2000);
            $('.block-section').fadeOut(2000);
        }

      },
      error: function(error) {
          $('#main-wait').hide();
          $('#main-error').show();
      }
  });
});