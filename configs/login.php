<?php
if (!isset($_SESSION)) {session_start();}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  include '../connect.php';
  include '../init.php';
  include('../api/classes/mail.php');

  $login = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
  $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

  $hashedPass = sha1($password);
  // Check if the user exist in database
  $stmt = $db->prepare("SELECT userid, username, email, `password`, userstatus FROM users WHERE (username = ? OR email = ?) AND password = ?");
  $stmt->execute(array($login, $login, $hashedPass));
  $row = $stmt->fetch();
  $count = $stmt->rowCount();
  // if count > 0 this mean the database contain record about this username
  if ($count > 0) {
    $_SESSION['username'] = $row['username']; // Register session name
    $_SESSION['id'] = $row['userid']; // Register session id

    // Login token uses for forget password - change email - etc
    $cstrong = true;
    $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));


    $RemoveOldToken = $db->prepare("DELETE FROM login_token WHERE user_id = ?");
    $RemoveOldToken->execute(array($_SESSION['id']));

    $stmtToken = $db->prepare("INSERT INTO login_token(token, user_id) VALUES (:ztoken, :zuser_id)");
    $stmtToken->execute(array(
      ':ztoken'   =>  sha1($token),
      ':zuser_id' =>  $_SESSION['id']
    ));
    if ($row['userstatus'] == 1) {
      $ActiveAgain = $db->prepare('UPDATE users SET userstatus = 0 WHERE userid = ?');
      $ActiveAgain->execute(array($row['userid']));
    }
    // remember_me
    if ($_POST["remember_me"] == 1) {
      $hour = time() + 6000 * 24 * 30;
      setcookie("GS", $token, $hour, '/', null, null, true);
      setcookie("GS_", '1', $hour, '/', null, null, true);
    }else {}
      echo "VALID";
  } else {
    $error = '<h5>Something Went Wrong !</h5>' . '<strong>Incorrect Username or Password.</strong>';
    echo $error;
  }
} else {}

