<?php
include 'connect.php';
include 'init.php';
?>
<!DOCTYPE html>
<html>
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
    <title>Home | GoStalker</title>
    <meta name="description" content="GoStalker helps you to get freinds feedback as votes and good or evil messages !">
    <meta name="keywords" content="GoStalker, gostalker, Go Stalker, Social Networking, Social Network, voting, votes, nice&evil, Q&Q, stalker, stalkers">
    <!--[if It IE 9]>
      <script src="<?php echo $js; ?>html5shiv.min.js"></script>
      <script src="<?php echo $js; ?>respond.min.js"></script>
    <![endif]-->
  <title>Forgot Password</title>
</head>
<body>
  <style>
    .login-form {height: 180px;}
    .section1 {margin-top: 5px;}
  </style>
  <header>
    <div class="fix-header">
      <div class="gostalkericon">
          <a href="home">
              <img src="img/GoStalker45.png" title="GoStalker ! Do it !"></a>
      </div>
      <div style="margin-top: 10px;" class="nav-stalk">
          <a class="sign-top" href="login">Login</a>
      </div>
   </div>
  </header>
 <div class="loginsection">
     <div class="section1">
         <form action="" method="POST" class="login-form" id="forps-form">
             <div class="formy">
                 <label>E-mail</label>
                 <input type="email" name="email" class="inputform" maxlength="50" autocomplete="on" placeholder="Type your E-mail" required="required" autofocus="on">
             </div>
             <div class="formy">
                 <button type="submit" class="signupbtn" name="reset">Reset Password</button>
             </div>
           </form>
         </div>
         <?php
         include $template . 'error-section.php';
         include $template . 'footer.php';
          ?>
<script type="text/javascript" src="<?php echo $js; ?>ajax/aj-forget-pass.js"></script>
  </body>
</html>
