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
    <title>Anonynous Messages | GoStalker</title>
</head>

<body style="background-color:#f3f3f3;">
    <?php include $template . 'header.php';?>
    <div class="notifi-section">
        <h3 style="border-bottom:1px solid  #cacaca;font-size: 20px;">Anonymous Messages</h3>
        <div class="notifi-content">
            <?php
            $userid = $_SESSION['id'];
            $AnonyStmt = $db->prepare('SELECT * FROM anonymous_messages WHERE to_user=:userid ORDER BY id DESC');
            $AnonyStmt->execute(array(':userid' => $userid));
            if ($AnonyStmt) {
              foreach ($AnonyStmt as $AnonyRows) {
                echo
                  "<div class='notifi-news'>";
                if ($AnonyRows['type'] == 1) {
                  $NicePic = "<a class='user-avatar'" .
                    'style="background-image:url(' . "'img/Nice.svg');border-radius:0;" . '"></a>';
                  echo  $NicePic;
                } else {
                  $BadPic = "<a class='user-avatar'" .
                    'style="background-image:url(' . "'img/Evil.svg');border-radius:0;" . '"></a>';
                  echo  $BadPic;
                }
                echo '<span class="notifi-span">';
                if ($AnonyRows['type'] == 1) {
                  $TypeofMessage = 'Nice';
                  echo  $TypeofMessage;
                } else {
                  $TypeofMessage = 'Bad';
                  echo  $TypeofMessage;
                }
                echo  ' Message</span>
                          <span> : "' . Emojione\Emojione::toImage($AnonyRows['body']) . '"</span>
                          <div class="notifi-time">
                              <span class="notifi-timespan">' . $AnonyRows['mess_date'] . '</span>
                          </div>
                      </div>';
              }
            }

            ?>
        </div>
    </div>
    <?php include $template . 'footer.php';?>
</body>

</html> 