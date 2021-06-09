$(".users").load("api/refresh/blocked-refresh.php");
$(document).on('submit', '#blocked-form', function(e) {
    e.preventDefault();
    $.ajax({
        url: "../gostalker/configs/blocked.php",
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
            $('#post-success').html(response);
            $('#main-success').fadeIn(1000);
            $('#main-success').fadeOut(5000);
            $(".users").load("api/refresh/blocked-refresh.php");
        },
        error: function(error) {
            $('#main-wait').hide();
            $('#main-error').show();
        }
    });
});