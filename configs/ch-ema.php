<?php
if (!isset($_SESSION)) {
  session_start();
}
include '../connect.php';
include '../init.php';
require 'classes/mail.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $userid = $_SESSION["id"];
  $email  = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
  $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

  $pass   = sha1($_POST['password']);

  $Checkuser = $db->prepare('SELECT userid, username,`password`,email FROM users WHERE userid = ?');
  $Checkuser->execute(array($userid));
  $Checkuserf = $Checkuser->fetch();
  $userpass = $Checkuserf['password'];
  $useremail = $Checkuserf['email'];

  $formErrors = array();
  if ($userpass != $pass) {
    $formErrors[] = '<h5>You typed a wrong password.</h5>';
  } elseif (empty($password)) {
    $formErrors[] = '<h5>Password can\'t be empty.</h5>';
  } elseif (strlen($password) < 8) {
    $formErrors[] = '<h5>Password can\'t be less than<strong>8 characters.</strong></h5>';
  } elseif (empty($email)) {
    $formErrors[] = '<h5>Email cant be empty.</h5><br>';
  } elseif (!filter_var($email, FILTER_VALidATE_EMAIL)) {
    $formErrors[] = '<h5>Invalid email format !<br>ex: user@example.com</h5><br>';
  }

  if (empty($formErrors)) {
    $ChEmail = $db->prepare("UPDATE users SET email = ? WHERE userid = ? AND password = ?");
    $ChEmail->execute(array($email, $userid, $pass));
    Mail::setFrom('Email Changed!', 'Your Email had been changed. If you have any problem, help or idea just contact us: Mail: GoStalkerInc@gmail.com', $useremail);
    echo "VALID";
  } else {
      foreach ($formErrors as $error) {
        echo $error;
    }
  }
}

