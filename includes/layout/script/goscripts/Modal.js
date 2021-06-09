$(document).ready(function(){ $("#profilePic").click(function(){ $("#myPhoto").show(function(){ $(".close").click(function(){ $("#myPhoto").css('display','none'); }); }); });
});
$(document).ready(function(){
  $("#CoverPic").click(function(){ $("#myCover").show(function(){ $(".close").click(function(){ $("#myCover").css('display','none'); }); }); });
});
