<?php
session_start();
if (isset($_SESSION['username'])) {
} elseif (isset($_COOKIE['GS'])) {
  require 'api/classes/logged.php';
} else {
  header('location: signup');
  exit();
}
include 'connect.php';
include 'init.php';

$userid = $_SESSION['id'];
$stmt = $db->prepare("SELECT userid,fullname,username,birthdate FROM users WHERE userid =:userid");
$stmt->execute(array('userid' => $userid));
$row = $stmt->fetch();

$user_ids = $_SESSION['id'];
$stmt1 = $db->prepare("SELECT * FROM bios WHERE user_id = $user_ids");
$stmt1->execute();
$BioRow = $stmt1->fetchAll();
foreach ($BioRow as $Rows) { }
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
    <title>Home | GoStalker</title>
    <meta name="description" content="GoStalker helps you to get freinds feedback as votes and good or evil messages !">
    <meta name="keywords" content="GoStalker, gostalker, Go Stalker, Social Networking, Social Network, voting, votes, nice&evil, Q&Q, stalker, stalkers">
    <!--[if It IE 9]>
      <script src="<?php echo $js; ?>html5shiv.min.js"></script>
      <script src="<?php echo $js; ?>respond.min.js"></script>
    <![endif]-->
</head>

<body style="background-color:#f3f3f3;">
    <style media="screen"> .postit {width: 98%} </style>
    <?php include $template . 'header.php'; ?>
    <div class="totalhome">
        <div class="feedhome">
            <div class="headsection">
                <?php
                      // Final Vote Result
                $FinalVote = $db->prepare("SELECT SUM(smart NOT LIKE '0') AS smart0, SUM(crazy NOT LIKE '0') AS crazy1, SUM(cute NOT LIKE '0') AS cute2, SUM(kind NOT LIKE '0') AS kind3, SUM(hot NOT LIKE '0') AS hot4, SUM(weird NOT LIKE '0') AS weird5, SUM(love NOT LIKE '0') AS love6, SUM(hate NOT LIKE '0') AS hate7, SUM(missed NOT LIKE '0') AS missed8, SUM(meet NOT LIKE '0') AS meet9, SUM(nervous NOT LIKE '0') AS nervous10, SUM(boring NOT LIKE '0') AS boring11, SUM(brave NOT LIKE '0') AS brave12, SUM(talented NOT LIKE '0') AS talented13, SUM(dangerous NOT LIKE '0') AS dangerous14 FROM `votes` WHERE to_id = ?");
                $FinalVote->execute(array($userid));
                $FinalVotes = $FinalVote->fetchAll();
                foreach ($FinalVotes as $FinalVotesa) { }

                $ResultNumber = $FinalVotesa[0] + $FinalVotesa[1] + $FinalVotesa[2] + $FinalVotesa[3] + $FinalVotesa[4] + $FinalVotesa[5] + $FinalVotesa[6] + $FinalVotesa[7] + $FinalVotesa[8] + $FinalVotesa[9] + $FinalVotesa[10] + $FinalVotesa[11] + $FinalVotesa[12] + $FinalVotesa[13] + $FinalVotesa[14];
                ?>
                <form action="" method="post" id="post-form" enctype="multipart/form-data" class="post-form" accept-charset="UTF-8" style="width:100%">
                    <?php include $template . 'dynamic-post.php' ?>
                </form>
                <div class="miniprofile">
                    <div class="mini-info">
                        <h6>Share Your Profile</h6>
                        <div class="name-bio">
                            <?php echo ' ' . $row['fullname']; ?>
                        </div>
                        <div class="location-bio">
                            <?php if (isset($Rows['location'])) {
                              echo ' ' . $Rows['location'];
                            } else { } ?>
                        </div>
                        <div class="birth-bio">
                            <?php echo ' ' . $row['birthdate'] ?>
                        </div>
                        <div class="votes-bio">
                            <?php echo ' ' . $ResultNumber; ?><strong> Votes</strong></div>
                    </div>
                    <hr>
                    <ul>
                        <li><img src="img/facebook_api.svg" height="25px" width="25px" /></li>
                        <li><img src="img/twitter_api.svg" height="25px" width="25px" /></li>
                        <li><img src="img/vk_api.svg" height="25px" width="25px" /></li>
                        <li><img src="img/gmail_api.svg" height="25px" width="25px" /></li>
                    </ul>
                </div>
            </div>
            <hr>

            <div class="posts-section-home">
                <?php
                $HomePostsStmt = $db->prepare("SELECT posts.id, posts.q, posts.post_img, posts.body, posts.stars, posts.post_date, users.`username`, users.fullname, users.userstatus, users.avatar FROM users, posts, followers
                      WHERE posts.user_id = followers.user_id
                      AND users.userid = posts.user_id
                      AND follower_id = :follower_id
                      AND follower_id = :follower_id
                      AND users.userstatus = 0

                     ORDER BY posts.post_date DESC");
                $HomePostsStmt->execute(array(':follower_id' => $userid));
                $HomeScriptFollowing = $HomePostsStmt->fetchAll();

                foreach ($HomeScriptFollowing as $HomePosts) {
                  if ($HomePosts['q'] == 1) {
                    $leftQoute = '<span class="Q-post"><i class="fa fa-quote-left"></i> </span>';
                  } else {
                    $leftQoute = '';
                  }
                  if ($HomePosts['q'] == 1) {
                    $rightQoute = '<span class="Q-post"><i class="fa fa-quote-right"></i> </span>';
                  } else {
                    $rightQoute = '';
                  }
                  $postdate =  strtotime($HomePosts['post_date']);
                  // Statement to check if i liked the post or not
                  $MyPostsStars = $db->prepare('SELECT post_id FROM post_stars WHERE post_id=:postid AND user_id=:userid');
                  $MyPostsStars->execute(array(':postid' => $HomePosts['id'], ':userid' => $userid));
                  $RowPostsStars = $MyPostsStars->fetch();
                  echo
                    "<div class='global-posts'>
                              <div class='post-section'><div class='user-post'>
                              <a style=" . 'background-image:url(' . "'gsuploads/gsavatar/" . $HomePosts['avatar'] . "')"  . ' class="useravatar"' .  " href='" . $HomePosts['username'] . "'></a>" .
                      "<a class='user-content' href='" . $HomePosts['username'] . "'>" .
                      "<span>" . $HomePosts['fullname'] . "</span>
                                  <div class='timestamp' title='" . date('Y-M-j | g:i:s a', $postdate) . "'>" .  date('Y-M-j | g:i a', $postdate) . "</div>
                              </a>
                          </div>" .
                      '<div class="status-content">' . $leftQoute . '<span>' . Emojione\Emojione::toImage($HomePosts['body']) . ' </span>' . $rightQoute .
                      '</div>';
                  if (empty($HomePosts['post_img'])) { } else {
                    echo '<a href="">
                           <img  src="gsuploads/gspostsimg/' . $HomePosts['post_img'] . '"' . 'width="300" height="200">
                        </a>';
                  }
                  echo '<form action="" method="POST" id="star-form">
                                    <div class="desc">
                                      <a class="star-in"></a><span>Stars: <span id="st_num">' . $HomePosts['stars'] . '</span></span>
                                    </div>
                                    <span class="star"></span>
                                    <input type="text" name="p_id" value="' . $HomePosts['id'] . '" hidden>';
                  if (!$RowPostsStars) {
                    echo '<input class="star-yell" type="submit" name="Star" value="Star">';
                  } else {
                    echo '<input class="star-yell" type="submit" name="Star" value="Unstar">';
                  }
                  echo '</form>
                              </div></div>';
                }
                if (!$HomeScriptFollowing) {
                  echo "<div class='no-found'><h5>There's no posts to show yet.</h5></div>";
                }
                ?>
            </div>
        </div>
        <div class="aside">
            <div class="know-stalkers-section">
                <?php include 'configs/refresh/recent-stalkers.php'; ?>
            </div>
            <div class="adv-section">
                <div class="section-info">
                    <h1>Advertising Area</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="know-stalkers-sm">
        <?php include 'configs/refresh/recent-stalkers.php'; ?>
    </div>

    <?php
    include $template . 'error-section.php';
    include $template . 'footer.php';

    ?>
    <script type="text/javascript" src="<?php echo $js; ?>goscripts/postOpt.js"></script>
    <script type="text/javascript" src="<?php echo $js; ?>goscripts/previewImg.js"></script>
    <script type="text/javascript" src="<?php echo $js; ?>ajax/aj-posts.js"></script>
    <script type="text/javascript" src="<?php echo $js; ?>ajax/aj-postHome.js"></script>
</body>

</html> 