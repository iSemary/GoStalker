<?php
include 'connect.php';
include 'init.php';


session_start();
  if (isset($_COOKIE['GS'])) {
    $stmtToken = $db->prepare("DELETE FROM login_token WHERE user_id = ?");
    $stmtToken->execute(array($_SESSION['id']));
  }

    setcookie('GS', '1', time()-3600 , '/', null, null, true);

    setcookie('GS_', '1', time()-3600,'/', null, null, true);

    session_unset();

    session_destroy();

    header('location: signup');

      exit();
