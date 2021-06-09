<?php
if (!isset($_SESSION)) {
  session_start();
}
include '../connect.php';
include '../init.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $userid = $_SESSION['id'];
  $Postid = filter_var($_POST['p_id'], FILTER_SANITIZE_NUMBER_INT);

  $MyPostsStars = $db->prepare('SELECT user_id FROM post_stars WHERE post_id=:postid AND user_id=:userid');
  $MyPostsStars->execute(array(':postid' => $Postid, ':userid' => $userid));
  $RowPostsStars = $MyPostsStars->fetch();
  if (!$RowPostsStars) {

    $MyPostsStars = $db->prepare("UPDATE posts SET stars=stars+1 WHERE id=:postid");
    $MyPostsStars->execute(array(':postid' =>  $Postid));

    $MyPostsStars2 = $db->prepare("INSERT INTO post_stars(post_id, user_id) VALUES (:postid, :userid)");
    $MyPostsStars2->execute(array(':postid' => $Postid, ':userid' => $userid));
  } else {
    $MyPostsStars = $db->prepare("UPDATE posts SET stars=stars-1 WHERE id=:postid");
    $MyPostsStars->execute(array(':postid' =>  $Postid));

    $MyPostsStars2 = $db->prepare("DELETE FROM post_stars WHERE post_id=:postid AND user_id=:userid");
    $MyPostsStars2->execute(array(':postid' =>  $Postid, ':userid' => $userid));
  }
}

