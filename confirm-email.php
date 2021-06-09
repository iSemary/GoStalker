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
    <title>Confirm Email</title>
</head>

<body>
    <?php include $template . 'header.php'; ?>
    <?php

    $userid = $_SESSION['id'];
    $EmailBD = $db->prepare("SELECT email FROM users WHERE userid = ?");
    $EmailBD->execute(array($userid));
    $EmailBDF = $EmailBD->fetch();
    $EmailBDC = $EmailBD->rowCount();
    $email = $EmailBDF['email'];
    if ($EmailBDC = 0 || !isset($_GET['confirmcode'])) {
      include '404.php';
      exit();
    } else {
      $CodeDB = $db->prepare("SELECT * FROM confirm_email WHERE email = ?");
      $CodeDB->execute(array($email));
      $CodeDBF = $CodeDB->fetch();

      $CodeGET = sha1($_GET['confirmcode']);
      $CodeInDB = $CodeDBF['code'];

      if ($CodeGET == $CodeInDB) {
        $RemoveCode = $db->prepare("DELETE FROM confirm_email WHERE code = ?");
        $RemoveCode->execute(array($CodeInDB));

        $AccountConfirmed = $db->prepare("UPDATE users SET regstatus = 1 WHERE userid = ?");
        $AccountConfirmed->execute(array($userid));
      }
    }
  
      ?>
    <div class="section-email">
        <div class="confirmed-email">
            <div class="main-sect1" id="main-success" style="margin:0">
                <div class="shapeII success"><i class="fa fa-check-circle"></i></div>
                <div class="shape shapes" id="post-success">Email Confirmed Successfully !<br>
                    <h6>Thank you for confirm your email.<h6><br>
                            <h6>You will be redirect to home page...<h6>
                </div>
            </div>
        </div>
    </div>
    <?php include($template . 'footer.php');?>
    <script type="text/javascript">
        window.setTimeout(function() {
            window.location.href = "https://localhost/GoStalker/home";
        }, 4000);
    </script>
</body>
</html>