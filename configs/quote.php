<?php
if (!isset($_SESSION)) {
  session_start();
}
include '../connect.php';
include '../init.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $userid = $_SESSION['id'];
  $QPostBody = filter_var($_POST['qpostbody'], FILTER_SANITIZE_STRING);
  if (strlen($QPostBody) > 255 || strlen($QPostBody) < 1) {
    echo "Please Write a post less than 255 letters and more than 1 letter.";
  } else {
    $QPostStmt = $db->prepare('INSERT INTO posts(body, post_date, user_id, stars, Q) VALUES (:qpostbody, NOW(), :userid, 0, 1)');
    $QPostStmt->execute(array(
      ':qpostbody'     => $QPostBody,
      ':userid'       => $userid,
    ));
    $QPostBody = '';
    echo "VALID";
  }
}
