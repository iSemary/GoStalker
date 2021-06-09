$(document).on('submit', '#report-form', function(e) {
  e.preventDefault();
  $.ajax({
      url: "../gostalker/configs/report.php",
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
            $('#main-wait').hide();
            $('#main-success').show();
            $('#post-success').html('Report successfully send !');
            $('#main-success').fadeOut(2000);
            $('.report-section').fadeOut(2000);
          } else {
            $('#main-wait').hide();
            $('#main-success').show();
            $('#post-success').html(response);
            $('#main-success').fadeOut(2000);
            $('.report-section').fadeOut(2000);
          }
         
      },
      error: function(error) {
          $('#main-wait').hide();
          $('#main-error').show();
      }
  });
});