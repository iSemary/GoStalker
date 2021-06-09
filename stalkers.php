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
    <meta name="description" content="GoStalker stalkers contain everybody you stalked before to get in touch with them easily.">
    <meta name="keywords" content="GoStalker, gostalker, Go Stalker, Social Networking, Social Network, voting, votes, evilorgood, stalker, stalkers">
</head>
<style>
    .stalkers-search  .searchtopbig {width: 67%;}
          .stalkers-search  .search-bar-big label {right: 35%;}
        </style>

<body style="background-color:#f3f3f3;">
    <?php include $template . 'header.php'; ?>
    <div class="stalkersform">
        <?php
        $myUserid = $_SESSION ['id'];
        // Fetch follower Info
        $FollowUserStmt = $db->prepare("SELECT * FROM followers Where follower_id = ? ORDER BY id DESC");
        $FollowUserStmt->execute(array($myUserid));
        $RowFollowUser = $FollowUserStmt->fetchAll();

        // count followers
        $NumFollowingStmt = $db->prepare("SELECT COUNT(user_id) FROM `followers` WHERE follower_id = ?");
        $NumFollowingStmt->execute(array($myUserid));
        $CountFollowing = $NumFollowingStmt->fetch();
        ?>
        <h3>Stalk on people to get stalked back, votes, messages and everything awesome!</h3>
        <div class="stalkershead stalkers-search">
            <div class="counterstalkers">Stalking &#58;
                <span>
                    <?php echo $CountFollowing[0]; ?></span>
            </div>
            <form action="search.php" method="GET">
                <div class="search-bar-big searchi">
                    <input class="searchtopbig" name="q" placeholder="Search..." />
                    <label for="Searchbtn3"><i class="fa fa-search"></i></label>
                    <input type="submit" id="Searchbtn3" value="Search" hidden>
                </div>
            </form>
        </div>
        <div class="stalkers" <?php if ($CountFollowing[0] == 0) {
                                echo 'style="display:none"';
                              } ?>>
            <h6>Your Stalkers&#58;</h6>
            <div class="users">
                <?php
                foreach ($RowFollowUser as $RowsFollowUser) {
                  $RowyUsersidS = $RowsFollowUser['user_id'];

                  $RowyUsersStmt = $db->prepare("SELECT userid,username,fullname,avatar,gender,userstatus FROM users WHERE userid = ?");
                  $RowyUsersStmt->execute(array($RowyUsersidS));
                  $RowyFollowUser = $RowyUsersStmt->fetchAll();
                  foreach ($RowyFollowUser as $RowMyFollowUser) {
                    $UserStatus = $RowMyFollowUser['userstatus'];
                    if ($UserStatus == 0) {

                      echo  '<div class="stalker-user">' .

                        '<a style="background-image:url(';
                      if (empty($RowMyFollowUser['avatar'])) {
                        if ($RowMyFollowUser['gender'] == 1) {
                          echo "'img/male-user.png";
                        } else {
                          echo "'img/female-user.png";
                        }
                      } else {
                        echo  "'gsuploads/gsavatar/" . $RowMyFollowUser['avatar'];
                      }

                      echo  "')" . '"' . 'class="useravatar" href="http://localhost/gostalker/' . $RowMyFollowUser['username'] . '"></a>' .
                        '<a class="visit" href="http://localhost/gostalker/' . $RowMyFollowUser['username'] . '">' . 'Visit</a>' . '<a class="user-content" href="http://localhost/gostalker/' . $RowMyFollowUser['username'] . '">'  .  '<span>' . $RowMyFollowUser['fullname'] . '</span>' . '</a>' .  '</div>';
                    }
                  }
                }
                ?>
            </div>
        </div>
        <?php
        if ($CountFollowing[0] == 0) {
          echo  "<div class='no-found'><h5>You don't have any stalkers !</h5> <strong>Go Stalk people, Don't be shy !</strong></div>";
        }

        ?>
    </div>
    <?php
    include $template . 'footer.php';
    ?>
</body>

</html> 