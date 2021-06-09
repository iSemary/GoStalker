<!DOCTYPE html>
<html>
<?php
include 'init.php';
    if (!isset($_SESSION)) {session_start();}
    if (isset($_SESSION['id'])) {
      include 'connect.php';
    ?>
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
    <title>Page Not Found | GoStalker</title>
    </head>
    <body>
        <?php include $template . 'header.php';} else { include $template . 'header-out.php';} ?>
        <div class="content-404">
            <div class="container-err">
                <div class="error">
                    <img src="img/404.png" alt="404 Error Not Found">
                    <br>
                    <h3>Sorry, The requested page not available.</h3>
                    <ul>
                        <li>Check the url/username for typing errors.</li>
                        <li>The page might have been removed or unavailable right now.</li>
                        <li>Maybe account has been disabled.</li>
                    </ul>
                    <div class="btns">
                        <button class="back-btn" onclick="history.go(-1);">Back </button>
                        <button class="contact-btn" onClick="javascript:window.location.href='conditions#list-item-5'">Contact us </button>
                        <button class="help-btn" onClick="javascript:window.location.href='conditions#list-item-0'">Help</button>
                    </div>
                </div>
            </div>
            <?php include ($template . 'footer.php'); ?>
        </div>
    </body>
</html>
