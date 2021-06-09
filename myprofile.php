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
$userid = $_SESSION['id'];
// execute the Main table
$stmt = $db->prepare("SELECT `userid`, `fullname`, `username`, `email`, `gender`, `avatar`, `cover`, `verifiedaccount`, `regstatus`, `birthdate`, `userstatus` FROM users WHERE userid = ?");
$stmt->execute(array($userid));
$row = $stmt->fetch();
$count = $stmt->rowCount();
// execute the Bio table
$stmt1 = $db->prepare("SELECT * FROM bios Where user_id = $userid");
$stmt1->execute();
$BioRow = $stmt1->fetchAll();
foreach ($BioRow as $Rows) { }
// count following
$NumFollowingStmt = $db->prepare("SELECT COUNT(user_id) FROM `followers` WHERE follower_id = ?");
$NumFollowingStmt->execute(array($userid));
$CountFollowing = $NumFollowingStmt->fetch();
// count followers
$NumFollowerStmt = $db->prepare("SELECT COUNT(user_id) FROM `followers` WHERE user_id = ?");
$NumFollowerStmt->execute(array($userid));
$CountFollower = $NumFollowerStmt->fetch();
// Vote Stmt
$VoteStmt = $db->prepare("SELECT * FROM votes WHERE to_id = ?");
$VoteStmt->execute(array($userid));
$VoteRow = $VoteStmt->fetch();

// Final Vote Result
$FinalVote = $db->prepare("SELECT SUM(smart NOT LIKE '0') AS smart0, SUM(crazy NOT LIKE '0') AS crazy1, SUM(cute NOT LIKE '0') AS cute2, SUM(kind NOT LIKE '0') AS kind3, SUM(hot NOT LIKE '0') AS hot4, SUM(weird NOT LIKE '0') AS weird5, SUM(love NOT LIKE '0') AS love6, SUM(hate NOT LIKE '0') AS hate7, SUM(missed NOT LIKE '0') AS missed8, SUM(meet NOT LIKE '0') AS meet9, SUM(nervous NOT LIKE '0') AS nervous10, SUM(boring NOT LIKE '0') AS boring11, SUM(brave NOT LIKE '0') AS brave12, SUM(talented NOT LIKE '0') AS talented13, SUM(dangerous NOT LIKE '0') AS dangerous14 FROM `votes` WHERE to_id = ?");
$FinalVote->execute(array($userid));
$FinalVotes = $FinalVote->fetchAll();
foreach ($FinalVotes as $FinalVotesa) { }

$ResultNumber = $FinalVotesa[0] + $FinalVotesa[1] + $FinalVotesa[2] + $FinalVotesa[3] + $FinalVotesa[4] + $FinalVotesa[5] + $FinalVotesa[6] + $FinalVotesa[7] + $FinalVotesa[8] + $FinalVotesa[9] + $FinalVotesa[10] + $FinalVotesa[11] + $FinalVotesa[12] + $FinalVotesa[13] + $FinalVotesa[14];

$MyPostsStmt = $db->prepare("SELECT * FROM posts Where user_id = $userid ORDER BY id DESC");
$MyPostsStmt->execute();
$GetMyPostsStmt = $MyPostsStmt->fetchAll();
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

    <title><?php echo $row['fullname']; ?> | GoStalker</title>
</head>

