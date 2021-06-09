$(function(){"use strict";$("#report-list").click(function(){$(".report-section").show(500,function(){$(this).css("display","grid")})}),$(".cloesd").click(function(){$(".report-section").hide(500,function(){})})});

// block

$(function() {

  'use strict';

  $("#block-list").click(function(){
    $(".block-section").show("slide", { direction: "right" }, 500, function(){
      $(this).css("display","grid");
    });
  });
  $(".cloesd").click(function(){
    $(".block-section").hide("slide", { direction: "right" },500, function(){
    });
  });
});
