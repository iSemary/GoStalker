var CountFollowers = document.getElementById('sp-stkrs').textContent;
var CountFollowerP = parseInt(CountFollowers) + parseInt(1);
var CountFollowerM = parseInt(CountFollowers) - parseInt(1);
$(document).on('submit', '#stalk-form', function(e) {
    e.preventDefault();
    $.ajax({
        url: "../gostalker/configs/stalk.php",
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
            if ($.trim($("#s-btn").html()) == 'Stalk') {
                $("#s-btn").attr('class', 'stalk-btn btn unStalk');
                $("#s-btn").html('Stalking');
                $('#post-success').html('Stalking !');
                $('#main-success').show();
                $('#main-success').fadeOut(2000);
                $("#sp-stkrs").html(CountFollowerP);
            } else {
                $("#s-btn").attr('class', 'stalk-btn btn');
                $('#post-success').html('UnStalking !');
                $('#main-success').show();
                $('#main-success').fadeOut(2000);
                $("#sp-stkrs").html(CountFollowerM);
                $("#s-btn").html('Stalk');
                $("#s-btn").hover(html("Stalk"));
            }
            } else {
                $('#post-success').html(response);
                $('#main-success').show();
                $('#main-success').fadeOut(2000);
            }
            
        },
        error: function(error) {
            $('#main-wait').hide();
            $('#main-error').show();
        }
    });
});