<body>
    <style>
        .postit {margin: 0 auto;}
          @media only screen and (max-width: 652px){
          .global-posts .post-section {width: 96%}
        }
          @media screen and (max-width: 860px) and (min-width: 665px){
          .votes-container progress {width: 46%;margin: 0px -33px 6px 9px;}
          .poll-org {margin: 3px -29px;}
        }
      </style>
    <?php include $template . 'header.php'; ?>
    <div class="container-content">
        <?php
        if (empty($row['cover'])) {
          echo '<div class="coverpic" id="CoverPic" style="background-image:url' . "('img/1.jpg')" . '">' . '</div>';
        } else {
          echo '<div class="coverpic" id="CoverPic" style="background-image:url' . "('gsuploads/gscover/" .  $row['cover'] .  "')" . '">' . '</div>';
        };
        ?>
        <div class="stalkersCount-follower">
            <span>Stalkers&#58;
                <?php echo $CountFollower[0]; ?></span>
            <br>
            <span>Stalking&#58;
                <?php echo $CountFollowing[0]; ?></span>
        </div>
        <?php
        $CountAnonymous = $db->prepare("SELECT COUNT(id) FROM anonymous_messages WHERE to_user= $userid");
        $CountAnonymous->execute();
        $CountAnonymousRow = $CountAnonymous->fetch();
        ?>

        <div class="AnonCount-follower">
            <a href="AnonymousMessages.php" class="no14">
                <span>
                    <?php echo 'Anonymous Messages: ' . $CountAnonymousRow[0];  ?></span>
            </a>
        </div>
        <a href="settings"><span class="edit-stalk">Edit Profile</span></a>
        <div class="avatar-content">
            <?php

            if (empty($row['avatar'])) {
              if ($row['gender'] == 1) {

                echo '<div class="profilepic coverpic" id="profilePic" style="background-image:url' . "('img/male-user.png')" . '">'
                  . '</div>';
              } else {
                echo '<div class="profilepic coverpic" id="profilePic" style="background-image:url' . "('img/female-user.png')" . '">'
                  . '</div>';
              }
            } else {
              echo '<div class="profilepic coverpic" id="profilePic" style="background-image:url' . "('gsuploads/gsavatar/" . $row['avatar'] .  "')" . '">' . '</div>';
            };
            ?>
            <?php
            $ExtraStmt = $db->prepare("SELECT * FROM user_extra Where user_id = $userid");
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
                    <a class="profilename" href="myprofile">
                        <span class="userName"><?php echo $row["fullname"]; ?></span>
                        <?php
                        if ($row['verifiedaccount'] == 1) {
                          echo  '<span class="userName verify-badge"' . 'title="Verify Account"' . 'dir="ltr">@' . $row["username"] . '</span></a>';
                        } else {
                          echo  '<span class="userName"' . 'dir="ltr">@' .  $row["username"] . '</span></a>';
                        }

                        ?>
                    </a>
                </div>
            </div>
        </div>
        <div data-aos="fade-up" data-aos-once="true">
            <div class="rightbio">
                <div class="age-stalk"> <span> Age: <div class="info-bio">
                            <?php if (isset($Rows['age'])) {
                              echo $Rows['age'];
                            } else { } ?>
                        </div></span> </div>
                <div class="location-stalk"> <span> Location: <div class="info-bio">
                            <?php if (isset($Rows['location'])) {
                              echo $Rows['location'];
                            } else { } ?>
                        </div></span> </div>
                <div class="status-stalk"> <span> Status: <div class="info-bio">
                            <?php if (isset($Rows['status'])) {
                              echo $Rows['status'];
                            } else { } ?>
                        </div></span> </div>
                <div class="height-stalk"> <span> Height: <div class="info-bio">
                            <?php if (isset($Rows['height'])) {
                              echo $Rows['height'];
                            } else { } ?>
                        </div></span> </div>
                <div class="weight-stalk"> <span> Weight: <div class="info-bio">
                            <?php if (isset($Rows['weight'])) {
                              echo $Rows['weight'];
                            } else { } ?>
                        </div></span> </div>
            </div>
            <div class="leftbio">
                <div class="hobby-stalk"> <span> Hobby: <div class="info-bio">
                            <?php if (isset($Rows['hobby'])) {
                              echo $Rows['hobby'];
                            } else { } ?>
                        </div></span> </div>
                <div class="drink-stalk"> <span> Drink: <div class="info-bio">
                            <?php if (isset($Rows['drink'])) {
                              echo $Rows['drink'];
                            } else { } ?>
                        </div></span> </div>
                <div class="food-stalk"> <span> Food: <div class="info-bio">
                            <?php if (isset($Rows['food'])) {
                              echo $Rows['food'];
                            } else { } ?>
                        </div></span> </div>
                <div class="singer-stalk"> <span> Singer: <div class="info-bio">
                            <?php if (isset($Rows['singer'])) {
                              echo $Rows['singer'];
                            } else { } ?>
                        </div></span> </div>
                <div class="movie-stalk"> <span> Movie: <div class="info-bio">
                            <?php if (isset($Rows['movie'])) {
                              echo $Rows['movie'];
                            } else { } ?>
                        </div></span> </div>
            </div>
        </div>
    </div>
    <fieldset class="field-Sets">
        <legend>My favourite Music</legend>
        <?php
        if (empty($ExtraInfos['sound_music'])) {
          echo '<div style="text-align:center;">You didn\'t add sound track.</div>';
        } else {
          echo '<iframe width="100%" height="166" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=' . $ExtraInfos['sound_music'] . '"></iframe>';
        }
        ?>

    </fieldset>
    <fieldset class="field-Sets">
        <legend>
            Votes
        </legend>
        <div class="votes-container">
            <div class="votes-right" data-aos="zoom-out-right" data-aos-delay="200" data-aos-easing="ease-out-back" data-aos-once="true">
                <div class="poll-org">
                    <div class="text-bar">Smart</div>
                    <progress max="100" value="0" class="progress3">
                        <div class="progress-bar"></div>
                    </progress>
                    <div class="vote-count">
                        <span id="result-smart">
                            <?php if (isset($VoteRow['to_id'])) {
                              echo $FinalVotesa[0];
                            } else {
                              echo '0';
                            }  ?></span>
                        <span id="precent-smart"></span>
                    </div>
                </div>
                <div class="poll-org">
                    <div class="text-bar">Crazy</div>
                    <progress max="100" value="0" class="progress2">
                        <div class="progress-bar">
                        </div>
                    </progress>
                    <div class="vote-count"><span id="result-crazy">
                            <?php if (isset($VoteRow['to_id'])) {
                              echo $FinalVotesa[1];
                            } else {
                              echo '0';
                            }  ?></span>
                        <span id="precent-crazy"></span>
                    </div>

                </div>
                <div class="poll-org">
                    <div class="text-bar">Cute</div>
                    <progress max="100" value="0" class="progress1">
                        <div class="progress-bar">
                        </div>
                    </progress>
                    <div class="vote-count"><span id="result-cute">
                            <?php if (isset($VoteRow['to_id'])) {
                              echo $FinalVotesa[2];
                            } else {
                              echo '0';
                            }  ?></span><span id="precent-cute"></span></div>
                </div>
            </div>


            <div class="votes-left" data-aos="zoom-out-left" data-aos-delay="200" data-aos-easing="ease-out-back" data-aos-once="true">
                <div class="poll-org">
                    <div class="text-bar">Kind</div>
                    <progress max="100" value="0" class="progress6">
                        <div class="progress-bar">
                        </div>
                    </progress>
                    <div class="vote-count"><span id="result-kind">
                            <?php if (isset($VoteRow['to_id'])) {
                              echo $FinalVotesa[3];
                            } else {
                              echo '0';
                            }  ?></span>
                        <span id="precent-kind"></span>
                    </div>
                </div>

                <div class="poll-org">
                    <div class="text-bar">Hot</div>
                    <progress max="100" value="0" class="progress5">
                        <div class="progress-bar">
                        </div>
                    </progress>
                    <div class="vote-count"><span id="result-hot">
                            <?php if (isset($VoteRow['to_id'])) {
                              echo $FinalVotesa[4];
                            } else {
                              echo '0';
                            }  ?></span>
                        <span id="precent-hot"></span></div>

                </div>
                <div class="poll-org">
                    <div class="text-bar">Weird</div>
                    <progress max="100" value="0" class="progress4">
                        <div class="progress-bar">
                        </div>
                    </progress>
                    <div class="vote-count"><span id="result-weird">
                            <?php if (isset($VoteRow['to_id'])) {
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
                    <div class="progress-cont">
                        <div style="background-color:darkgreen;" class="progressBar" id="progress7">
                            <span class="progress-title">Hate</span>
                        </div>
                    </div>
                    <div class="vote-count"><span id="result-hate">
                            <?php if (isset($VoteRow['to_id'])) {
                              echo $FinalVotesa[7];
                            } else {
                              echo '0';
                            }  ?></span><span id="precent-hate"></span></div>

                </div>
                <div class="poll-four">
                    <div class="progress-cont">
                        <div class="progressBar" id="progress8">
                            <span class="progress-title">Love</span>
                        </div>
                    </div>
                    <div class="vote-count"><span id="result-love">
                            <?php if (isset($VoteRow['to_id'])) {
                              echo $FinalVotesa[6];
                            } else {
                              echo '0';
                            }  ?></span><span id="precent-love"></span></div>

                </div>
            </div>
            <div class="votes-left" data-aos="fade-up-left" data-aos-once="true">
                <div class="poll-four">
                    <div class="progress-cont">
                        <div style="background-color:#6d006d;" class="progressBar" id="progress9">
                            <span class="progress-title">Meet</span>
                        </div>

                    </div>
                    <div class="vote-count"><span id="result-meet">
                            <?php if (isset($VoteRow['to_id'])) {
                              echo $FinalVotesa[9];
                            } else {
                              echo '0';
                            }  ?></span><span id="precent-meet"></span></div>

                </div>
                <div class="poll-four">
                    <div class="progress-cont">
                        <div style="background-color:#3b255f;" class="progressBar" id="progress10">
                            <span class="progress-title">Missed</span>
                        </div>
                    </div>
                    <div class="vote-count"><span id="result-missed">
                            <?php if (isset($VoteRow['to_id'])) {
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
                    <div id="bar1" class="barfiller">
                        <span class="fill" data-percentage="0" id="progress11" style="background-color: #FFC107;"></span>
                    </div>
                    <div class="vote-count"><span id="result-nervous">
                            <?php if (isset($VoteRow['to_id'])) {
                              echo $FinalVotesa[10];
                            } else {
                              echo '0';
                            }  ?></span><span id="precent-nervous"></span></div>

                </div>
                <div class="poll-three poll-four">
                    <div class="text-bar">Brave</div>
                    <div id="bar2" class="barfiller">
                        <span class="fill" data-percentage="0" id="progress13" style="background-color: #C62828;"></span>
                    </div>
                    <div class="vote-count"><span id="result-brave">
                            <?php if (isset($VoteRow['to_id'])) {
                              echo $FinalVotesa[12];
                            } else {
                              echo '0';
                            }  ?></span><span id="precent-brave"></span></div>

                </div>
            </div>
            <div class="votes-left">
                <div class="poll-three poll-four">
                    <div class="text-bar">Boring</div>
                    <div id="bar3" class="barfiller">
                        <span class="fill" data-percentage="0" id="progress12" style="background-color: #388E3C;"></span>
                    </div>
                    <div class="vote-count"><span id="result-boring">
                            <?php if (isset($VoteRow['to_id'])) {
                              echo $FinalVotesa[11];
                            } else {
                              echo '0';
                            }  ?></span><span id="precent-boring"></span></div>

                </div>
                <div class="poll-three poll-four">
                    <div class="text-bar">Talented</div>
                    <div id="bar4" class="barfiller">
                        <span class="fill" data-percentage="0" id="progress14" style="background-color: #2196F3;"></span>
                    </div>
                    <div class="vote-count"><span id="result-talented">
                            <?php if (isset($VoteRow['to_id'])) {
                              echo $FinalVotesa[13];
                            } else {
                              echo '0';
                            }  ?></span><span id="precent-talented"></span></div>

                </div>

            </div>
        </div>
        <div class="votes-info">
            <span class="votes-result">Result: <span id="final-result">
                    <?php echo $ResultNumber; ?></span></span>
            <span id="precent"></span>
        </div>
    </fieldset>
    <div id="result4">

    </div>
    <div id="myPhoto" class="modal">
        <span class="close">&times;</span>
        <?php
        if (empty($row['avatar'])) {
          if ($row['gender'] == 1) {

            echo '<div class="modal-content" style="background-image:url' . "('img/male-user.png')" . '">'
              . '</div>';
          } else {
            echo '<div class="modal-content" style="background-image:url' . "('img/female-user.png')" . '">'
              . '</div>';
          }
        } else {
          echo '<div class="modal-content" id="img01" style="background-image:url' . "('gsuploads/gsavatar/" . $row['avatar'] .  "')" . '">' . '</div>';
        };
        ?>

        <div id="caption">
            <div class="userName">
                <?php echo $row['fullname']; ?>
            </div>

            <?php
            if ($row['verifiedaccount'] == 1) {
              echo  '<span class="userName verify-badge"' . 'title="Verify Account"' . 'dir="ltr">@' . $row["username"] . '</span></a>';
            } else {
              echo  '<span class="userName"' . 'dir="ltr">@' .  $row["username"] . '</span></a>';
            }

            ?>
        </div>
    </div>
    <fieldset class="field-Sets">
        <legend>Post</legend>
        <div class="post-animate" data-aos="flip-left" data-aos-once="true">

            <?php include $template . 'dynamic-post.php' ?>
        </div>

    </fieldset>
    <fieldset class="field-Sets">
        <legend>
            Posts
        </legend>
        <div class="posts-section" id="PostRe">
            <?php
            require 'configs/refresh/posts-refresh.php';
            ?>
        </div>
    </fieldset>
    <div id="myCover" class="modal">
        <span class="close">&times;</span>
        <?php
        if (empty($row['cover'])) {
          echo '<div class="modal-content" id="img01" style="background-image:url' . "('img/1.jpg')" . '">' . '</div>';
        } else {
          echo '<div class="modal-content" id="img01" style="background-image:url' . "('gsuploads/gscover/" .  $row['cover'] .  "')" . '">' . '</div>';
        };
        ?>

        <div id="caption">
            <div class="userName">
                <?php echo $row['fullname']; ?>
            </div>
            <?php
            if ($row['verifiedaccount'] == 1) {
              echo  '<span class="userName verify-badge"' . 'title="Verify Account"' . 'dir="ltr">@' . $row["username"] . '</span></a>';
            } else {
              echo  '<span class="userName"' . 'dir="ltr">@' .  $row["username"] . '</span></a>';
            }
            ?>
        </div>
    </div>
    <?php include $template . 'error-section.php' ?>
    <?php include $template . 'footer.php' ?>
    <script type="text/javascript" src="<?php echo $js; ?>goscripts/Modal.js"></script>
    <script type="text/javascript" src="<?php echo $js; ?>goscripts/previewImg.js"></script>
    <script type="text/javascript" src="<?php echo $js; ?>goscripts/postOpt.js"></script>
    <script type="text/javascript" src="<?php echo $js; ?>goscripts/result100.js"></script>
    <script type="text/javascript" src="<?php echo $js; ?>emojioneArea.min.js"></script>
    <script type="text/javascript" src="<?php echo $js; ?>aos.js"></script>
    <script type="text/javascript" src="<?php echo $js; ?>jquery.barfiller.js"></script>
    <script type="text/javascript" src="<?php echo $js; ?>ajax/aj-posts.js"></script>
    <script type="text/javascript" src="<?php echo $js; ?>ajax/aj-starit.js"></script>
    <script type="text/javascript" src="<?php echo $js; ?>ajax/aj-Deleterefresh.js"></script>
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