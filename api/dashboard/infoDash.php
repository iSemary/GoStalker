<?php
if(!isset($_SESSION)) { session_start(); }
if (isset($_SESSION['username'])) {
  include '../connect.php';
  include '../init.php';
  if ($_SESSION['id'] == 1) {
    $RowUsers = $db->prepare('SELECT `userid`, `fullname`, `username`, `email` ,`gender`, `avatar`, `cover`, `verifiedaccount`, `regstatus`, `birthdate`, `userstatus` FROM users');
    $RowUsers->execute();
    $RowUsersF = $RowUsers->fetchAll();

    // Count Members
    $CountUsers = $db->prepare('SELECT count(*) from users'); $CountUsers->execute(); $CountUsersF = $CountUsers->fetch();
    // Count Votes
    $CountVotes = $db->prepare('SELECT count(*) from votes'); $CountVotes->execute(); $CountVotesF = $CountVotes->fetch();
    // Count Members
    $CountReport = $db->prepare('SELECT count(*) from reports'); $CountReport->execute(); $CountReportF = $CountReport->fetch();
    // Count Votes
    $CountVotes = $db->prepare('SELECT count(*) from votes'); $CountVotes->execute(); $CountVotesF = $CountVotes->fetch();
    // Count Votes
    $CountMen = $db->prepare('SELECT count(*) from users WHERE gender = 1'); $CountMen->execute(); $CountMenF = $CountMen->fetch();
    // Count Female
    $CountWomen = $db->prepare('SELECT count(*) from users WHERE gender = 2'); $CountWomen->execute(); $CountWomenF = $CountWomen->fetch();
    // Count Female
    $CountMess = $db->prepare('SELECT count(*) from Messages'); $CountMess->execute(); $CountMessF = $CountMess->fetch();



  } else {include '../404.php';die();}
}
?>
