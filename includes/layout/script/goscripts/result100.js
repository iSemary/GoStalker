'use strict';
// All Result
var FinalResult = parseInt($('#final-result').text());
// Smart Result
var ResultSmart = parseInt($('#result-smart').text());
document.getElementById("precent-smart").innerHTML = (ResultSmart * 100 / FinalResult).toFixed(0) + '%';
var ProVal1 = parseInt($('#precent-smart').text());
$('.progress3').val(ProVal1);

// Crazy Result
var ResultCrazy = parseInt($('#result-crazy').text());
document.getElementById("precent-crazy").innerHTML = (ResultCrazy * 100 / FinalResult).toFixed(0)  + '%';
var ProVal2 = parseInt($('#precent-crazy').text());
$('.progress2').val(ProVal2);
// Cute  Result
var ResultCute = parseInt($('#result-cute').text());
document.getElementById("precent-cute").innerHTML = (ResultCute * 100 / FinalResult).toFixed(0)  + '%';
var ProVal3 = parseInt($('#precent-cute').text());
$('.progress1').val(ProVal3);
// weird  Result
var ResultWeird = parseInt($('#result-weird').text());
document.getElementById("precent-weird").innerHTML = (ResultWeird * 100 / FinalResult).toFixed(0)  + '%';
var ProVal4 = parseInt($('#precent-weird').text());
$('.progress4').val(ProVal4);
// Hot  Result
var ResultHot = parseInt($('#result-hot').text());
document.getElementById("precent-hot").innerHTML = (ResultHot * 100 / FinalResult).toFixed(0)  + '%';
var ProVal5 = parseInt($('#precent-hot').text());
$('.progress5').val(ProVal5);
// Kind Result
var ResultKind = parseInt($('#result-kind').text());
document.getElementById("precent-kind").innerHTML = (ResultKind * 100 / FinalResult).toFixed(0)  + '%';
var ProVal6 = parseInt($('#precent-kind').text());
$('.progress6').val(ProVal6);


// Hate  Result
var ResultHate = parseInt($('#result-hate').text());
document.getElementById("precent-hate").innerHTML = (ResultHate * 100 / FinalResult).toFixed(0)  + '%';
var ProVal7 = parseInt($('#precent-hate').text());
$('#progress7').css('width',ProVal7);
// Love  Result
var ResultLove = parseInt($('#result-love').text());
document.getElementById("precent-love").innerHTML = (ResultLove * 100 / FinalResult).toFixed(0)  + '%';
var ProVal8 = parseInt($('#precent-love').text());
$('#progress8').css('width',ProVal8);
// Meet  Result
var ResultMeet = parseInt($('#result-meet').text());
document.getElementById("precent-meet").innerHTML = (ResultMeet * 100 / FinalResult).toFixed(0)  + '%';
var ProVal9 = parseInt($('#precent-meet').text());
$('#progress9').css('width',ProVal9);
// Missed  Result
var ResultMissed = parseInt($('#result-missed').text());
document.getElementById("precent-missed").innerHTML = (ResultMissed * 100 / FinalResult).toFixed(0)  + '%';
var ProVa20 = parseInt($('#precent-missed').text());
$('#progress10').css('width',ProVa20);


// Nervous  Result
var ResultNervous = parseInt($('#result-nervous').text());
document.getElementById("precent-nervous").innerHTML = (ResultNervous * 100 / FinalResult).toFixed(0)  + '%';
var ProVa21 = parseInt($('#precent-nervous').text());
$('#progress11').attr('data-percentage',ProVa21);
// Boring  Result
var ResultBoring = parseInt($('#result-boring').text());
document.getElementById("precent-boring").innerHTML = (ResultBoring * 100 / FinalResult).toFixed(0)  + '%';
var ProVa22 = parseInt($('#precent-boring').text());
$('#progress12').attr('data-percentage',ProVa22);
// Brave  Result
var ResultBrave = parseInt($('#result-brave').text());
document.getElementById("precent-brave").innerHTML = (ResultBrave * 100 / FinalResult).toFixed(0)  + '%';
var ProVa23 = parseInt($('#precent-brave').text());
$('#progress13').attr('data-percentage',ProVa23);
// Talented  Result
var ResultTalented = parseInt($('#result-talented').text());
document.getElementById("precent-talented").innerHTML = (ResultTalented * 100 / FinalResult).toFixed(0)  + '%';
var ProVa24 = parseInt($('#precent-talented').text());
$('#progress14').attr('data-percentage',ProVa24);
