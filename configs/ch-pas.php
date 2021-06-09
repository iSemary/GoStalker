<?php
if (!isset($_SESSION)) {
  session_start();
}
include '../connect.php';
include '../init.php';
require 'classes/mail.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $token = filter_var($_POST['gd-ps'], FILTER_SANITIZE_STRING);

  $stmtTokenPass = $db->prepare("SELECT * FROM password_token WHERE token = :token");
  $stmtTokenPass->execute(array(':token' => sha1($token)));
  $StmtTokenFetch = $stmtTokenPass->fetch();
  $Tokenid = $StmtTokenFetch['user_id'];

  if (sha1($token) != $StmtTokenFetch['token']) {
    echo "<strong>Invaled Token</strong>";
  } else {


    $password1 = filter_var($_POST['newpassword'], FILTER_SANITIZE_STRING);
    $password2 = filter_var($_POST['newpasswordagain'], FILTER_SANITIZE_STRING);
    $passSha = sha1($password1);

    $formErrors = array();
    if (empty($password1)) {
      $formErrors[] = '<h5>Password can\'t be empty.</h5>';
    }
    elseif (strlen($password1) < 8) {
      $formErrors[] = '<h5>Password can\'t be less than<strong>8 characters.</strong></h5>';
    }
    elseif ($password1 != $password2) {
      $formErrors[] = '<h5>You typed wrong password.</h5>';
    }

    foreach ($formErrors as $error) {
      echo $error;
    }
    if (empty($formErrors)) {
      // Delete the token
      $DeleteToken = $db->prepare('DELETE FROM password_token WHERE user_id = ?');
      $DeleteToken->execute(array($Tokenid));
      // Update the password
      $ChangeStmt = $db->prepare('UPDATE users SET password = ? WHERE userid = ?');
      $ChangeStmt->execute(array($passSha, $Tokenid));

      // SELECT Email from userid
      $Emailfromid = $db->prepare("SELECT email, fullname FROM users WHERE userid = ?");
      $Emailfromid->execute(array($Tokenid));
      $EmailfromidF = $Emailfromid->fetch();
      $email = $EmailfromidF['email'];

      Mail::setFrom('Password Changed!', 'Your password had been changed. If you have any problem, help or idea just contact us: Mail: GoStalkerInc@gmail.com', $email);
      echo "VALID";
    }
  }
}

