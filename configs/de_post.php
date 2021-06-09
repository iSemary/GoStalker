<?php
if (!isset($_SESSION)) {
  session_start();
}
include '../connect.php';
include '../init.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $userid = $_SESSION['id'];
  $Postid = filter_var($_POST['po_id'], FILTER_SANITIZE_NUMBER_INT);

  $GetPost = $db->prepare("SELECT post_img FROM posts WHERE id = ? AND user_id = ?");
  $GetPost->execute(array($Postid, $userid));
  $GetPostF = $GetPost->fetch();
  $DeletePostStmt = $db->prepare('DELETE FROM posts WHERE id=:postid AND user_id=:userid');
  $DeletePostStmt->execute(array(
    ':postid'       => $Postid,
    ':userid'       => $userid
  ));

  if (isset($GetPostF['post_img'])) {
    $PostImglocation = "../gsuploads/gspostsimg/" . $GetPostF['post_img'];
    unlink($PostImglocation);
    exit();
  }
}

