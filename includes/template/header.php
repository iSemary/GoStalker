<?php
$userid = $_SESSION['id'] ;
$stmt = $db->prepare("SELECT userid,fullname,verifiedaccount,username,avatar,cover,gender FROM users WHERE userid = ?");
$stmt->execute(array($userid));
$row = $stmt->fetch();
// count notifictons
$CountNotifications = $db->prepare("SELECT COUNT(*) FROM notifications WHERE receiver = ? AND notification_seen = 1");
$CountNotifications->execute(array($userid));
$CountNotificationsF = $CountNotifications->fetch();
// count messages
$CountMessages = $db->prepare("SELECT COUNT(*) FROM messages WHERE receiver = ? AND chat_read = 1");
$CountMessages->execute(array($userid));
$CountMessagesF = $CountMessages->fetch();
?>
<div id="main">
    <div class="header">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                  <div class="gslogo">
                    <a href="home">
                        <img src="img/GoStalker45.png" class="gslogoimg" height="30px" width="264px" alt="GoStalker">
                    </a>
                  </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                  <div class="acclive">
                    <a href='home' title="Home"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" width="30" height="30" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg); margin-bottom:-4px; margin-right: -3px;" preserveAspectRatio="xMidYMid meet" viewBox="0 0 384 512"><path d="M171.8 503.8c0-5.3 4.8-12.2 4.8-22.3 0-15.2-13-39.9-78.1-86.6C64.2 365.8 32 336.4 32 286.6 32 171.9 179.1 110.1 179.1 18c0-3.3-.2-6.7-.6-10 5.1 2.4 39.1 43.3 39.1 90.4 0 80.5-105.1 129.2-105.1 203 0 26.9 16.6 47.2 32.6 69.5 22.5 30.2 44.2 56.9 44.2 86.5-.1 14.5-4.4 29.7-17.5 46.4zm146-241.4c1.5 8.4 2.2 16.6 2.2 24.6 0 51.8-29.4 97.5-67.3 136.8-1 1-2.2 2.4-3.2 2.4-3.6 0-35.5-41.6-35.5-53.2 0 0 41.8-55.7 41.8-96.9 0-10.8-2.7-21.7-9.1-33.4-1.5 32.3-55.7 87.7-58.1 87.7-2.7 0-17.9-22-17.9-42.1 0-5.3 1-10.7 3.2-15.8 2.4-5.5 56.6-72 56.6-116.7 0-6.2-1-12-3.4-17.1l-4-7.2c16.7 6.5 82.6 64.1 94.7 130.9" style="transition: .4s ease;" fill="white"/></svg></a>
                    <?php if($CountMessagesF[0] > 0){ 
                        echo '<a href="messages"><i class="fa fa-comments" title="Messages"><span class="notify-counter">'. $CountMessagesF[0] . '</span></i></a>';
                       }else{
                        echo '<a href="messages"><i class="fa fa-comments" title="Messages"></i></a>';
                      }
                      ?>

                      <?php if($CountNotificationsF[0] > 0){ 
                        echo '<a href="notification"><i class="fa fa-bell" title="Notification"><span class="notify-counter">'. $CountNotificationsF[0] . '</span></i></a>';
                       }else{
                        echo '<a href="notification"><i class="fa fa-bell" title="Notification"></i></a>'; 
                       }
                      ?>
                  </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <form action="search"method="GET">
                        <div class="search-bar searchi">
                           <input class="searchtop"  name="q"  pattern=".{0,}" title="Search for someone or post..." placeholder="Search..." required/>
                           <label for="Searchbtn1"><i class="fa fa-search" ></i></label>
                           <input type="submit" id="Searchbtn1" value="Search" hidden>
                        </div>
                      </form>
                      <div class="search-result" id="result-search-query">

                      </div>
                    </div>


                    <div class="col-lg-3 col-md-3 col-sm-3">
                <div class="threeico">
                  <a><i class="fa fa-cogs" title="Settings" onclick="openNav()"></i></a>
                  <div id="mySidenav" class="sidenav">
                    <div class="nav-prefix">
                      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                      <a href="myprofile" title="My Profile" class="imglink">
                    <?php
                    if(empty($row['avatar'])) {
                        if ( $row['gender'] == 1) {

                          echo '<div class="profilepic coverpic" style="background-image:url' . "('img/male-user.png')" . '">'
                          . '</div>';

                        } else {
                          echo '<div class="profilepic coverpic" style="background-image:url' . "('img/female-user.png')" . '">'
                          . '</div>';
                        }
                      } else {
                        echo '<div class="profilepic coverpic" style="background-image:url' . "('gsuploads/gsavatar/" . $row['avatar'] .  "')" . '">' . '</div>';
                      };
                        ?>
                    </a>
                    <div class="setaloga">
                        <a class="alink setlink"
                        href="settings"
                        >Settings</a>
                        <a class="alink loglink" href="logout.php">Logout</a>
                    </div>
                  </div>

                  <div class="nav-prefix">
                    <form action="search"method="GET">
                      <div class="search-bar searchi">
                         <input class="searchtop"  name="q" pattern=".{0,}" title="Search for someone or post..." placeholder="Search..." required/>
                         <label for="Searchbtn2"><i class="fa fa-search" ></i></label>
                         <input type="submit" id="Searchbtn2" value="Search" hidden>
                      </div>
                    </form>
                  </div>
                  <div class="nav-prefix">
                        <div class="linksnav">
                            <a class="alink" href="conditions#list-item-1">About</a>
                            <a class="alink" href="conditions#list-item-2">Terms</a>
                            <a class="alink" href="conditions#list-item-3">Privacy Policy</a>
                            <a class="alink" href="conditions#list-item-4">Cookies Policy</a>
                            <a class="alink" href="conditions#list-item-5">Contact</a>
                            <a class="alink" href="conditions#list-item-0">Help</a>
                            <span class="fl-left">GoStalker 2018 &copy;</span>
                        </div>
                      </div>
                    </div>
                      <a href='stalkers' title="Stalkers"><i class="fa fa-users"id="usersico"></i></a>
                      </div>
                    </div>
                  </div>
                </div>
              <div class="contain">
