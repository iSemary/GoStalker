<?php
session_start();
if (isset($_SESSION['username'])) {} elseif (isset($_COOKIE['GS'])) {
  require 'api/classes/logged.php';
} else {
  header('location: 404');
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
    <title>Change Email</title>
</head>

<body>
    <style>
        .section1{margin-top: 5px}
    .login-form {height: 225px}
  </style>
    <header>
        <div class="fix-header">
            <div class="gostalkericon">
                <a href="home.php">
                    <img src="img/GoStalker45.png" title="GoStalker ! Do it !"></a>
            </div>
            <div style="margin-top: 10px;" class="nav-stalk">
                <a class="sign-top" href="login.php">Login</a>
            </div>
        </div>
    </header>
    <div class="loginsection">
        <div class="section1">
            <form action="" method="POST" class="login-form" id="chema-form">
                <div class="formy">
                    <h3 class="stalk-setlabel" style="margin:5px;">Change Email</h3>
                    <input type="email" name="email" class="inputform" placeholder="Type your new Email" required />
                    <input type="password" name="password" placeholder="Type your password" class="inputform" autocomplete="off" required />
                </div>
                <div class="formy">
                    <button type="submit" class="signupbtn" name="reset-password">Change Email</button>
                </div>
            </form>
        </div>
        <?php
        include($template . 'error-section.php');
        include($template . 'footer.php');
        ?>
        <script type="text/javascript" src="<?php echo $js; ?>ajax/aj-ch-mail.js"></script>
</body>

</html> 