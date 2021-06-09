$(document).on('submit', '#post-form', function(e) {
  e.preventDefault();
  $.ajax({
      url: "../gostalker/configs/post.php",
      type: "POST",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
      beforeSend: function(wait) {
          $('#main-wait').show();
      },
      success: function(response) {
          if (response ='VALID') {
              $('#main-wait').hide();
              $('#type-error').hide();
              $('#post-success').html('Your post successfully published !');
              $('#main-success').fadeIn(1000);
              $('#main-success').fadeOut(5000);
              $('#preview-post').attr('src', '');
              $("#post-area").val('');
              $("#imgPostID").val('');
              // Add new post by jquery
          }else{
            $('#main-wait').hide();
            $('#type-error').hide();
            $('#post-success').html(response);
            $('#main-success').fadeIn(1000);
            $('#main-success').fadeOut(5000);
          }
      },
      error: function(error) {
          $('#main-wait').hide();
          $('#main-error').show();
      }
  });
});
$(document).on('submit', '#quote-form', function(e) {
  e.preventDefault();
  if ($('#quote-area').val().length < 1 || $('#quote-area').val().length > 255) {
      $('#post-error').html('Posts must be more than 5 letters and less than 255 letters.');
      $('#type-error').fadeIn(1000);
      $('#type-error').fadeOut(5000);
  } else {
      $.ajax({
          url: "../gostalker/configs/quote.php",
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
                  $('#type-error').hide();
                  $('#post-success').html('Your quote successfully published !');
                  $('#main-success').fadeIn(1000);
                  $('#main-success').fadeOut(5000);
                  $("#quote-area").val('');
    
                  // Add new qoute by jquery
              } else {
                $('#main-wait').hide();
                $('#type-error').hide();
                $('#post-success').html(response);
                $('#main-success').fadeIn(1000);
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