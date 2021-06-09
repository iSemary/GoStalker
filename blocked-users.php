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

    <title>Stalkers | GoStalker</title>
    <meta name="description" content="GoStalker helps you to get freinds feedback as votes and good or evil messages !">
    <meta name="keywords" content="GoStalker, gostalker, Go Stalker, Social Networking, Social Network, voting, votes, evilorgood, stalker, stalkers">
</head>

<body style="background-color:#f3f3f3;">
    <?php include $template . 'error-section.php'; ?>
    <?php include $template . 'header.php'; ?>
    <?php 
    $myUserid = $_SESSION['id'];
    $NumBlockingStmt = $db->prepare("SELECT COUNT(from_id) FROM block WHERE from_id = ?");
    $NumBlockingStmt->execute(array($myUserid));
    $CountBlocking = $NumBlockingStmt->fetch();
    ?>

    <div class="stalkersform">
        <div class="stalkers" <?php if ($CountBlocking[0] == 0) {
                                echo 'style="display:none"';
                              } ?>>
            <h6>Your BlockList&#58;</h6>
            <div class="users"></div>
        </div>
        <?php
        if ($CountBlocking[0] == 0) {
          echo  "<div class='no-found'><h5>You don't have any blocked users.</h5><br><strong>if someone annoy you, block that user.</strong></div>";
        }
        ?>
    </div>
    <?php
    include $template . 'footer.php';
    ?>
    <script type="text/javascript" src="<?php echo $js; ?>ajax/aj-block.js"></script>
</body>

</html> 