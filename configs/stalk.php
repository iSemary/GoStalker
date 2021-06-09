<?php
if (!isset($_SESSION)) {
  session_start();
}
include '../connect.php';
include '../init.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $userid = $_SESSION['id'];
  $Hisusername = filter_var($_POST['userexi'], FILTER_SANITIZE_STRING);

  $username = $db->prepare('SELECT userid,username FROM users WHERE username=:username');
  $username->execute(array(':username' => $Hisusername));
  $rowuser = $username->fetch();
  $RowUserid = $rowuser['userid'];

  $FollowUserStmt = $db->prepare("SELECT * FROM followers Where user_id = $RowUserid AND follower_id = $userid");
  $FollowUserStmt->execute();
  $RowFollowUser = $FollowUserStmt->fetch();
  $FollowCount = $FollowUserStmt->rowCount();
  $FollowHim = $RowFollowUser['user_id'];

  if ($FollowHim != $RowUserid) {
    $FollowUserStmt = $db->prepare('INSERT INTO followers(user_id, follower_id) VALUES (:userid, :followerid)');
    $FollowUserStmt->execute(array(
      ':userid'     => $RowUserid,
      ':followerid' => $userid
    ));
    echo "VALID";
  } else {
    $FollowUserStmt = $db->prepare('DELETE FROM followers WHERE user_id = ? AND follower_id = ?');
    $FollowUserStmt->execute(array($RowUserid, $userid));
    echo "VALID";
  }
}

