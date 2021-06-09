<?php
if (!isset($_SESSION)) {
  session_start();
}
include '../connect.php';
include '../init.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $userid = $_SESSION['id'];

  $stmt = $db->prepare("SELECT userid,username,`password` FROM users WHERE userid = ?");
  $stmt->execute(array($userid));
  $row = $stmt->fetch();
  $PassBD = $row['password'];

  $pass = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
  $passSha = sha1($pass);

  $formErrors = array();
  if (strlen($pass) < 8) {
    $formErrors[] = '<h5>Password can\'t be less than  8 letters.</h5>';
  }
  elseif (empty($pass)) {
    $formErrors[] = '<h5>Password can\'t be empty.</h5>';
  }
  elseif ($PassBD != $passSha) {
    $formErrors[] = '<h5>Incorrect Password, Please try again.</h5>';
  }

  if (empty($formErrors)) {
    $Deact = $db->prepare("UPDATE users SET userstatus = 1 WHERE userid = ?");
    $Deact->execute(array($userid));

    if (isset($_COOKIE['GS'])) {
      $stmtToken = $db->prepare("DELETE FROM login_token WHERE user_id = ?");
      $stmtToken->execute(array($userid));
    }
    setcookie('GS', '1', time() - 3600);
    setcookie('GS_', '1', time() - 3600);
    session_unset();
    session_destroy();
  }else {
    foreach ($formErrors as $error) {
      die($error);
    }
  }
}

