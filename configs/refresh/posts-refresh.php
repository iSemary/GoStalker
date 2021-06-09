<?php
if (!isset($_SESSION['username'])) {
  session_start();
}
include 'connect.php';
// Emoji
require('includes/lib/php/autoload.php');
Emojione\Emojione::$imagePathPNG = './../assets/png/';

$userid = $_SESSION['id'];
$stmt = $db->prepare("SELECT userid,username,fullname,cover,avatar,verifiedaccount FROM users WHERE userid = ?");
$stmt->execute(array($userid));
$row = $stmt->fetch();
$count = $stmt->rowCount();

// Fetch Posts Table
$MyPostsStmt = $db->prepare("SELECT * FROM posts Where user_id = $userid  ORDER BY id DESC");
$MyPostsStmt->execute();
$GetMyPostsStmt = $MyPostsStmt->fetchAll();

foreach ($GetMyPostsStmt as $posts) {
  $MyPostsStars = $db->prepare('SELECT post_id FROM post_stars WHERE post_id=:postid AND user_id=:userid');
  $MyPostsStars->execute(array(':postid' => $posts['id'], ':userid' => $userid));
  $RowPostsStars = $MyPostsStars->fetch();

  $postdate =  strtotime($posts['post_date']);
  // QOUTE POST
  if ($posts['q'] == 1) {
      $leftQoute = '<span class="Q-post"><i class="fa fa-quote-left"></i> </span>';
    } else {
      $leftQoute = '';
    }
    if ($posts['q'] == 1) {
      $rightQoute = '<span class="Q-post"><i class="fa fa-quote-right"></i> </span>';
    } else {
      $rightQoute = '';
    }
    echo
    "<div class='global-posts'>
        <div class='post-section'><div class='user-post'>
        <div class='delete-post'>
            <form action='' method='POST' id='del_post'>
            <input type='text' id='post_id' name='po_id' value='".$posts["id"]."' hidden>
            <button type='submit' name='deletePost' id='bin-trash'><i class='fa fa-trash'></i></button>
            </form>
        </div>
        <a style=" . 'background-image:url(' . "'gsuploads/gsavatar/" . $row['avatar'] . "')"  . ' class="useravatar"' .  " href='myprofile'></a>" .
        "<a class='user-content' href='myprofile'>" .
            "<span>" . $row['fullname'] . "</span>
            <div class='timestamp' title='" . date( 'Y-M-j | g:i:s a', $postdate ) . "'>" .  date( 'Y-M-j | g:i a', $postdate ) . "</div>
        </a>
    </div>" .
    '<div class="status-content">' . $leftQoute . '<span>' . Emojione\Emojione::toImage(htmlspecialchars($posts['body'])) . ' </span>' . $rightQoute .
'</div>';

if (empty($posts['post_img'])) {
} else {
  echo '<a>
     <img src="gsuploads/gspostsimg/' . $posts['post_img'] . '"' . ' class="img-post"width="300" height="200">
  </a>';
}
echo '<form action="" method="POST" id="star-form"><div class="desc">
        <a class="star-in" id="'.$posts['id'].'"></a><span>Stars: <span id="st_num">' . $posts['stars'] . '</span></span></div>
              <span class="star"></span>
              <input type="text" name="p_id" value="'.$posts['id'].'" hidden>
              <input type="text" name="u_id" value="'.$userid.'" hidden>';
              if (!$RowPostsStars) {
                echo '<input class="star-yell" type="submit" name="Star" value="Star">';
              } else {
                echo '<input class="star-yell" type="submit" name="Star" value="Unstar">';
              }
            echo '</form>
        </div></div>';
      }
if (!$GetMyPostsStmt) {
echo "<div class='no-found'><h5>You didn't post anything yet.</h5></div>";
}
?>
