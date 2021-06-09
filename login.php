<?php
session_start();
if (isset($_SESSION['username'])) {
    header('location: home');
} elseif (isset($_COOKIE['GS'])) {
    require 'api/classes/logged.php';
    header('location: home');
} else { }
include 'connect.php';
include 'init.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta lang="en" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>GoStalker | Login</title>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <link rel="stylesheet" href="<?php echo $css; ?>style.css" />
    <link rel="stylesheet" href="<?php echo $css; ?>normalize.css" />
    <link rel="stylesheet" href="<?php echo $css; ?>font-awesome.min.css" />
    <link href="favico.ico" rel="icon" type="image/x-icon">
    <meta name="description" content="Login to your GoStalker account and see what happend today !">
    <meta name="keywords" content="GoStalker, gostalker, Go Stalker, Social Networking, Social Network, voting, votes, evilorgood, stalker, stalkers">
    <!--[if It IE 9]>
        <script src="<?php echo $js; ?>html5shiv.min.js"></script>
        <script src="<?php echo $js; ?>respond.min.js"></script>
            <![endif]-->
    <style>
        .col-12 {
          -webkit-box-flex: 0;
          -ms-flex: 0 0 100%;
          flex: 0 0 100%;
          max-width: 100%;
          position: relative;
          width: 100%;
          min-height: 1px;
          padding-right: 15px;
          padding-left: 15px;
        }
        .Er3.col-12 {
          position: relative;
          margin:5px 0;
          padding-left: 0px;
        }
        .main-sect1 .shape {
          width: 400px;}
        </style>
</head>

<body>
    <header style="position:relative;">
        <div class="gostalkericon">
            <a href="signup">
                <img src="img/GoStalker45.png" title="GoStalker ! Do it !"></a>
        </div>
        <div class="nav-stalk">
            <a class="sign-top" href="signup">Signup</a>
        </div>
    </header>
    <?php include $template . 'error-section.php'; ?>
    <div class="loginsection">
        <div style="margin-top:10px;" class="section1">
            <form action="" method="POST" class="login-form" id="login-form">
                <div class="formy">
                    <label>Username or e-mail</label>
                    <input type="text" name="username" class="inputform stalk-form" pattern=".{3,}" title="You must type at least 3 letters" value="<?php if (isset($username)) {
                                                                                                                                                echo $username;
                                                                                                                                            } ?>" maxlength="200" autocomplete="on" placeholder="Username or e-mail" required="required" autofocus="on">
                </div>
                <div class="formy">
                    <label>Password</label>
                    <input type="password" name="password" pattern=".{8,}" title="You must type at least 8 character" class="inputform stalk-form" placeholder="Password" required="required" autocomplete="off">
                </div>
                <div class="formy">
                    <button type="submit" class="signupbtn" name="login">Login</button>
                </div>
                <div class="rmmbr-forget">
                    <div class="rmmbr">
                        <label class="switch">
                            <input type="checkbox" name="remember_me" value="1" checked>
                            <span class="slider round"></span>
                        </label>
                        <h4>Remember me</h4>
                    </div>
                    <div style="float: right;" class="forget-pass">
                        <span>Forgot <a href="forget-password.php">password?</a></span>
                    </div>
                </div>
                <div class="login-with formy">
                    <h4>Login with:</h4>
                    <ul>
                        <li><img src="img/facebook_api.svg" height="50px" width="50px" /></li>
                        <li><img src="img/twitter_api.svg" height="50px" width="50px" /></li>
                        <li><img src="img/vk_api.svg" height="50px" width="50px" /></li>
                        <li><img src="img/gmail_api.svg" height="50px" width="50px" /></li>
                    </ul>
                </div>
            </form>
        </div>
    </div>

    <?php
    include $template . 'footer.php'; ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".close-error").click(function() {
                $(".main-error").css('display', 'none');
            });
        });
    </script>
    <script type="text/javascript" src="<?php echo $js; ?>ajax/aj-login.js"></script>

</body>

</html> 