// Profile

function readURLimg(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#preview-img').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#profilepic-sett").change(function() {
  readURLimg(this);
});

// COVER
function readURLcov(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#preview-cover').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#coverpic-sett").change(function() {
  readURLcov(this);
});

// POST IMG
function readURLpost(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#preview-post').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#imgPostID").change(function() {
  readURLpost(this);
});
