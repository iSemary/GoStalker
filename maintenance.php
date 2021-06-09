<?php include 'init.php'; ?>
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

    <title>GoStalker Maintenance</title>
</head>

<body>
    <?php
    include $template . 'header-out.php';
    ?>
    <div id="main">
        <div class="content-404">
            <div class="container-err">
                <div class="error">
                    <img src="img/maintenance.png">
                    <br>
                    <h3>GoStalker is under maintenance.</h3>
                    <ul>
                        <li>It will take several minutes.</li>
                        <li>That's mean we're working to make it better.</li>
                        <li>We are adding some new features.</li>
                    </ul>
                    <div class="btns">
                        <button class="back-btn" onclick="history.go(-1);">Back </button>
                        <button class="contact-btn" href="">Contact us </button>
                        <button class="help-btn" href="">Help</button>
                    </div>
                </div>
            </div>
            <?php include($template . 'footer.php'); ?>
        </div>
    </div>
</body>

</html> 