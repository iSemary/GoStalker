<?php
if (!isset($_SESSION)) {session_start();}

include '../connect.php';
include '../init.php';
require 'classes/mail.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
  $cstrong = true;
  $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));

  $useridstmt = $db->prepare("SELECT userid FROM users WHERE email = ?");
  $useridstmt->execute(array($email));
  $row = $useridstmt->fetch();
  $userid = $row['userid'];

  $EmailIsset = $db->prepare("SELECT user_id from password_token WHERE user_id = ?");
  $EmailIsset->execute(array($userid));
  $EmailIssetF = $EmailIsset->fetch();
  $EmailIssetuserid = $EmailIssetF['user_id'];

  $formErrors = array();
  if (empty($email)) {
    $formErrors[] = '<h5>Email cant be empty.</h5><br>';
  } elseif (!filter_var($email, FILTER_VALidATE_EMAIL)) {
    $formErrors[] = '<h5>Invalid email format !<br>Please type your email.</h5><br>';
  }

  if ($EmailIssetuserid == $userid) {
    echo  '<h5>You already recived an Email !</h5>';
  } else {
    if (empty($formErrors)) {

      $stmtToken = $db->prepare('INSERT INTO password_token(token, user_id) VALUES (:ztoken, :zuser_id)');
      $stmtToken->execute(array(
        ':ztoken'   =>  sha1($token),
        ':zuser_id' =>  $userid
      ));
      Mail::setFrom('Change Account Password', "<a href='http://localhost/GoStalker/change-password.php?token=$token'>http://localhost/GoStalker/change-password.php?token=$token</a>", $email);
      echo "VALID";
    } else {
      foreach ($formErrors as $error) {
        echo  $error;
      }
    }
  }
}

