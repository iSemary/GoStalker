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
    <meta name="description" content="GoStalker settings gives you the full control to manage your account, coming soon alot of features.">
    <!--[if It IE 9]>
      <script src="<?php echo $js; ?>html5shiv.min.js"></script>
      <script src="<?php echo $js; ?>respond.min.js"></script>
    <![endif]-->
    <title>Settings | GoStalker</title>
</head>

<body style="background-color:#f3f3f3;">
    <?php
    include $template . 'header.php';
    include $template . 'error-section.php';
    ?>
    <style media="screen">
        .Er3.col-12 {position: fixed;;top: 5%;}
             </style>
    <div class="container-setting">
        <?php
        $userid = $_SESSION['id'];

        $stmt = $db->prepare("SELECT * FROM users WHERE userid = ?");
        $stmt->execute(array($userid));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();

        $stmt1 = $db->prepare("SELECT * FROM bios Where user_id = $userid");
        $stmt1->execute();
        $BioRow = $stmt1->fetchAll();
        foreach ($BioRow as $Rows) { }

        $ExtraStmt = $db->prepare("SELECT * FROM user_extra Where user_id = $userid");
        $ExtraStmt->execute();
        $ExtraInfo = $ExtraStmt->fetchAll();
        foreach ($ExtraInfo as $ExtraInfos) { }

        ?>
        <div class="container-form">

            <h2 class="stalk-setlabel" style="padding:5px;">Press "Save" when you finish editing your profile.</h2>
            <form action="" id="settings-form" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
                <input class="stalk-savechanges" id="submit-btn" name="submit" value="Save" type="submit">

                <input type="hidden" name="userid" value="<?php echo $userid ?>">
                <div class="stalk-formall">
                    <h3 class="stalk-setlabel">Full Name</h3>
                    <div class="stalk-setform">
                        <input class="stalk-form" id="fullname" maxlength="30" size="30" type="text" value="<?php echo $row['fullname'] ?>" name="fullname" pattern=".{2,}" title="You must type at least 2 character" required="required">
                    </div>
                </div>
                <div class="stalk-formall">
                    <h3 class="stalk-setlabel">Username</h3>
                    <div class="stalk-setform">
                        <input class="stalk-form" style="color: #969696;background-color: #d0d0d0;" maxlength="30" size="30" type="text" value="<?php echo $row['username'] ?>" name="username" disabled required="required">
                    </div>
                </div>
                <div class="stalk-formall">
                    <h3 class="stalk-setlabel">Email -<span><a href="change-email" class="no14" style="color:#4f005a;">Change email</a></span></h3>
                    <div class="stalk-setform">
                        <input class="stalk-form" maxlength="200" size="30" type="text" id="email" value="<?php echo $row['email'] ?>" name="email" required="required">

                        <?php
                        $EmailStatus = $row['regstatus'];
                        if ($EmailStatus == 0) {
                          echo '<span><a href="" class="no14 stalk-setlabel confrm">Confirm your email.</a></span>';
                        } ?>
                    </div>
                </div>
                <?php
                $dobexcu = $row['birthdate'];
                $DayDate = Substr($dobexcu, 8);
                $MonthDate = Substr($dobexcu, 5, 2);
                $YearDate = Substr($dobexcu, 0, 4);
                ?>
                <div class="stalk-birthGender">
                    <div class="stalk-formall">
                        <h3 class="stalk-setlabel">Birthday</h3>
                        <div class="birthdate">
                            <select class="birthform" name="day">
                                <?php
                                for ($i = 1; $i <= 31; $i++)
                                if ($DayDate == $i) {
                                  echo "<option value='$i' selected>$i</option>";
                                } else {
                                  echo "<option value='$i'>$i</option>";
                                }
                                ?>
                            </select>
                            <select class="birthform" name="month">
                                <option value="1" <?PHP if ($MonthDate == 1) {
                                                    echo "selected";
                                                  } ?>>January</option>
                                <option value="2" <?PHP if ($MonthDate == 2) {
                                                    echo "selected";
                                                  } ?>>February</option>
                                <option value="3" <?PHP if ($MonthDate == 3) {
                                                    echo "selected";
                                                  } ?>>March</option>
                                <option value="4" <?PHP if ($MonthDate == 4) {
                                                    echo "selected";
                                                  } ?>>April</option>
                                <option value="5" <?PHP if ($MonthDate == 5) {
                                                    echo "selected";
                                                  } ?>>May</option>
                                <option value="6" <?PHP if ($MonthDate == 6) {
                                                    echo "selected";
                                                  } ?>>June</option>
                                <option value="7" <?PHP if ($MonthDate == 7) {
                                                    echo "selected";
                                                  } ?>>July</option>
                                <option value="8" <?PHP if ($MonthDate == 8) {
                                                    echo "selected";
                                                  } ?>>August</option>
                                <option value="9" <?PHP if ($MonthDate == 9) {
                                                    echo "selected";
                                                  } ?>>September</option>
                                <option value="10" <?PHP if ($MonthDate == 10) {
                                                      echo "selected";
                                                    } ?>>October</option>
                                <option value="11" <?PHP if ($MonthDate == 11) {
                                                      echo "selected";
                                                    } ?>>November</option>
                                <option value="12" <?PHP if ($MonthDate == 12) {
                                                      echo "selected";
                                                    } ?>>December</option>
                            </select>
                            <select class="birthform" name="year">
                                <?php
                                for ($i = 2013; $i >= 1918; $i--)
                                if ($YearDate == $i) {
                                  echo "<option value='$i' selected>$i</option>";
                                } else {
                                  echo "<option value='$i'>$i</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="stalk-formall">
                        <h3 class="stalk-setlabel">Gender</h3>
                        <select class="genderform" name="gender" id="gender">
                            <?php
                            if ($row['gender'] == 1) {
                              echo '<option value="1" selected>Male</option>' . '<br>' . '<option value="2">Female</option>';
                            } else {
                              echo '<option value="2" selected>Female</option>' . '<br>' . '<option value="1">Male</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="stalk-formall">
                    <h3 class="stalk-setlabel">Password</h3>
                    <button class="stalk-password" type="button" id="showChange">Change Password</button>
                    <div id="showContent">
                        <h3 class="stalk-setlabel" style="margin:5px;">Old Password</h3>
                        <input type="password" pattern=".{8,}" title="You must type at least 8 character" name="Check-password" class="stalk-form" autocomplete="off" />
                        <h3 class="stalk-setlabel" style="margin:5px;">New Password</h3>
                        <input type="hidden" name="oldpassword" value="<?php echo $row['password'] ?>" />
                        <input type="password" pattern=".{8,}" title="You must type at least 8 character" name="newpassword" class="stalk-form" autocomplete="off" />
                        <h3 class="stalk-setlabel" style="margin:5px;">Retype New Password</h3>
                        <input type="password" pattern=".{8,}" title="You must type at least 8 character" name="newpassword_again" class="stalk-form" autocomplete="off" />
                    </div>

                </div>
                <div class="stalk-formall">
                    <h3 class="stalk-setlabel">Change Avatar - Cover Pictures</h3>
                    <div class="pc-change">
                        <!-- Avatar Input -->
                        <h3 class="stalk-setlabel">Avatar</h3>
                        <input type="file" id="profilepic-sett" name="avatar">
                        <label for="profilepic-sett" class="stalk-profileSet"></label>
                        <!-- Avatar Remove  -->
                        <?php
                        if (!empty($row['avatar'])) {
                          echo '<button style="text-decoration: none;" class="stalk-profileSet stalk-profileRemove" name="remove_avatar"></button>';
                        } else { }
                        ?>
                        <br>
                        <span class="preview-text">Your Profile:</span>
                        <?php
                        if (empty($row['avatar'])) {
                          if ($row['gender'] == 1) {
                            echo  '<img id="preview-img"' . 'src="img/male-user.png"/>';
                          } else {
                            echo  '<img id="preview-img"' . 'src="img/female-user.png"/>';
                          }
                        } else {
                          echo  '<img id="preview-img"' . 'src="gsuploads/gsavatar/' . $row['avatar'] . '"/>';
                        }
                        ?>
                        <div>
                            <h3 class="stalk-setlabel">Cover</h3>
                            <div>
                                <!-- Cover Input -->
                                <input type="file" id="coverpic-sett" name="cover">
                                <label for="coverpic-sett" class="stalk-coverSet">Cover</label>
                                <!-- Cover Remove  -->
                                <?php
                                if (!empty($row['cover'])) {
                                  echo  '<button style="color: white;" class="stalk-coverSet stalk-coverRemove" name="remove_cover">Cover</button>';
                                } else { }
                                ?>
                            </div>
                            <div style="margin-top: 5px;">
                                <span class="preview-text">Your Cover:</span>
                                <?php
                                if (empty($row['cover'])) {
                                  echo  '<img id="preview-cover"' . 'style="border-radius:0;width: 100px;"' . 'src="img/1.jpg"/>';
                                } else {
                                  echo  '<img id="preview-cover"' .  'style="border-radius:0;width: 100px;"' . 'src="gsuploads/gscover/' . $row['cover'] . '"/>';
                                };
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="stalk-formall" style="margin-top:15px;">
                    <h3 class="stalk-setlabel">Badges&emsp;<span class="badge-info">Hover to zoom, Click to select.</span></h3>
                    <div class="badges-container">
                        <a class="badgee badge-0" href="#" onclick="return false;">X</a>
                        <a class="badgee badge-1" href="#" onclick="return false;"></a>
                        <a class="badgee badge-2" href="#" onclick="return false;"></a>
                        <a class="badgee badge-3" href="#" onclick="return false;"></a>
                        <a class="badgee badge-4" href="#" onclick="return false;"></a>
                        <a class="badgee badge-5" href="#" onclick="return false;"></a>
                        <a class="badgee badge-6" href="#" onclick="return false;"></a>
                        <a class="badgee badge-7" href="#" onclick="return false;"></a>
                        <a class="badgee badge-8" href="#" onclick="return false;"></a>
                        <a class="badgee badge-9" href="#" onclick="return false;"></a>
                        <a class="badgee badge-10" href="#" onclick="return false;"></a>
                        <a class="badgee badge-11" href="#" onclick="return false;"></a>
                        <a class="badgee badge-12" href="#" onclick="return false;"></a>
                        <a class="badgee badge-13" href="#" onclick="return false;"></a>
                        <a class="badgee badge-14" href="#" onclick="return false;"></a>
                        <a class="badgee badge-15" href="#" onclick="return false;"></a>
                        <a class="badgee badge-16" href="#" onclick="return false;"></a>
                        <a class="badgee badge-17" href="#" onclick="return false;"></a>
                        <a class="badgee badge-18" href="#" onclick="return false;"></a>
                        <a class="badgee badge-19" href="#" onclick="return false;"></a>
                        <a class="badgee badge-20" href="#" onclick="return false;"></a>
                        <a class="badgee badge-21" href="#" onclick="return false;"></a>
                        <a class="badgee badge-22" href="#" onclick="return false;"></a>
                        <a class="badgee badge-23" href="#" onclick="return false;"></a>
                        <a class="badgee badge-24" href="#" onclick="return false;"></a>
                        <a class="badgee badge-25" href="#" onclick="return false;"></a>
                        <a class="badgee badge-26" href="#" onclick="return false;"></a>
                        <a class="badgee badge-27" href="#" onclick="return false;"></a>
                        <a class="badgee badge-28" href="#" onclick="return false;"></a>
                        <a class="badgee badge-29" href="#" onclick="return false;"></a>
                    </div>
                    <input type="text" id="badgeInput" name="badgeSelect" value="<?php if (isset($ExtraInfos['badges'])) {
                                                                                    echo $ExtraInfos['badges'];
                                                                                  } else {
                                                                                    echo '0';
                                                                                  } ?>" hidden>
                </div>
                <div class="stalk-formall">
                    <h3 class="stalk-setlabel">Bio</h3>
                    <div class="bioset-form">
                        <label>Age&#58;</label>
                        <div class="stalk-bioset">
                            <input class="stalk-form" maxlength="30" size="30" type="text" name="age" value="<?php if (isset($Rows['age'])) {
                                                                                                                echo $Rows['age'];
                                                                                                              } else { } ?>">
                        </div>
                        <label>Location&#58;</label>
                        <div class="stalk-bioset">
                            <input class="stalk-form" maxlength="30" size="30" type="text" name="location" value="<?php if (isset($Rows['location'])) {
                                                                                                                    echo $Rows['location'];
                                                                                                                  } else { } ?>">
                        </div>
                        <label>Status&#58;</label>
                        <div class="stalk-bioset">
                            <input class="stalk-form" maxlength="30" size="30" type="text" name="status" value="<?php if (isset($Rows['status'])) {
                                                                                                                  echo $Rows['status'];
                                                                                                                } else { } ?>">
                        </div>
                        <label>Height&#58;</label>
                        <div class="stalk-bioset">
                            <input class="stalk-form" maxlength="30" size="30" type="text" name="height" value="<?php if (isset($Rows['height'])) {
                                                                                                                  echo $Rows['height'];
                                                                                                                } else { } ?>">
                        </div>
                        <div class="stalk-bioset">
                            <label>Weight&#58;</label>
                            <input class="stalk-form" maxlength="30" size="30" type="text" name="weight" value="<?php if (isset($Rows['weight'])) {
                                                                                                                  echo $Rows['weight'];
                                                                                                                } else { } ?>">
                        </div>
                        <label>Hobby&#58;</label>
                        <div class="stalk-bioset">
                            <input class="stalk-form" maxlength="30" size="30" type="text" name="hobby" value="<?php if (isset($Rows['hobby'])) {
                                                                                                                  echo $Rows['hobby'];
                                                                                                                } else { } ?>">
                        </div>
                        <label>Weight&#58;</label>
                        <label>Drink&#58;</label>
                        <div class="stalk-bioset">
                            <input class="stalk-form" maxlength="30" size="30" type="text" name="drink" value="<?php if (isset($Rows['drink'])) {
                                                                                                                  echo $Rows['drink'];
                                                                                                                } else { } ?>">
                        </div>
                        <label>Food&#58;</label>
                        <div class="stalk-bioset">
                            <input class="stalk-form" maxlength="30" size="30" type="text" name="food" value="<?php if (isset($Rows['food'])) {
                                                                                                                echo $Rows['food'];
                                                                                                              } else { } ?>">
                        </div>
                        <label>Singer&#92;Band&#58;</label>
                        <div class="stalk-bioset">
                            <input class="stalk-form" maxlength="30" size="30" type="text" name="singer" value="<?php if (isset($Rows['singer'])) {
                                                                                                                  echo $Rows['singer'];
                                                                                                                } else { } ?>">
                        </div>
                        <label>Movie&#92;Series&#58;</label>
                        <div class="stalk-bioset">
                            <input class="stalk-form" maxlength="30" size="30" type="text" name="movie" value="<?php if (isset($Rows['movie'])) {echo $Rows['movie'];} else { } ?>">
                        </div>
                    </div>
                </div>
                <div class="stalk-formall">
                    <h3 class="stalk-setlabel">Favourite Music</h3><span><img src="img/soundcloud.png " class="soundcloud-input" /></span>
                    <h3 class="stalk-setlabel">Put the link of your favourite sound here.</h3>
                    <input type="text" maxlength="150" class="stalk-form" name="fav-music" value="<?php if (isset($ExtraInfos['sound_music'])) { echo $ExtraInfos['sound_music'];} else {} ?>"placeholder="example:https://soundcloud.com/interscope/lana-del-rey-blue-jeans-1">
                </div>
                <div class="stalk-formall">
                    <h3 class="stalk-setlabel">Blocked Users</h3>
                    <a class="blocked-stalkers" href="blocked-users">View Block List</a>
                </div>
                <div class="stalk-formall">
                    <h3 class="stalk-setlabel">Deactivate</h3>
                    <a class="stalk-deactivate" href="deactivate-account">Deactivate account</a>
                </div>
                <div class="stalk-formall">
                    <hr>
                    <a class="stalk-cancelchanges" href="home">Cancel</a>
                </div>
            </form>
        </div>
    </div>
    <?php include $template . 'footer.php'; ?>
    <script type="text/javascript" src="<?php echo $js; ?>goscripts/change-password.js"></script>
    <script type="text/javascript" src="<?php echo $js; ?>goscripts/previewImg.js"></script>
    <script type="text/javascript" src="<?php echo $js; ?>goscripts/badgeSelector.js"></script>
    <script type="text/javascript" src="<?php echo $js; ?>ajax/aj-settings.js"></script>
</body>

</html> 