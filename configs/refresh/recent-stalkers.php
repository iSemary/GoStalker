<?php
if (!isset($_SESSION['username'])) {
  session_start();
}

$userid = $_SESSION['id'];
?>
<div class="section-info">
    <h1>RECENTLY ACTIVE STALKERS</h1>
    <div class="recent-stalkers">

      <?php

     $FollowUserStmt = $db->prepare("SELECT DISTINCT users.userid, users.userstatus, users.username, users.gender, users.fullname, users.avatar FROM users  WHERE  users.userid != :userid AND users.userstatus = 0  ORDER BY rand() LIMIT 18");
     $FollowUserStmt->execute(array(':userid'=>$userid));
     $RowFollowUser = $FollowUserStmt->fetchAll();
      foreach ($RowFollowUser as $RowFollowSug) {
        echo  '<a href="'.$RowFollowSug['username'].'" title="'.$RowFollowSug['fullname'].'">
        <img src="';
        if (empty($RowFollowSug['avatar'])) {
          if ($RowFollowSug['gender'] == 1) {
            echo  'img/male-user.png">';
          }else {
            echo  'img/female-user.png">';
          }
        } else {
        echo  "gsuploads/gsavatar/".$RowFollowSug['avatar'].'">';
        }
      echo '</a>';
      }
       ?>
    </div>
</div>
