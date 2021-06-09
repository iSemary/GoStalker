<?php
session_start();
if (isset($_SESSION['username'])) { } elseif (isset($_COOKIE['GS'])) {
  require 'api/classes/logged.php';
} else {
  header('location: signup');
  exit();
}
include 'connect.php';
include 'init.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta lang="en" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <link href="favico.ico" rel="icon" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo $css; ?>style.css" />
    <link rel="stylesheet" href="<?php echo $css; ?>normalize.css" />
    <link rel="stylesheet" href="<?php echo $css; ?>font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo $css; ?>bootstrap.css" />
    <link rel="stylesheet" href="<?php echo $css; ?>emojionearea.min.css" />
    <link rel="stylesheet" href="<?php echo $css; ?>aos.css" />
    <script type="text/javascript" src="includes/layout/script/jquery-3.3.1.min.js"></script>
    <meta name="description" content="GoStalker helps you to get freinds feedback as votes and good or evil messages !">
    <!--[if It IE 9]>
      <script src="<?php echo $js; ?>html5shiv.min.js"></script>
      <script src="<?php echo $js; ?>respond.min.js"></script>
    <![endif]-->

    <title>Messages | GoStalker</title>
</head>

<body>
    <?php include $template . 'header.php'; ?>
    <div class="chat-all">
        <div class="messagesleft" style="width:100%">
            <div class="messagescontent">
                <div class="messagecount">
                    <?php
                    $userid = $_SESSION['id'];

                    $MessagesStmt = $db->prepare("SELECT DISTINCT receiver FROM messages WHERE sender = :sender ORDER BY id DESC");
                    $MessagesStmt->execute(array(':sender' => $userid));
                    $GetMessages = $MessagesStmt->fetchAll();
                    if ($GetMessages) {

                      foreach ($GetMessages as $GetMessagesB) {
                        $HisUserid = $GetMessagesB['receiver'];

                        $MessageCounter = $db->prepare("SELECT COUNT(receiver) FROM ( SELECT DISTINCT receiver FROM messages WHERE receiver = ? OR sender = ? ) AS messagescount");
                        $MessageCounter->execute(array($HisUserid, $userid));
                        $MessageCounterRow = $MessageCounter->fetch();
                      }
                      ?>
                    <h5>Messages(<?php echo $MessageCounterRow[0]; ?>)</h5>
                </div>
                <div class="messagesection">
                    <?php
                    foreach ($GetMessages as $GetMessagesB) {
                      $MyTalkers = $db->prepare('SELECT userid, username, avatar, gender, fullname FROM users WHERE userid=:userid');
                      $MyTalkers->execute(array(':userid' => $HisUserid));
                      $Talkers = $MyTalkers->fetchAll();

                      foreach ($Talkers as $TheTalkers) {
                        $HisUserid = $GetMessagesB['receiver'];

                        $GetLastMsg = $db->prepare("SELECT * FROM messages WHERE receiver = ? ORDER BY id DESC LIMIT 1");
                        $GetLastMsg->execute(array($TheTalkers['userid']));
                        $GetLast = $GetLastMsg->fetchAll();
                        foreach ($GetLast as $GetLastF) {

                          echo '
                        <div class="usermessage mar">
                            <div class="userprofile">
                            <a href="SendMessages/' . $TheTalkers['username'];
                          if (empty($TheTalkers['avatar'])) {
                            if ($TheTalkers['gender'] == 1) {
                              echo '"><img class="user-profile-img" src="img/male-user.png" width="50px" height="50px"/></a>';
                            } else {
                              echo '"><img class="user-profile-img" src="img/female-user.png" width="50px" height="50px"/></a>';
                            }
                          } else {
                            echo '"><img class="user-profile-img" src="gsuploads/gsavatar/' . $TheTalkers['avatar'] . '"width="50px" height="50px"/></a>';
                          }

                          echo
                            '<h4>' .  $TheTalkers['fullname'] . '</h4>
                            </div>
                            <a class="no14" style="color:black" href="sendmessages/' . $TheTalkers['username'] . '">
                            <div class="message-short';
                          if ($GetLastF['chat_read'] == 0) {
                            echo "";
                          } else {
                            echo " seen-it";
                          }
                          echo '"><h6>';
                          if (strlen($GetLastF['body']) > 35) {
                            $MessageBody = substr($GetLastF['body'], 0, 35) . '...';
                          } else {
                            $MessageBody = $GetLastF['body'];
                          }
                          $messDate =  strtotime($GetLastF['chat_date']);
                          echo $MessageBody . '</h6></div></a>
                             <div class="timestamp"><img class="clock-ico" src="img/clock.svg"/><span>' . date('Y-M-j | g:i:s a', $messDate) . '</span></div>
                             </div>';
                        }
                      }
                    }
                  } else {
                    echo "<div class='no-found'><h5>You don't Have any Messages.</h5></div>";
                  }

                  ?>

                </div>
            </div>
            <?php
            include $template . 'footer.php';
            ?>
        </div>
    </div>
</body>

</html> 