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
    <meta name="description" content="GoStalker notifications helps you to get in touch with anything happen to your activity like new votes, stalkers, anonymous messages and others...">
    <!--[if It IE 9]>
      <script src="<?php echo $js; ?>html5shiv.min.js"></script>
      <script src="<?php echo $js; ?>respond.min.js"></script>
    <![endif]-->

    <title>Notifications | GoStalker</title>
</head>

<body style="background-color:#f3f3f3;">
    <?php include $template . 'header.php'; ?>
    <div class="notifi-section">
        <h3 style="border-bottom:1px solid  #cacaca;font-size: 20px;">Notifications</h3>
        <div class="notifi-content">
            <?php
            $userid = $_SESSION['id'];
            $NotifStmt = $db->prepare('SELECT * FROM notifications WHERE receiver=:userid ORDER BY id DESC');
            $NotifStmt->execute(array(':userid' => $userid));
            $GetNotifStmt = $NotifStmt->fetchAll();
            if ($GetNotifStmt) {
              foreach ($GetNotifStmt as $NotifRows) {
                echo
                  "<div class='notifi-news'>";
                if ($NotifRows['type'] == 100) {
                  $NicePic = "<a class='user-avatar'" .
                    'style="background-image:url(' . "'img/Nice.svg');border-radius:0;" . '"></a>';
                  echo  $NicePic;
                } elseif ($NotifRows['type'] == 101) {
                  $BadPic = "<a class='user-avatar'" .
                    'style="background-image:url(' . "'img/Evil.svg');border-radius:0;" . '"></a>';
                  echo  $BadPic;
                } elseif ($NotifRows['type'] == 102 || $NotifRows['type'] == 105) {
                  $VotePic = "<a class='user-avatar'" .
                    'style="background-image:url(' . "'img/vote.svg');border-radius:0;" . '"></a>';
                  echo  $VotePic;
                } elseif ($NotifRows['type'] == 104) {
                  $NewMess = "<a class='user-avatar'" .
                    'style="background-image:url(' . "'img/message.svg');border-radius:0;" . '"></a>';
                  echo  $NewMess;
                }
                echo '<span class="notifi-span">Someone</span>
                         <span>';
                if ($NotifRows['type'] == 100) {
                  $TypeofMessage = '<span>Send you</span>' . 'a Nice Message';
                  echo  $TypeofMessage . '</span>' . '<a href="anonymousmessages" class="notifi-span" style="text-decoration:none;"> click here to open it.</a>';
                } elseif ($NotifRows['type'] == 101) {
                  $TypeofMessage = '<span>Send you</span>' . 'an Evil Message';
                  echo  $TypeofMessage . '</span>' . '<a href="anonymousmessages" class="notifi-span" style="text-decoration:none;"> click here to open it.</a>';
                } elseif ($NotifRows['type'] == 102) {
                  $TypeofMessage = 'Send you a new vote on your profile !';
                  echo $TypeofMessage;
                } elseif ($NotifRows['type'] == 105) {
                  $TypeofMessage = 'Re-edit his vote on your profile !';
                  echo $TypeofMessage;
                } elseif ($NotifRows['type'] == 104) {
                  $TypeofMessage = 'Send you a message, check it.';
                  echo $TypeofMessage;
                }
                echo  '</span>
                          <div class="notifi-time">
                              <span class="notifi-timespan">' . $NotifRows['notification_date'] . '</span>
                          </div>
                      </div>';
              }
            // seen all 
            $SeenNotifications = $db->prepare("UPDATE notifications SET notification_seen = 0 WHERE receiver = ?");
            $SeenNotifications->execute(array($userid));
            } else {
              echo "<div class='no-found'><h5>You don't Have any Notifications.</h5></div>";
            }
            ?>
        </div>
    </div>
    <?php include $template . 'footer.php';?>
</body>

</html> 