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
<?php

$username = "";
$myUserName = $_SESSION['username'];
if (isset($_GET['username']) && strtolower($_GET['username'])  !== strtolower($_SESSION['username'])) {
  // Fetch My Info
  $myUserid = $_SESSION['id'];
  $stmt = $db->prepare("SELECT userid,username FROM users WHERE userid = ?");
  $stmt->execute(array($myUserid));
  $row = $stmt->fetch();

  // Fetch The User Info --> user in the GET
  $username = $db->prepare('SELECT `userid`, `fullname`, `username`, `email`, `gender`, `avatar`, `cover`, `verifiedaccount`, `regstatus`, `birthdate`, `userstatus` FROM users WHERE username=:username');
  $username->execute(array(':username' => $_GET['username']));
  $rowuser = $username->fetch();
  $count = $username->rowCount();

  if (($count > 0) && ($_GET['username'] !== $myUserName)) {
    // Fetch The User Info Again --> user in the GET
    $username = $db->prepare('SELECT `userid`, `fullname`, `username`, `email`, `gender`, `avatar`, `cover`, `verifiedaccount`, `regstatus`, `birthdate`, `userstatus` FROM users WHERE username=:username');
    $username->execute(array(':username' => $_GET['username']));
    $rowuser = $username->fetch();
    $RowUserid = $rowuser['userid'];

    // If i blocked him
    $Blocked = $db->prepare("SELECT * FROM block WHERE from_id = '$myUserid' AND to_id = '$RowUserid'");
    $Blocked->execute();
    $BlockedFe = $Blocked->fetch();

    // if he blocked me
    $BlockedII = $db->prepare("SELECT * FROM block WHERE from_id = '$RowUserid' AND to_id = '$myUserid'");
    $BlockedII->execute();
    $BlockedFeII = $BlockedII->fetch();

    $deactivated = $rowuser['userstatus'];

    if ($BlockedFe || $BlockedFeII || $deactivated == 1) {
      include('404.php');
      die();
    }

    // Fetch The User Bio Info --> user in the GET
    $RowBioUserStmt = $db->prepare("SELECT * FROM bios Where user_id = $RowUserid");
    $RowBioUserStmt->execute();
    $RowBioUser = $RowBioUserStmt->fetchAll();
    foreach ($RowBioUser as $RowsBioUser) { }

    // Fetch follower Info
    $FollowUserStmt = $db->prepare("SELECT * FROM followers Where user_id = $RowUserid AND follower_id = $myUserid");
    $FollowUserStmt->execute();
    $RowFollowUser = $FollowUserStmt->fetch();
    $FollowCount = $FollowUserStmt->rowCount();
    // count following
    $NumFollowingStmt = $db->prepare("SELECT COUNT(user_id) FROM `followers` WHERE follower_id = ?");
    $NumFollowingStmt->execute(array($RowUserid));
    $CountFollowing = $NumFollowingStmt->fetch();
    // count followers
    $NumFollowerStmt = $db->prepare("SELECT COUNT(user_id) FROM `followers` WHERE user_id = ?");
    $NumFollowerStmt->execute(array($RowUserid));
    $CountFollower = $NumFollowerStmt->fetch();
    // His id in my followers row
    $FollowHim = $RowFollowUser['user_id'];
    // Vote Stmt
    $VoteStmt = $db->prepare("SELECT * FROM votes WHERE to_id = ? AND from_id = ?");
    $VoteStmt->execute(array($RowUserid, $myUserid));
    $VoteRow = $VoteStmt->fetch();
  }else{
    include '404.php';
    exit();
  }
} else {
  header('Location: myprofile');
}
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
    <meta name="description" content="<?php
    // description
    if (isset($RowUserid)){
      echo $rowuser['fullname']." account on GoStalker, join us to get in touch with ".$rowuser['fullname'] .".";
    }else{
      echo "";
    }
    ?>">
    <!--[if It IE 9]>
      <script src="<?php echo $js; ?>html5shiv.min.js"></script>
      <script src="<?php echo $js; ?>respond.min.js"></script>
    <![endif]-->
    <title>
        <?php echo $rowuser['fullname']; ?> | GoStalker</title>
    <style>
        @media screen and (max-width: 860px) and (min-width: 665px){
        .poll-org {
          margin: 3px -7px;}}
    </style>
</head>

