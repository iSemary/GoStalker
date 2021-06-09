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
    <title>
        <?php echo "'" . $_GET['q'] . "'"; ?> Search | GoStalker</title>
    <meta name="description" content="GoStalker helps you to get freinds feedback as votes and good or evil messages !">
    <meta name="keywords" content="GoStalker, gostalker, Go Stalker, Social Networking, Social Network, voting, votes, evilorgood, stalker, stalkers">
</head>

<body style="background-color:#f3f3f3;">
    <?php include $template . 'header.php'; ?>
    <?php
    $myUserid = $_SESSION['id'];

    $noresult = "<div class='no-found'><h5>There are no results that match your search</h5><strong>'" . $_GET['q'] . "'</strong></div>";

    ?>
    <div class="stalkersform">
        <h3>Stalk on people to get stalked back, votes, messages and everything awesome!</h3>
        <div class="stalkershead">
            <form action="search.php" method="GET">
                <div class="search-bar-big searchi">
                    <input class="searchtopbig" name="q" placeholder="Search..." />
                    <label for="Searchbtn"><i class="fa fa-search"></i></label>
                    <input type="submit" id="Searchbtn" value="Search" hidden>
                </div>
            </form>

        </div>
        <div class="stalkers">
            <h6>Result&#58;</h6>
            <div class="users">
                <?php

                if (isset($_GET['q']) && $_GET['q'] != '') {
                  $tosearch = explode(" ", $_GET['q']);
                  if (count($tosearch) == 1) {
                    $tosearch = str_split($tosearch[0], 2);
                  }
                  $whereclause = "";
                  $SearchUserArray = array(':username' => '%' . $_GET['q'] . '%');
                  for ($i = 0; $i < count($tosearch); $i++) {
                    $whereclause .= " OR username LIKE :u$i ";
                    $SearchUserArray[":u$i"] = $tosearch[$i];
                  }

                  // DB For Users
                  $SearchUserStmt = $db->prepare("SELECT users.avatar, users.userid, users.userstatus, users.fullname, users.username, users.gender FROM users WHERE
                        users.username LIKE :username " . $whereclause . "
                         AND users.userstatus = 0

                         ");
                  $SearchUserStmt->execute($SearchUserArray);
                  $SearchUserRow = $SearchUserStmt->fetchAll();
                  $SearchCountUser = $SearchUserStmt->rowCount();


                  foreach ($SearchUserRow as $SearchRows) {
                    $UserStatus = $SearchRows['userstatus'];
                    if ($UserStatus == 0) {

                      echo  '<div class="stalker-user">' .
                        '<a style="background-image:url(';
                      if (empty($SearchRows['avatar'])) {
                        if ($SearchRows['gender'] == 1) {
                          echo "'img/male-user.png";
                        } else {
                          echo "'img/female-user.png";
                        }
                      } else {
                        echo  "'gsuploads/gsavatar/" . $SearchRows['avatar'];
                      }

                      echo  "')" . '"' . 'class="useravatar" href="http://localhost/gostalker/' . $SearchRows['username'] . '"></a>' .
                        '<a class="visit" href="http://localhost/gostalker/' . $SearchRows['username'] . '">' . 'Visit</a>' . '<a class="user-content" href="http://localhost/gostalker/' . $SearchRows['username'] . '">'  .  '<span>' . $SearchRows['fullname'] . '</span>' . '</a>' .  '</div>';
                    }
                  }
                  $whereclause = "";
                  $SearchPostArray = array(':body' => '%' . $_GET['q'] . '%');
                  for ($i = 0; $i < count($tosearch); $i++) {
                    if ($i % 2) {
                      $whereclause .= " OR body LIKE :p$i ";
                      $SearchPostArray[":p$i"] = $tosearch[$i];
                    }
                  }

                  // DB For Posts
                  $SearchPostStmt = $db->prepare("SELECT * FROM posts WHERE posts.body LIKE :body " . $whereclause . "");
                  $SearchPostStmt->execute($SearchPostArray);
                  $SearchPostRow = $SearchPostStmt->fetchAll();
                  $SearchCountPost = $SearchUserStmt->rowCount();



                  foreach ($SearchPostRow as $SearchRows2) {
                    // DATE OF POST
                    $postdate =  strtotime($SearchRows2['post_date']);
                    // QOUTE POST
                    if ($SearchRows2['q'] == 1) {
                      $leftQoute = '<span class="Q-post"><i class="fa fa-quote-left"></i> </span>';
                    } else {
                      $leftQoute = '';
                    }
                    if ($SearchRows2['q'] == 1) {
                      $rightQoute = '<span class="Q-post"><i class="fa fa-quote-right"></i> </span>';
                    } else {
                      $rightQoute = '';
                    }


                    // Info user from post get
                    $UseridPost = $SearchRows2['user_id'];
                    $UserPostStmt = $db->prepare("SELECT `userid`, `fullname`, `username`, `gender`, `avatar`, `verifiedaccount`, `regstatus`, `birthdate`, `userstatus` FROM users WHERE users.userid LIKE :userid");
                    $UserPostStmt->execute(array(':userid' => $UseridPost));
                    $UserPostRow = $UserPostStmt->fetchAll();

                    foreach ($UserPostRow as $UserPostRow2) {
                      $UserStatus2 =  $UserPostRow2['userstatus'];

                      if ($UserStatus2 == 0) {
                        echo
                          "<div class='global-posts'>
                                <div class='post-section' style='width: 97.5%;'><div class='stalker-user'>" .

                            '<a style="background-image:url(';
                        if (empty($UserPostRow2['avatar'])) {
                          if ($UserPostRow2['gender'] == 1) {
                            echo "'img/male-user.png";
                          } else {
                            echo "'img/female-user.png";
                          }
                        } else {
                          echo  "'gsuploads/gsavatar/" . $UserPostRow2['avatar'];
                        }
                        echo "')" . '"' .  'class="useravatar"' .  " href='" . $UserPostRow2['username'] . "'></a>" .
                          "<a class='user-content' href='" . $UserPostRow2['username'] . "'>" .
                          "<span>" . $UserPostRow2['fullname'] . "<div class='timestamp' title='" . date('Y-M-j | g:i:s a', $postdate) . "'>" .  date('Y-M-j | g:i a', $postdate) . "</div></span></a>

                                  </div>" .
                          '<div class="status-content">' . $leftQoute .
                          htmlspecialchars($SearchRows2['body']) . $rightQoute .
                          '</div>';

                        if (empty($SearchRows2['post_img'])) {
                          echo '</div></div>';
                        } else {
                          echo '<a>
                                   <img src="gsuploads/gspostsimg/' . $SearchRows2['post_img'] . '"' . 'width="300" height="200">
                                </a></div></div>';
                        }
                      }
                    }
                  }



                  if ($SearchCountUser == 0 || $SearchCountPost == 0) {
                    echo  $noresult;
                  }
                } else {
                  echo  $noresult;
                }

                ?>
            </div>
        </div>
    </div>
    </div>
    <?php include $template . 'footer.php'; ?>
</body>

</html> 