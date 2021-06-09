<?php
if (!isset($_SESSION)) {
  session_start();
}
include '../connect.php';
include '../init.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $userid = $_SESSION['id'];
  $Hisusername = filter_var($_POST['userexi'], FILTER_SANITIZE_STRING);
  $MessageBody = filter_var($_POST['message-a'], FILTER_SANITIZE_STRING);

  $username = $db->prepare('SELECT userid,username FROM users WHERE username=:username');
  $username->execute(array(':username' => $Hisusername));
  $rowuser = $username->fetch();
  $Toid = $rowuser['userid'];

  $formErrors = array();
  if (strlen($MessageBody) > 255 || strlen($MessageBody) < 1) {
    $formErrors[] = '<h5>Message must be more than 1 letters and less than 255 letters.</h5>';
  }
  if (empty($formErrors)) {
    $SendMessageA = $db->prepare("INSERT INTO messages(body, sender, receiver, chat_date) VALUES(:bodymessagea, :sender, :receiver, NOW())");
    $SendMessageA->execute(array(
      ':bodymessagea' => $MessageBody,
      ':sender' => $userid,
      ':receiver' => htmlspecialchars($Toid)
    ));
    $MessageBody = '';
    // If first message
    //   $NotfimessTypeV = '104';
    //   $NotifStmt = $db->prepare('INSERT INTO notifications(type, sender, receiver, notification_date) VALUES (:type, :userid, :toid, NOW())');
    //   $NotifStmt->execute(array(
    //     ':type'       => $NotfimessTypeV,
    //     ':userid'       => $userid,
    //     ':toid'       => htmlspecialchars($Toid)
    //     ));
    echo "VALID";
  } else {
    foreach ($formErrors as $error) {
      echo $error;
    }
  }
}