<body>
    <?php include $template . 'header.php'; ?>
    <div class="container-content">
        <?php
        // Final Vote Result
        $FinalVote = $db->prepare("SELECT SUM(smart NOT LIKE '0') AS smart0, SUM(crazy NOT LIKE '0') AS crazy1, SUM(cute NOT LIKE '0') AS cute2, SUM(kind NOT LIKE '0') AS kind3, SUM(hot NOT LIKE '0') AS hot4, SUM(weird NOT LIKE '0') AS weird5, SUM(love NOT LIKE '0') AS love6, SUM(hate NOT LIKE '0') AS hate7, SUM(missed NOT LIKE '0') AS missed8, SUM(meet NOT LIKE '0') AS meet9, SUM(nervous NOT LIKE '0') AS nervous10, SUM(boring NOT LIKE '0') AS boring11, SUM(brave NOT LIKE '0') AS brave12, SUM(talented NOT LIKE '0') AS talented13, SUM(dangerous NOT LIKE '0') AS dangerous14 FROM `votes` WHERE to_id = ?");
        $FinalVote->execute(array($RowUserid));
        $FinalVotes = $FinalVote->fetchAll();
        foreach ($FinalVotes as $FinalVotesa) { }

        $ResultNumber = $FinalVotesa[0] + $FinalVotesa[1] + $FinalVotesa[2] + $FinalVotesa[3] + $FinalVotesa[4] + $FinalVotesa[5] + $FinalVotesa[6] + $FinalVotesa[7] + $FinalVotesa[8] + $FinalVotesa[9] + $FinalVotesa[10] + $FinalVotesa[11] + $FinalVotesa[12] + $FinalVotesa[13] + $FinalVotesa[14];



        // Vote Stmt
        $VoteStmt2 = $db->prepare("SELECT * FROM votes WHERE to_id = ?");
        $VoteStmt2->execute(array($RowUserid));
        $VoteRow2 = $VoteStmt2->fetch();
        if (empty($rowuser['cover'])) {
          echo '<div class="coverpic" id="CoverPic" style="background-image:url' . "('img/1.jpg')" . '">' . '</div>';
        } else {
          echo '<div class="coverpic" id="CoverPic" style="background-image:url' . "('gsuploads/gscover/" .  $rowuser['cover'] .  "')" . '">' . '</div>';
        };
        ?>
        <div class="stalkersCount-follower">
            <span>Stalkers&#58; <span id="sp-stkrs">
                    <?php echo $CountFollower[0]; ?></span></span>
            <br>
            <span>Stalking&#58;
                <?php echo $CountFollowing[0]; ?></span>
        </div>
        <?php
        $CountAnonymous = $db->prepare("SELECT COUNT(id) FROM anonymous_messages WHERE to_user= $RowUserid");
        $CountAnonymous->execute();
        $CountAnonymousRow = $CountAnonymous->fetch();
        ?>

        <div class="AnonCount-follower">
            <div>
                <span>
                    <?php echo 'Anonymous Messages: ' . $CountAnonymousRow[0];  ?></span>
            </div>
        </div>
        <div class="avatar-content">
            <?php

            if (empty($rowuser['avatar'])) {
              if ($rowuser['gender'] == 1) {

                echo '<div class="profilepic coverpic" id="profilePic" style="background-image:url' . "('img/male-user.png')" . '">'
                  . '</div>';
              } else {
                echo '<div class="profilepic coverpic" id="profilePic" style="background-image:url' . "('img/female-user.png')" . '">'
                  . '</div>';
              }
            } else {
              echo '<div class="profilepic coverpic" id="profilePic" style="background-image:url' . "('gsuploads/gsavatar/" . $rowuser['avatar'] .  "')" . '">' . '</div>';
            };
            ?>

            <?php
            $ExtraStmt = $db->prepare("SELECT * FROM user_extra Where user_id = $RowUserid");
            $ExtraStmt->execute();
            $ExtraInfo = $ExtraStmt->fetchAll();
            foreach ($ExtraInfo as $ExtraInfos) { }
            if (isset($ExtraInfos['badges']) && $ExtraInfos['badges'] != 0) {
              echo '
                            <div class="badge-img">
                              <img src="img/badges/' . $ExtraInfos['badges'] . '.png"></div>';
            } elseif ($ExtraInfos['badges'] = 0) { } else { }

            ?>

            <div class="nameprofile-content">
                <div class="usernamebox">
                    <a class="profilename" id="username_" href="<?php echo $rowuser[" username"]; ?>">
                        <span class="userName">
                            <?php echo $rowuser['fullname']; ?></span>
                        <?php
                        if ($rowuser['verifiedaccount'] == 1) {
                          echo  '<span class="userName verify-badge"' . 'title="Verify Account"' . 'dir="ltr">@' . $rowuser["username"] . '</span></a>';
                        } else {
                          echo  '<span class="userName"' . 'dir="ltr">@' .  $rowuser["username"] . '</span></a>';
                        }

                        ?>
                    </a>
                </div>
            </div>
        </div>
        <form action="" method="post" id="stalk-form">
            <div class="buttons-content col-12">
                <input type="text" name="userexi" value="<?php echo $_GET['username']; ?>" hidden>

                <?php
                if ($FollowHim != $RowUserid) {
                  echo '<button name="stalk" type="submit" class="stalk-btn btn" id="s-btn">Stalk</button>';
                } else {
                  echo '<button name="unstalk" type="submit" class="stalk-btn btn unStalk" id="s-btn">Stalking</button>';
                }
                ?>


                <a class="message-btn btn" href="sendmessages/<?php echo $rowuser['username']; ?>">Message</a>
            </div>
        </form>
        <div class="block-report">
            <a href="#" class="report-stalker" id="report-list"></a>
            <a href="#" class="block-stalker" id="block-list"></a>
        </div>
        <div class="block-section">
            <span class="close cloesd">&times;</span>
            <form action="" method="post" id="block-form">
                <label>Do you want to block
                    <?php echo '"' . $rowuser['fullname'] . '"' . ' @' .  $rowuser['username']; ?> ?</label>
                <label for="bl5">Blocking this user that mean you're not be able to see Posts and Quotes from this user, not able to vote or send Anonymous Messages to this user.</label>
                <input type="text" name="userexi" value="<?php echo $_GET['username']; ?>" hidden>
                <input type="submit" class="signupbtn" name="block-user" value="Block">
            </form>
        </div>
        <div class="report-section">
            <span class="close cloesd">&times;</span>
            <form action="" method="POST" id="report-form">
                <label for="re1">This user is spam.</label>
                <input type="radio" class="re-input" id="re1" name="re" value="1">
                <label for="re2">This user bothers me / others.</label>
                <input type="radio" class="re-input" id="re2" name="re" value="2">
                <label for="re3">This accout posting nudity or bullying contents.</label>
                <input type="radio" class="re-input" id="re3" name="re" value="3">
                <label for="re4">It's fake or Impersonating someone.</label>
                <input type="radio" class="re-input" id="re4" name="re" value="4">
                <input type="text" name="userexi" value="<?php echo $_GET['username']; ?>" hidden>
                <input type="submit" class="signupbtn" name="re-submit" value="Report">
            </form>
        </div>
        <div data-aos="fade-up" data-aos-once="true">
            <div class="rightbio">
                <div class="age-stalk"> <span> Age: <div class="info-bio">
                            <?php if (isset($RowsBioUser['age'])) {
                              echo $RowsBioUser['age'];
                            } else { } ?>
                        </div></span> </div>
                <div class="location-stalk"> <span> Location: <div class="info-bio">
                            <?php if (isset($RowsBioUser['location'])) {
                              echo $RowsBioUser['location'];
                            } else { } ?>
                        </div></span> </div>
                <div class="status-stalk"> <span> Status: <div class="info-bio">
                            <?php if (isset($RowsBioUser['status'])) {
                              echo $RowsBioUser['status'];
                            } else { } ?>
                        </div></span> </div>
                <div class="height-stalk"> <span> Height: <div class="info-bio">
                            <?php if (isset($RowsBioUser['height'])) {
                              echo $RowsBioUser['height'];
                            } else { } ?>
                        </div></span> </div>
                <div class="weight-stalk"> <span> Weight: <div class="info-bio">
                            <?php if (isset($RowsBioUser['weight'])) {
                              echo $RowsBioUser['weight'];
                            } else { } ?>
                        </div></span> </div>
            </div>
            <div class="leftbio">
                <div class="hobby-stalk"> <span> Hobby: <div class="info-bio">
                            <?php if (isset($RowsBioUser['hobby'])) {
                              echo $RowsBioUser['hobby'];
                            } else { } ?>
                        </div></span> </div>
                <div class="drink-stalk"> <span> Drink: <div class="info-bio">
                            <?php if (isset($RowsBioUser['drink'])) {
                              echo $RowsBioUser['drink'];
                            } else { } ?>
                        </div></span> </div>
                <div class="food-stalk"> <span> Food: <div class="info-bio">
                            <?php if (isset($RowsBioUser['food'])) {
                              echo $RowsBioUser['food'];
                            } else { } ?>
                        </div></span> </div>
                <div class="singer-stalk"> <span> Singer: <div class="info-bio">
                            <?php if (isset($RowsBioUser['singer'])) {
                              echo $RowsBioUser['singer'];
                            } else { } ?>
                        </div></span> </div>
                <div class="movie-stalk"> <span> Movie: <div class="info-bio">
                            <?php if (isset($RowsBioUser['movie'])) {
                              echo $RowsBioUser['movie'];
                            } else { } ?>
                        </div></span> </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="talks">
        <div data-aos="fade-right" style="width:100%;" data-aos-delay="200" data-aos-easing="ease-out-back" data-aos-once="true" data-aos-offset="0">
            <div class="talknice">
                <img class="angel col-lg-12 col-md-12 col-sm-12 col-12" src="img/nice_userprofile.svg" width="30px" height="30px" />

                <form action="" method="post" id="nice-form">
                    <textarea id="emojiPickNice" name="NiceMess" placeholder="Write a nice message..." rows="5" maxlength="255" class="talknicearea" style="background:none;"></textarea>
                    <input type="text" name="userexi" value="<?php echo $_GET['username']; ?>" hidden>
                    <div class="nicebutn">
                        <button id="Send" class="nicebtn" name="niceMessSub" type="submit" style="margin-top:5px">
                            Send
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div data-aos="fade-left" style="width:100%;" data-aos-delay="200" data-aos-easing="ease-out-back" data-aos-once="true" data-aos-offset="0">
            <div class="talkbad">
                <img class="evil col-lg-12 col-md-12 col-sm-12 col-12" src="img/evil_userprofile.svg" width="30px" height="30px" />
                <form action="" method="post" id="bad-form">
                    <textarea placeholder="Write a criticism message..." name="BadMess" rows="5" id="emojiPickBad" maxlength="255" class="talkbadarea" style="background:none;"></textarea>
                    <input type="text" name="userexi" value="<?php echo $_GET['username']; ?>" hidden>
                    <div class="badbutn">
                        <button id="Send" class="badbtn" name="badMessSub" type="submit" style="margin-top:5px">
                            Send
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    $UserExtraStmt = $db->prepare("SELECT * FROM user_extra Where user_id = $RowUserid");
    $UserExtraStmt->execute();
    $UserExtraInfo = $UserExtraStmt->fetchAll();
    foreach ($UserExtraInfo as $UserExtraInfos) { }
    ?>
    <fieldset class="field-Sets">
        <legend>My favourite Music</legend>
        <?php
        if (empty($UserExtraInfos['sound_music'])) {
          echo '<div style="text-align:center;">There\'s no sound track.</div>';
        } else {
          echo '<iframe width="100%" height="166" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=' . $UserExtraInfos['sound_music'] . '"></iframe>';
        }
        ?>

    </fieldset>
    <hr>
    <fieldset class="field-Sets">
        <legend>Votes</legend>
        <div id="result"></div>
        <form action="" method="post" id="vote-form" enctype="multipart/form-data">
            <div class="votes-container">
                <div class="votes-right" data-aos="zoom-out-right" data-aos-delay="200" data-aos-easing="ease-out-back" data-aos-once="true">
                    <div class="poll-org">
                        <div class="text-bar">Smart</div>
                        <input class="magic-checkbox" type="checkbox" name="smart-optian" id="1" value="smart" <?php if ($VoteRow && $VoteRow['smart'] == 1) {
                                                                                                                  echo "checked";
                                                                                                                } else {
                                                                                                                  echo "";
                                                                                                                } ?> >
                        <label for="1"></label>
                        <progress max="100" value="0" class="progress3">
                            <div class="progress-bar"></div>
                        </progress>
                        <div class="vote-count">
                            <span id="result-smart">
                                <?php if (isset($VoteRow2)) {
                                  echo $FinalVotesa[0];
                                } else {
                                  echo '0';
                                }  ?></span>
                            <span id="precent-smart"></span>
                        </div>
                    </div>
                    <div class="poll-org">
                        <div class="text-bar">Crazy</div>
                        <input class="magic-checkbox" type="checkbox" name="crazy-optian" id="2" value="crazy" <?php if ($VoteRow && $VoteRow['crazy'] == 1) {
                                                                                                                  echo "checked";
                                                                                                                } else {
                                                                                                                  echo "";
                                                                                                                } ?>>
                        <label for="2"></label>
                        <progress max="100" value="0" class="progress2">
                            <div class="progress-bar">
                            </div>
                        </progress>
                        <div class="vote-count">
                            <span id="result-crazy">
                                <?php if (isset($VoteRow2)) {
                                  echo $FinalVotesa[1];
                                } else {
                                  echo '0';
                                }  ?></span>
                            <span id="precent-crazy"></span>
                        </div>

                    </div>
                    <div class="poll-org">
                        <div class="text-bar">Cute</div>
                        <input class="magic-checkbox" type="checkbox" name="cute-optian" id="3" value="cute" <?php if ($VoteRow && $VoteRow['cute'] == 1) {
                                                                                                                echo "checked";
                                                                                                              } else {
                                                                                                                echo "";
                                                                                                              } ?> >
                        <label for="3"></label>
                        <progress max="100" value="0" class="progress1">
                            <div class="progress-bar"></div>
                        </progress>
                        <div class="vote-count"><span id="result-cute">
                                <?php if (isset($VoteRow2)) {
                                  echo $FinalVotesa[2];
                                } else {
                                  echo '0';
                                }  ?></span><span id="precent-cute"></span></div>
                    </div>
                </div>


                <div class="votes-left" data-aos="zoom-out-left" data-aos-delay="200" data-aos-easing="ease-out-back" data-aos-once="true">
                    <div class="poll-org">
                        <input type="text" name="userexi" value="<?php echo $_GET['username']; ?>" hidden>
                        <div class="text-bar">Kind</div>
                        <input class="magic-checkbox" type="checkbox" name="kind-optian" id="4" value="kind" <?php if ($VoteRow && $VoteRow['kind'] == 1) {
                                                                                                                echo "checked";
                                                                                                              } else {
                                                                                                                echo "";
                                                                                                              } ?>>
                        <label for="4"></label>
                        <progress max="100" value="0" class="progress6">
                            <div class="progress-bar">
                            </div>
                        </progress>
                        <div class="vote-count"><span id="result-kind">
                                <?php if (isset($VoteRow2)) {
                                  echo $FinalVotesa[3];
                                } else {
                                  echo '0';
                                }  ?></span>
                            <span id="precent-kind"></span>
                        </div>
                    </div>

                    <div class="poll-org">
                        <div class="text-bar">Hot</div>
                        <input class="magic-checkbox" type="checkbox" name="hot-optian" id="5" value="hot" <?php if ($VoteRow && $VoteRow['hot'] == 1) {
                                                                                                              echo "checked";
                                                                                                            } else {
                                                                                                              echo "";
                                                                                                            } ?>>
                        <label for="5"></label>
                        <progress max="100" value="0" class="progress5">
                            <div class="progress-bar">
                            </div>
                        </progress>
                        <div class="vote-count"><span id="result-hot">
                                <?php if (isset($VoteRow2)) {
                                  echo $FinalVotesa[4];
                                } else {
                                  echo '0';
                                }  ?></span>
                            <span id="precent-hot"></span></div>

                    </div>
                    <div class="poll-org">
                        <div class="text-bar">Weird</div>
                        <input class="magic-checkbox" type="checkbox" name="weird-optian" id="6" value="weird" <?php if ($VoteRow && $VoteRow['weird'] == 1) {
                                                                                                                  echo "checked";
                                                                                                                } else {
                                                                                                                  echo "";
                                                                                                                } ?>>
                        <label for="6"></label>
                        <progress max="100" value="0" class="progress4">
                            <div class="progress-bar">
                            </div>
                        </progress>
                        <div class="vote-count"><span id="result-weird">
                                <?php if (isset($VoteRow2)) {
                                  echo $FinalVotesa[5];
                                } else {
                                  echo '0';
                                }  ?></span>
                            <span id="precent-weird"></span></div>

                    </div>
                </div>
            </div>
            <hr>
            <div class="votes-container">
                <div class="votes-right" data-aos="fade-up-right" data-aos-once="true">
                    <div class="poll-four">
                        <input class="magic-checkbox" type="checkbox" name="hate-optian" id="7" value="hate" <?php if ($VoteRow && $VoteRow['hate'] == 1) {
                                                                                                                echo "checked";
                                                                                                              } else {
                                                                                                                echo "";
                                                                                                              } ?>>
                        <label for="7"></label>
                        <div class="progress-cont">
                            <div style="background-color:darkgreen;" class="progressBar" id="progress7">
                                <span class="progress-title">Hate</span>
                            </div>
                        </div>
                        <div class="vote-count"><span id="result-hate">
                                <?php if (isset($VoteRow2)) {
                                  echo $FinalVotesa[7];
                                } else {
                                  echo '0';
                                }  ?></span><span id="precent-hate"></span></div>

                    </div>
                    <div class="poll-four">
                        <input class="magic-checkbox" type="checkbox" name="love-optian" id="8" value="love" <?php if ($VoteRow && $VoteRow['love'] == 1) {
                                                                                                                echo "checked";
                                                                                                              } else {
                                                                                                                echo "";
                                                                                                              } ?>>
                        <label for="8"></label>
                        <div class="progress-cont">
                            <div class="progressBar" id="progress8">
                                <span class="progress-title">Love</span>
                            </div>
                        </div>
                        <div class="vote-count"><span id="result-love">
                                <?php if (isset($VoteRow2)) {
                                  echo $FinalVotesa[6];
                                } else {
                                  echo '0';
                                }  ?></span><span id="precent-love"></span></div>

                    </div>
                </div>
                <div class="votes-left" data-aos="fade-up-left" data-aos-once="true">
                    <div class="poll-four">
                        <input class="magic-checkbox" type="checkbox" name="meet-optian" id="9" value="meet" <?php if ($VoteRow && $VoteRow['meet'] == 1) {
                                                                                                                echo "checked";
                                                                                                              } else {
                                                                                                                echo "";
                                                                                                              } ?>>
                        <label for="9"></label>
                        <div class="progress-cont">
                            <div style="background-color:#6d006d;" class="progressBar" id="progress9">
                                <span class="progress-title">Meet</span>
                            </div>

                        </div>
                        <div class="vote-count"><span id="result-meet">
                                <?php if (isset($VoteRow2)) {
                                  echo $FinalVotesa[9];
                                } else {
                                  echo '0';
                                }  ?></span><span id="precent-meet"></span></div>

                    </div>
                    <div class="poll-four">
                        <input class="magic-checkbox" type="checkbox" name="missed-optian" id="10" value="missed" <?php if ($VoteRow && $VoteRow['missed'] == 1) {
                                                                                                                    echo "checked";
                                                                                                                  } else {
                                                                                                                    echo "";
                                                                                                                  } ?>>
                        <label for="10"></label>
                        <div class="progress-cont">
                            <div style="background-color:#3b255f;" class="progressBar" id="progress10">
                                <span class="progress-title">Missed</span>
                            </div>
                        </div>
                        <div class="vote-count"><span id="result-missed">
                                <?php if (isset($VoteRow2)) {
                                  echo $FinalVotesa[8];
                                } else {
                                  echo '0';
                                }  ?></span><span id="precent-missed"></span></div>

                    </div>
                </div>
            </div>
            <hr>
            <div class="votes-container">
                <div class="votes-right">
                    <div class="poll-three poll-four">
                        <div class="text-bar">Nervous</div>
                        <input class="magic-checkbox" type="checkbox" name="nervous-optian" id="11" value="nervous" <?php if ($VoteRow && $VoteRow['nervous'] == 1) {
                                                                                                                      echo "checked";
                                                                                                                    } else {
                                                                                                                      echo "";
                                                                                                                    } ?>>
                        <label for="11"></label>
                        <div id="bar1" class="barfiller">
                            <span class="fill" data-percentage="0" id="progress11" style="background-color: #FFC107;"></span>
                        </div>
                        <div class="vote-count"><span id="result-nervous">
                                <?php if (isset($VoteRow2)) {
                                  echo $FinalVotesa[10];
                                } else {
                                  echo '0';
                                }  ?></span><span id="precent-nervous"></span></div>

                    </div>
                    <div class="poll-three poll-four">
                        <div class="text-bar">Brave</div>

                        <input class="magic-checkbox" type="checkbox" name="brave-optian" id="12" value="brave" <?php if ($VoteRow && $VoteRow['brave'] == 1) {
                                                                                                                  echo "checked";
                                                                                                                } else {
                                                                                                                  echo "";
                                                                                                                } ?>>
                        <label for="12"></label>
                        <div id="bar2" class="barfiller">
                            <span class="fill" data-percentage="0" id="progress13" style="background-color: #C62828;"></span>
                        </div>
                        <div class="vote-count"><span id="result-brave">
                                <?php if (isset($VoteRow2)) {
                                  echo $FinalVotesa[12];
                                } else {
                                  echo '0';
                                }  ?></span><span id="precent-brave"></span></div>

                    </div>
                </div>
                <div class="votes-left">
                    <div class="poll-three poll-four">
                        <div class="text-bar">Boring</div>
                        <input class="magic-checkbox" type="checkbox" name="boring-optian" id="13" value="boring" <?php if ($VoteRow && $VoteRow['boring'] == 1) {
                                                                                                                    echo "checked";
                                                                                                                  } else {
                                                                                                                    echo "";
                                                                                                                  } ?>>
                        <label for="13"></label>
                        <div id="bar3" class="barfiller">
                            <span class="fill" data-percentage="0" id="progress12" style="background-color: #388E3C;"></span>
                        </div>
                        <div class="vote-count"><span id="result-boring">
                                <?php if (isset($VoteRow2)) {
                                  echo $FinalVotesa[11];
                                } else {
                                  echo '0';
                                }  ?></span><span id="precent-boring"></span></div>

                    </div>
                    <div class="poll-three poll-four">
                        <div class="text-bar">Talented</div>
                        <input class="magic-checkbox" type="checkbox" name="talented-optian" id="14" value="talented" <?php if ($VoteRow && $VoteRow['talented'] == 1) {
                                                                                                                        echo "checked";
                                                                                                                      } else {
                                                                                                                        echo "";
                                                                                                                      } ?>>
                        <label for="14"></label>
                        <div id="bar4" class="barfiller">
                            <span class="fill" data-percentage="0" id="progress14" style="background-color: #2196F3;"></span>
                        </div>
                        <div class="vote-count"><span id="result-talented">
                                <?php if (isset($VoteRow2)) {
                                  echo $FinalVotesa[13];
                                } else {
                                  echo '0';
                                }  ?></span><span id="precent-talented"></span></div>

                    </div>

                </div>
            </div>
            <div class="votes-info">
                <input class="vote-btn" type="submit" name="vote" value="Vote!">
                <span class="votes-result">Result: <span id="final-result">
                        <?php echo $ResultNumber; ?></span></span>
                <span id="precent"></span>
            </div>
        </form>
    </fieldset>
    <hr>
    <div id="myPhoto" class="modal">
        <span class="close">&times;</span>
        <?php
        if (empty($rowuser['avatar'])) {
          if ($rowuser['gender'] == 1) {

            echo '<div class="modal-content" style="background-image:url' . "('img/male-user.png')" . '">'
              . '</div>';
          } else {
            echo '<div class="modal-content style="background-image:url' . "('img/female-user.png')" . '">'
              . '</div>';
          }
        } else {
          echo '<div class="modal-content" id="img01" style="background-image:url' . "('gsuploads/gsavatar/" . $rowuser['avatar'] .  "')" . '">' . '</div>';
        };
        ?>

        <div id="caption">
            <div class="userName">
                <?php echo $rowuser['fullname']; ?>
            </div>

            <?php
            if ($rowuser['verifiedaccount'] == 1) {
              echo  '<span class="userName verify-badge"' . 'title="Verify Account"' . 'dir="ltr">@' . $rowuser["username"] . '</span></a>';
            } else {
              echo  '<span class="userName"' . 'dir="ltr">@' .  $rowuser["username"] . '</span></a>';
            }

            ?>
        </div>
    </div>
    <div id="myCover" class="modal">
        <span class="close">&times;</span>
        <?php
        if (empty($rowuser['cover'])) {
          echo '<div class="modal-content" id="img01" style="background-image:url' . "('img/1.jpg')" . '">' . '</div>';
        } else {
          echo '<div class="modal-content" id="img01" style="background-image:url' . "('gsuploads/gscover/" .  $rowuser['cover'] .  "')" . '">' . '</div>';
        };
        ?>

        <div id="caption">
            <div class="userName">
                <?php echo $rowuser['fullname']; ?>
            </div>

            <?php
            if ($rowuser['verifiedaccount'] == 1) {
              echo  '<span class="userName verify-badge"' . 'title="Verify Account"' . 'dir="ltr">@' . $rowuser["username"] . '</span></a>';
            } else {
              echo  '<span class="userName"' . 'dir="ltr">@' .  $rowuser["username"] . '</span></a>';
            }

            ?>
        </div>
    </div>
    <fieldset class="field-Sets">
        <legend>Posts</legend>
        <div class="posts_secion">
            <?php
                // Fetch Posts Table
            $MyPostsStmt = $db->prepare("SELECT * FROM posts Where user_id = $RowUserid  ORDER BY id DESC");
            $MyPostsStmt->execute();
            $GetMyPostsStmt = $MyPostsStmt->fetchAll();

            foreach ($GetMyPostsStmt as $posts) {
              $MyPostsStars = $db->prepare('SELECT * FROM post_stars WHERE post_id=:postid AND user_id=:userid');
              $MyPostsStars->execute(array(':postid' => $posts['id'], ':userid' => $userid));
              $RowPostsStars = $MyPostsStars->fetch();

              $postdate =  strtotime($posts['post_date']);
              // QOUTE POST
              if ($posts['q'] == 1) {
                $leftQoute = '<span class="Q-post"><i class="fa fa-quote-left"></i> </span>';
              } else {
                $leftQoute = '';
              }
              if ($posts['q'] == 1) {
                $rightQoute = '<span class="Q-post"><i class="fa fa-quote-right"></i> </span>';
              } else {
                $rightQoute = '';
              }

              echo
                "<div class='global-posts'>
                        <div class='post-section' data-aos='flip-down' data-aos-once='true'><div class='user-post'>
                        <a style=" . 'background-image:url(' . "'gsuploads/gsavatar/" . $rowuser['avatar'] . "')"  . ' class="useravatar"' .  " href='" . $rowuser['username'] . "'></a>" .
                  "<a class='user-content' href='" . $rowuser['username'] . "'>" .
                  "<span>" . $rowuser['fullname'] . "</span>
                            <div class='timestamp' title='" . date('Y-M-j | g:i:s a', $postdate) . "'>" .  date('Y-M-j | g:i a', $postdate) . "</div>
                        </a>
                    </div>"  .
                  '<div class="status-content">' . $leftQoute . '<span>' . htmlspecialchars($posts['body']) . ' </span>' . $rightQoute .
                  '</div>';
              if (empty($posts['post_img'])) { } else {
                echo '<a href="">
                     <img src="gsuploads/gspostsimg/' . $posts['post_img'] . '"' . 'width="300" height="200">
                  </a>';
              }
              echo '<form action="" method="POST" id="star-form"><div class="desc">
                        <a class="star-in" id="' . $posts['id'] . '"></a><span>Stars: <span id="st_num">' . $posts['stars'] . '</span></span></div>
                              <span class="star"></span>
                              <input type="text" name="p_id" value="' . $posts['id'] . '" hidden>
                              <input type="text" name="u_id" value="' . $RowUserid . '" hidden>';
              if (!$RowPostsStars) {
                echo '<input class="star-yell" type="submit" name="Star" value="Star">';
              } else {
                echo '<input class="star-yell" type="submit" name="Star" value="Unstar">';
              }
              echo '</form>
                        </div></div>';
            }

            if (!$GetMyPostsStmt) {
              echo "<div class='no-found'><h5>This user didn't post anything yet.</h5></div>";
            }
            ?>
    </fieldset>
    <?php include $template . 'error-section.php' ?>
    <?php include $template . 'footer.php'; ?>
    <script type="text/javascript" src="<?php echo $js; ?>goscripts/Modal.js"></script>
    <script type="text/javascript" src="<?php echo $js; ?>goscripts/result100.js"></script>
    <script type="text/javascript" src="<?php echo $js; ?>goscripts/reportList.js"></script>
    <script type="text/javascript" src="<?php echo $js; ?>emojioneArea.min.js"></script>
    <script type="text/javascript" src="<?php echo $js; ?>aos.js"></script>
    <script type="text/javascript" src="<?php echo $js; ?>ajax/aj-stalk-user.js"></script>
    <script type="text/javascript" src="<?php echo $js; ?>ajax/aj-block-user.js"></script>
    <script type="text/javascript" src="<?php echo $js; ?>ajax/aj-report-user.js"></script>
    <script type="text/javascript" src="<?php echo $js; ?>ajax/aj-bad-mess.js"></script>
    <script type="text/javascript" src="<?php echo $js; ?>ajax/aj-nice-mess.js"></script>
    <script type="text/javascript" src="<?php echo $js; ?>ajax/aj-vote-user.js"></script>
    <script type="text/javascript" src="<?php echo $js; ?>ajax/aj-starituser.js"></script>
    <script type="text/javascript" src="<?php echo $js; ?>jquery.barfiller.js"></script>
    <script type="text/javascript">
        $("#bar1").barfiller({
            barColor: "#16b597",
            tooltip: !0,
            duration: 1e3,
            animateOnResize: !0,
            symbol: "%"
        });
        $("#bar2").barfiller({
            barColor: "#16b597",
            tooltip: !0,
            duration: 1e3,
            animateOnResize: !0,
            symbol: "%"
        });
        $("#bar3").barfiller({
            barColor: "#16b597",
            tooltip: !0,
            duration: 1e3,
            animateOnResize: !0,
            symbol: "%"
        });
        $("#bar4").barfiller({
            barColor: "#16b597",
            tooltip: !0,
            duration: 1e3,
            animateOnResize: !0,
            symbol: "%"
        });
    </script>
    <script type="text/javascript">
        AOS.init();
    </script>
    <script>
        $('#emojiPickNice, #emojiPickBad').emojioneArea({
            saveEmojisAs: "shortname"
        });
    </script>
</body>

</html> 