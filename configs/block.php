<?php
if (!isset($_SESSION)) {
  session_start();
}
include '../connect.php';
include '../init.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $myUserid = $_SESSION['id'];
  $Hisusername = filter_var($_POST['userexi'], FILTER_SANITIZE_STRING);

  $username = $db->prepare('SELECT userid,username FROM users WHERE username=:username');
  $username->execute(array(':username' => $Hisusername));
  $rowuser = $username->fetch();
  $RowUserid = $rowuser['userid'];

  $BlockStmt = $db->prepare("INSERT INTO block(from_id, to_id, block_date) VALUES(:zme, :zhim, NOW())");
  $BlockStmt->execute(array(':zme' => $myUserid, ':zhim' => $RowUserid));

  // Remove from freinds
  $DeleteStalk = $db->prepare("DELETE FROM `followers` WHERE follower_id = '$myUserid' AND user_id = '$RowUserid'");
  $DeleteStalk->execute();
  // Remove me from him
  $DeleteStalk2 = $db->prepare("DELETE FROM `followers` WHERE follower_id = '$RowUserid' AND user_id = '$myUserid'");
  $DeleteStalk2->execute();

  // Remove from freinds
  $DeleteMessage = $db->prepare("DELETE FROM `messages` WHERE sender = '$myUserid' AND receiver = '$RowUserid'");
  $DeleteMessage->execute();
  // Remove me from him
  $DeleteMessage2 = $db->prepare("DELETE FROM `messages` WHERE receiver = '$myUserid' AND sender = '$RowUserid'");
  $DeleteMessage2->execute();
  echo "VALID";
}
 