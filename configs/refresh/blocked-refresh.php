<?php
if (!isset($_SESSION['username'])) {
  session_start();
}
include '../../connect.php';

$myUserid = $_SESSION['id'] ;

$stmt = $db->prepare("SELECT userid,username,gender FROM users WHERE userid = ?");
$stmt->execute(array($myUserid));
$row = $stmt->fetch();
// Fetch Blocker Info
$BlockUserStmt = $db->prepare("SELECT * FROM `block` Where from_id = ? ORDER BY id DESC");
$BlockUserStmt->execute(array($myUserid));
$RowBlockUser = $BlockUserStmt->fetchAll();


foreach ($RowBlockUser as $RowsBlockUser) {
$RowyUsersidS = $RowsBlockUser['to_id'];
$RowyUsersStmt = $db->prepare("SELECT userid,username,fullname,avatar,gender FROM users WHERE userid = ?");
$RowyUsersStmt->execute(array($RowyUsersidS));
$RowyBlockUser = $RowyUsersStmt->fetchAll();
foreach ($RowyBlockUser as $RowMyBlockUser) {
  echo  '<div class="stalker-user">' .

      '<a style="background-image:url('
      ;
      if(empty($RowMyBlockUser['avatar'])) {
            if ($RowMyBlockUser['gender'] == 1) {
              echo "'img/male-user.png";
            } else {
              echo "'img/female-user.png";
            }
          } else {
            echo  "'gsuploads/gsavatar/" . $RowMyBlockUser['avatar'];
          }

      echo  "')" . '"' . 'class="useravatar"></a>' .
      '<form action="" method="POST" id="blocked-form"><button class="un-block visit" type="submit">un-block</button><input type="hidden" name="u-id" autocomplete="off" value="'.$RowMyBlockUser['userid'].'"></form>' . '<a class="user-content">'  .  '<span>' . $RowMyBlockUser['fullname'] . '</span>' . '</a>' .  '</div>';
    }
  }

?>
