$(document).on('submit', '#message-form', function(e) {
  e.preventDefault();
  $.ajax({
      url: "../../gostalker/configs/message.php",
      type: "POST",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
      beforeSend: function(wait) {
          $('#send-btn').html('Sending');
      },
      success: function(response) {
          if (response = 'VALID') {
              $('#send-btn').html('Send');
              var text = $('.message-body').val();
              var img = $('.profilepic').attr('style');

              function addLeadingZeros(dateItem) {
                  if (dateItem.toString().length < 2) {
                      dateItem = '0' + dateItem;
                  }
                  return dateItem;
              }
              date = new Date();
              month = addLeadingZeros(date.getMonth() + 1);
              day = addLeadingZeros(date.getDay());
              hour = addLeadingZeros(date.getHours());
              minute = addLeadingZeros(date.getMinutes());
              second = addLeadingZeros(date.getSeconds());
              dateFormated = date.getFullYear() + '-' + month + '-' + day + ' ' + hour + ':' + minute + ':' + second;

              $(".chatlogs").append('<div class="chat self"><div class="user-photo"><div class="user-photo" style="' + img + '"></div></div><p class="chat-message">' + text + '</p><div class="timestamp">' + dateFormated + '</div></div>');
              $('.message-body').val('');
          } else {
              $('#post-error').html(response);
              $('#type-error').fadeIn(1000);
              $('#type-error').fadeOut(2000);
              $('#send-btn').html('Send');
          }
      },
      error: function(error) {
          $('#main-wait').hide();
          $('#main-error').show();
      }
  });
});