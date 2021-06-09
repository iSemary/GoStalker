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
    <title>Deactivate Account</title>
</head>
<style media="screen">
    .center-section {margin-left: -70px;padding-left: 23%;}
  .center-section h5{max-width:700px;}
</style>

<body>
    <?php include $template . 'header.php';?>
    <div class="">
        <div class="col-12">
            <div class="center-section">
                <h4>Deactivate Account</h4>
                <h5>Do you want to disable your account ?</h5>
                <h5>Deactivate your account won't delete your information, it will be saved but still hide and no one able to see your account until you log in again.</h5>
                <form action="" method="POST" id="deactive-account">
                    <h3 class="stalk-setlabel">Enter Your Password&#58;</h3>
                    <input type="password" name="password" class="stalk-form" placeholder="Password" required>
                    <input type="submit" name="sub-de" class="signupbtn" value="Deactivate">
                </form>
            </div>
        </div>
    </div>
    <?php
    include($template . 'error-section.php');
    include($template . 'footer.php');
    ?>
    <script type="text/javascript" src="<?php echo $js; ?>ajax/aj-deactive.js"></script>
</body>

</html> 