var starBtn = document.getElementsByClassName('star-yell');
$(document).on('submit', '#star-form', function(e) {
    e.preventDefault();
    $.ajax({
        url: "../gostalker/configs/star_btn.php",
        type: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function(wait) {},
        success: function(response) {},
        error: function(error) {
            $('#main-wait').hide();
            $('#main-error').show();
        }
    });
    var stars = $(this).find('#st_num').html();
    var starsP = parseInt(stars) + parseInt(1);
    var starsM = parseInt(stars) - parseInt(1);
    if ($(this).find(starBtn).val() == 'Star') {
        $(this).find(starBtn).val('Unstar');
        $(this).find("#st_num").html(starsP);

    } else {
        $(this).find(starBtn).val('Star');
        $(this).find("#st_num").html(starsM);
    }
});