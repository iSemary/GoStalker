<?php 
session_start();
if (isset($_SESSION['username'])) { } elseif (isset($_COOKIE['GS'])) {
  require '../api/classes/logged.php';
} else {
  header('location: ../signup');
  exit();
}
include '../connect.php';
include '../init.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta lang="en" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <link href="../favico.ico" rel="icon" type="image/x-icon">
    <link rel="stylesheet" href="../includes/layout/style/style.css" />
    <link rel="stylesheet" href="../includes/layout/style/normalize.css" />
    <link rel="stylesheet" href="../includes/layout/style/font-awesome.min.css">
    <link rel="stylesheet" href="../includes/layout/style/bootstrap.css" />
    <link rel="stylesheet" href="../includes/layout/style/emojionearea.min.css" />
    <meta name="description" content="GoStalker helps you to get freinds feedback as votes and good or evil messages !">
    <style>
        @media only screen and (max-width: 717px) {
        .chatbox {display: contents;}
        .chat-all {display: grid;}
        .chat-all .messagesection {height: 106px;border-bottom: 4px solid #c5c5c5;margin-bottom: 10px;}
        .chatlogs {height: 350px;}
      }
      .chat-all .messagesection {height: 106px;}
      .messagescontent h6 {padding-bottom: 4px;}
      .chat .user-photo {background-repeat: no-repeat;background-size: cover;background-position: center;background-attachment: local;width: 30px;height: 30px;border-radius: 50%;}
    </style>
    <title>Messages | GoStalker</title>
</head>

<body>
    <div id="main">
        <?php
        $userid = $_SESSION['id'];

        $stmt = $db->prepare("SELECT `userid`, `fullname`, `username`,`gender`, `avatar`, `verifiedaccount`, `regstatus`, `birthdate`, `userstatus` FROM users WHERE userid = ?");
        $stmt->execute(array($userid));
        $row = $stmt->fetch();

        $username = $db->prepare('SELECT userid, username, fullname, avatar, gender, userstatus FROM users WHERE username=:username');
        $username->execute(array(':username' => $_GET['username']));
        $rowuser = $username->fetch();
        $count = $username->rowCount();
        $Toid = $rowuser['userid'];

        // Fetch The User Info --> user in the GET
        $username = $db->prepare('SELECT `userid`, `fullname`, `username`, `gender`, `avatar`, `verifiedaccount`, `regstatus`, `birthdate`, `userstatus` FROM users WHERE username=:username');
        $username->execute(array(':username' => $_GET['username']));
        $rowuser = $username->fetch();
        $count = $username->rowCount();
        // count messages
        $CountMessages = $db->prepare("SELECT COUNT(*) FROM messages WHERE receiver = ? AND chat_read = 1");
        $CountMessages->execute(array($userid));
        $CountMessagesF = $CountMessages->fetch();
        // count notifictons
        $CountNotifications = $db->prepare("SELECT COUNT(*) FROM notifications WHERE receiver = ? AND notification_seen = 1");
        $CountNotifications->execute(array($userid));
        $CountNotificationsF = $CountNotifications->fetch();

        if (isset($_GET['username'])) {
          if ($_GET['username'] == strtolower($row['username'])) {
            header('location: ../stalkers');
            exit();
          } elseif ($count < 1) {
            header('location: ../stalkers');
            exit();
          }


          // If i blocked him
          $Blocked = $db->prepare("SELECT * FROM block WHERE from_id = '$userid' AND to_id = '$Toid'");
          $Blocked->execute();
          $BlockedFe = $Blocked->fetch();
          // if he blocked me
          $BlockedII = $db->prepare("SELECT * FROM block WHERE from_id = '$Toid' AND to_id = '$userid'");
          $BlockedII->execute();
          $BlockedFeII = $BlockedII->fetch();
          // if he deactivated
          $HisStatus = $rowuser['userstatus'];

          if ($BlockedFe == 1 || $BlockedFeII == 1 || $HisStatus == 1) {
            header('location: ../404');
          }
        } else {
          header('location: ../stalkers');
          exit();
        }

        ?>
        <div class="header">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="gslogo">
                        <a href="../home">
                            <img src="../img/GoStalker45.png" class="gslogoimg" height="30px" width="264px" alt="GoStalker">
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="acclive">
                    <a href='../home'><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" width="30" height="30" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg); margin-bottom:-4px; margin-right: -3px;" preserveAspectRatio="xMidYMid meet" viewBox="0 0 384 512">
                            <path d="M171.8 503.8c0-5.3 4.8-12.2 4.8-22.3 0-15.2-13-39.9-78.1-86.6C64.2 365.8 32 336.4 32 286.6 32 171.9 179.1 110.1 179.1 18c0-3.3-.2-6.7-.6-10 5.1 2.4 39.1 43.3 39.1 90.4 0 80.5-105.1 129.2-105.1 203 0 26.9 16.6 47.2 32.6 69.5 22.5 30.2 44.2 56.9 44.2 86.5-.1 14.5-4.4 29.7-17.5 46.4zm146-241.4c1.5 8.4 2.2 16.6 2.2 24.6 0 51.8-29.4 97.5-67.3 136.8-1 1-2.2 2.4-3.2 2.4-3.6 0-35.5-41.6-35.5-53.2 0 0 41.8-55.7 41.8-96.9 0-10.8-2.7-21.7-9.1-33.4-1.5 32.3-55.7 87.7-58.1 87.7-2.7 0-17.9-22-17.9-42.1 0-5.3 1-10.7 3.2-15.8 2.4-5.5 56.6-72 56.6-116.7 0-6.2-1-12-3.4-17.1l-4-7.2c16.7 6.5 82.6 64.1 94.7 130.9" style="transition: .4s ease;" fill="white" /></svg></a>
                                <?php if($CountMessagesF[0] > 0){ 
                        echo '<a href="../messages"><i class="fa fa-comments" title="Messages"><span class="notify-counter">'. $CountMessagesF[0] . '</span></i></a>';
                       }else{
                        echo '<a href="../messages"><i class="fa fa-comments" title="Messages"></i></a>';
                      }
                      ?>

                      <?php if($CountNotificationsF[0] > 0){ 
                        echo '<a href="../notification"><i class="fa fa-bell" title="Notification"><span class="notify-counter">'. $CountNotificationsF[0] . '</span></i></a>';
                       }else{
                        echo '<a href="../notification"><i class="fa fa-bell" title="Notification"></i></a>'; 
                       }
                      ?>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-3">
                    <form action="../search" method="GET">
                        <div class="search-bar searchi">
                            <input class="searchtop" name="q" pattern=".{0,}" title="Search for someone or post..." placeholder="Search..." required />
                            <label for="Searchbtn"><i class="fa fa-search"></i></label>
                            <input type="submit" id="Searchbtn" value="Search" hidden>
                        </div>
                    </form>
                </div>


                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="threeico">
                        <a><i class="fa fa-cogs" title="Settings" onclick="openNav()"></i></a>
                        <div id="mySidenav" class="sidenav">
                            <div class="nav-prefix">
                                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                                <a href="myprofile" title="My Profile" class="imglink">
                                    <?php
                                    if (empty($row['avatar'])) {
                                      if ($row['gender'] == 1) {

                                        echo '<div class="profilepic coverpic" style="background-image:url' . "('../img/male-user.png')" . '">'
                                          . '</div>';
                                      } else {
                                        echo '<div class="profilepic coverpic" style="background-image:url' . "('../img/female-user.png')" . '">'
                                          . '</div>';
                                      }
                                    } else {
                                      echo '<div class="profilepic coverpic" style="background-image:url' . "('../gsuploads/gsavatar/" . $row['avatar'] .  "')" . '">' . '</div>';
                                    };
                                    ?>
                                </a>
                                <div class="setaloga">
                                    <a class="alink setlink" href="../settings">Settings</a>
                                    <a class="alink loglink" href="../logout">Logout</a>
                                </div>
                            </div>

                            <div class="nav-prefix">
                                <form action="../search" method="GET">
                                    <div class="search-bar searchi">
                                        <input class="searchtop" name="q" pattern=".{0,}" title="Search for someone or post..." placeholder="Search..." required />
                                        <label for="Searchbtn"><i class="fa fa-search"></i></label>
                                        <input type="text" name="userexi" value="<?php echo $_GET['username']; ?>" hidden>
                                        <input type="submit" id="Searchbtn" value="Search" hidden>
                                    </div>
                                </form>
                            </div>
                            <div class="nav-prefix">
                                <div class="linksnav">
                                    <a class="alink" href="../conditions#list-item-1">About</a>
                                    <a class="alink" href="../conditions#list-item-2">Terms</a>
                                    <a class="alink" href="../conditions#list-item-3">Privacy Policy</a>
                                    <a class="alink" href="../conditions#list-item-4">Cookies Policy</a>
                                    <a class="alink" href="../conditions#list-item-5">Contact</a>
                                    <a class="alink" href="../conditions#list-item-0">Help</a>
                                    <span class="fl-left">GoStalker 2018 &copy;</span>
                                </div>
                            </div>
                        </div>
                        <a href='../stalkers' title="Stalker"><i class="fa fa-users" id="usersico"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="contain">
            <div class="chat-all">
                <div class="messagesleft">
                    <div class="messagescontent">
                        <div class="messagesection">
                            <div class="usermessage mar">
                                <div class="userprofile">
                                    <a class="user-profile">
                                        <?php
                                        if (empty($rowuser['avatar'])) {
                                          if ($rowuser['gender'] == 1) {
                                            echo '<img class="user-profile-img" src="../img/male-user.png" width="50px" height="50px"/>';
                                          } else {
                                            echo '<img class="user-profile-img" src="../img/female-user.png" width="50px" height="50px"/>';
                                          }
                                        } else {
                                          echo '<img class="user-profile-img" src="../gsuploads/gsavatar/' . $rowuser['avatar'] . '"width="50px" height="50px"/>';
                                        }

                                        ?>

                                    </a>
                                    <h4>
                                        <?php echo $rowuser['fullname']; ?>
                                    </h4>
                                </div>
                                <div class="usermessage-info">
                                    <div class="message-info">
                                        <h6>Write Message to @<?php echo $rowuser['username']; ?>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="chatbox">
                    <div class="chatlogs">
                        <?php
                        $MessagesStmt1 = $db->prepare("SELECT messages.id, messages.body, messages.chat_date, s.userid AS sender, r.userid AS receiver From messages LEFT JOIN users s ON messages.sender = s.userid LEFT JOIN users r ON messages.receiver = r.userid WHERE (r.userid=:r AND s.userid=:s) OR r.userid=:s AND s.userid=:r");
                        $MessagesStmt1->execute(array(':s' => $userid, ':r' => $Toid));
                        $GetMessages1 = $MessagesStmt1->fetchAll();

                        $GetLastMessage = $db->prepare("SELECT id FROM messages WHERE sender = :sender AND receiver=:receiver ORDER BY id DESC");
                        $GetLastMessage->execute(array(':sender' => $userid, ':receiver' => $Toid));
                        $GetLastOne = $GetLastMessage->fetch();

                        $mid = $GetLastOne['id'];
                        $ReadMessage = $db->prepare('UPDATE messages SET chat_read = 0 WHERE receiver = ? AND sender = ?');
                        $ReadMessage->execute(array($userid, $Toid));

                        foreach ($GetMessages1 as $GetMessagesA) {
                          $MessageDate =  strtotime($GetMessagesA['chat_date']);

                          if ($GetMessagesA['sender'] != $userid) {
                            echo
                              '<div class="chat friend">
                <div class="user-photo">';
                            if (empty($rowuser['avatar'])) {
                              if ($rowuser['gender'] == 1) {
                                echo '<img class="user-photo" src="../img/male-user.png" width="50px" height="50px"/>';
                              } else {
                                echo '<img class="user-photo" src="../img/female-user.png" width="50px" height="50px"/>';
                              }
                            } else {
                              echo '<img class="user-photo" src="../gsuploads/gsavatar/' . $rowuser['avatar'] . '"width="50px" height="50px"/>';
                            }
                            echo '</div>
                <p class="chat-message">' . Emojione\Emojione::toImage($GetMessagesA['body']) . '</p>
                <div class="timestamp">' .  date('Y-M-j | g:i a', $MessageDate) . '</div>
            </div>';
                          } else {
                            echo
                              '<div class="chat self">
                  <div class="user-photo">';
                            if (empty($row['avatar'])) {
                              if ($row['gender'] == 1) {
                                echo '<img class="user-photo" src="../img/male-user.png" width="50px" height="50px"/>';
                              } else {
                                echo '<img class="user-photo" src="../img/female-user.png" width="50px" height="50px"/>';
                              }
                            } else {
                              echo '<img class="user-photo" src="../gsuploads/gsavatar/' . $row['avatar'] . '"width="50px" height="50px"/>';
                            }
                            echo '</div>
                  <p class="chat-message">' . Emojione\Emojione::toImage($GetMessagesA['body']) . '</p>
                  <div class="timestamp">' .  date('Y-M-j | g:i a', $MessageDate) . '</div>

              </div>';
                          }
                        }
                        ?>

                    </div>

                    <form action="" method="POST" id="message-form">
                        <div class="chat-form">
                            <textarea name="message-a" placeholder="Write your message..." class="message-body chat-boxs" maxlength="255"></textarea>
                            <input type="text" name="userexi" value="<?php echo $_GET['username']; ?>" hidden>
                            <button type="submit" name="send" id="send-btn">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
    include '../' . $template . 'error-section.php';
    include '../' . $template . 'footer.php'; ?>
    <script type="text/javascript" src="../includes/layout/script/goscripts/navSetting.js"></script>
    <script type="text/javascript" src="../includes/layout/script/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="../includes/layout/script/ajax/aj-stalk-mess.js"></script>
</body>
</html> 