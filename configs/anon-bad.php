<?php
if (!isset($_SESSION)) {
  session_start();
}
include '../connect.php';
include '../init.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $userid = $_SESSION['id'];
  $MessageBody = filter_var($_POST['BadMess'], FILTER_SANITIZE_STRING);
  $Hisusername = filter_var($_POST['userexi'], FILTER_SANITIZE_STRING);
  $NotfimessType = '101';


  $username = $db->prepare('SELECT userid,username FROM users WHERE username=:username');
  $username->execute(array(':username' => $Hisusername));
  $rowuser = $username->fetch();
  $RowUserid = $rowuser['userid'];

  if (strlen($MessageBody) > 255 || strlen($MessageBody) < 1) {
    // put error
  }else {
    $BadMesstStmt = $db->prepare('INSERT INTO anonymous_messages(body, type, mess_date, from_user, to_user) VALUES (:messbody, 0, NOW(), :userid, :toid)');
    $BadMesstStmt->execute(array(
      ':messbody'     => $MessageBody,
      ':userid'       => $userid,
      ':toid'       => $RowUserid
    ));
    $NotifStmt = $db->prepare('INSERT INTO notifications(type, sender, receiver, notification_date) VALUES (:type, :userid, :toid, NOW())');
    $NotifStmt->execute(array(
      ':type'       => $NotfimessType,
      ':userid'       => $userid,
      ':toid'       => $RowUserid
    ));
    echo "VALID";
  }
}

