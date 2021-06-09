<?php
if (!isset($_SESSION)) {
  session_start();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  include '../connect.php';
  include '../init.php';
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


  // Get variables from the form
  $id     = filter_var($_POST['userid'], FILTER_SANITIZE_STRING);
  $email  = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
  $name   = filter_var($_POST['fullname'], FILTER_SANITIZE_STRING);
  $gender = filter_var($_POST['gender'], FILTER_SANITIZE_STRING);
  $dobArr = array(filter_var($_POST[ 'year'], FILTER_SANITIZE_NUMBER_INT), filter_var($_POST[ 'month'], FILTER_SANITIZE_NUMBER_INT), filter_var($_POST[ 'day'], FILTER_SANITIZE_NUMBER_INT));
  $dateOfBirth = implode('-', $dobArr);



  // upload variables
  // avatar
  $avatar = $_FILES['avatar'];
  $avatarName = $_FILES['avatar']['name'];
  $avatarSize = $_FILES['avatar']['size'];
  $avatarTmp = $_FILES['avatar']['tmp_name'];
  $avatarType = $_FILES['avatar']['type'];
  $avatarAllowedExtension = array("jpeg", "jpg", "png");
  $expAvatarName = explode('.', $avatarName);
  $avatarExtension = strtolower(end($expAvatarName));
  $oldAvatar = $row['avatar'];


  // Cover
  $cover = $_FILES['cover'];
  $coverName = $_FILES['cover']['name'];
  $coverSize = $_FILES['cover']['size'];
  $coverTmp = $_FILES['cover']['tmp_name'];
  $coverType = $_FILES['cover']['type'];
  $coverAllowedExtension = array("jpeg", "jpg", "png");
  $expCoverName = explode('.', $coverName);
  $coverExtension = strtolower(end($expCoverName));
  $oldCover = $row['cover'];


  // Badges
  $Music  = filter_var($_POST['fav-music'], FILTER_SANITIZE_STRING);
  $Badgeid = filter_var($_POST['badgeSelect'], FILTER_SANITIZE_NUMBER_INT);
  //Bio
  $age  = filter_var($_POST['age'], FILTER_SANITIZE_STRING);
  $location  = filter_var($_POST['location'], FILTER_SANITIZE_STRING);
  $status  = filter_var($_POST['status'], FILTER_SANITIZE_STRING);
  $height  = filter_var($_POST['height'], FILTER_SANITIZE_STRING);
  $weight  = filter_var($_POST['weight'], FILTER_SANITIZE_STRING);
  $hobby  = filter_var($_POST['hobby'], FILTER_SANITIZE_STRING);
  $drink  = filter_var($_POST['drink'], FILTER_SANITIZE_STRING);
  $food  = filter_var($_POST['food'], FILTER_SANITIZE_STRING);
  $singer  = filter_var($_POST['singer'], FILTER_SANITIZE_STRING);
  $movie  = filter_var($_POST['movie'], FILTER_SANITIZE_STRING);

  // validate the form
  $formErrors = array();
  if (strlen($name) < 2) {
    $formErrors[]  = '<h5>Full Name cant be less than <strong>2 letters.</strong></h5>';
  } elseif (strlen($name) > 5) {
    $formErrors[] = '<h5>Full Name cant be more than <strong>32 letters.</strong></h5>';
  } elseif (empty($name) || empty($email) || empty($gender) || empty($dobArr)) {
    $formErrors[] = '<h5>Please fill in all<strong> fields.</strong></h5>';
  } elseif (!empty($avatarName) && !in_array($avatarExtension, $avatarAllowedExtension)) {
    $formErrors[] = '<h5>Sorry this file not an <strong>image !</strong></h5>';
  } elseif ($avatarSize > 2621440) {
    $formErrors[] = '<h5>Sorry this file more than <strong>2.5 Mb.</strong></h5>';
  } elseif (!empty($coverName) && !in_array($coverExtension, $coverAllowedExtension)) {
    $formErrors[] = '<h5>Sorry this file not an <strong>image !</strong></h5>';
  } elseif ($coverSize > 2621440) {
    $formErrors[] = '<h5>Sorry this file more than <strong>2.5 Mb.</strong></h5>';
  } elseif (isset($_POST['badgeSelect']) && !is_numeric($_POST['badgeSelect']) || $Badgeid >= 30) {
    $formErrors[] = '<h5>Please Choose a <strong>Badge !</strong></h5>';
  }


  if (!empty($Music)) {
    if (strpos($Music, 'https://www.soundcloud.com/')  === 0 || strpos($Music, 'https://soundcloud.com/')  === 0 || strpos($Music, 'https://m.soundcloud.com/') === 0) { } else {
      $formErrors[] = '<h5>Please Write a <strong>SoundCloud Link</strong></h5>';
    }
  }


  if (!empty($_POST['Check-password'])) {
    if ($_POST['Check-password'] == $_POST['oldpassword']) {
      if (empty($_POST['newpassword'])) {
        $pass = $_POST['oldpassword'];
      } else {
        $pass = sha1($_POST['newpassword']);
      }
    } else {
      $formErrors[] = '<h5>You typed a wrong Password</h5>';
    }

    if ($_POST['Check-password'] !== $_POST['oldpassword']) {
      $formErrors[] = '<h5>You typed a wrong Password</h5>';
    }
  }



  if (!empty($_POST['newpassword'])) {
    if (strlen($_POST['newpassword']) < 8 || strlen($_POST['newpassword_again']) < 8) {
      $formErrors[] = "<h5>Password can't be less than <strong> 8 letters.</strong></h5>";
    }
    if ($_POST['newpassword'] != $_POST['newpassword_again']) {
      $formErrors[] = "<h5>Password Wrong <strong> Please Retype your new password correct.</strong></h5>";
    }
  }

  if (empty($_POST['newpassword'])) {
    $pass = $_POST['oldpassword'];
  }



  // Avatar Upload
  $avatarlocation = "../gsuploads/gsavatar/" . $row['avatar'];

  if(isset($_FILES['avatar']) && $_FILES['avatar']['size'] == 0){
    $avatar = $oldAvatar;
  } else {
    if(empty($avatar)){
      $avatar =  'GS' . '_' . rand(0, 1000000000) . '.' . $avatarExtension;
      move_uploaded_file($avatarTmp, "..\gsuploads\gsavatar\\" . $avatar);
    }else{
      unlink($avatarlocation);
      $avatar =  'GS' . '_' . rand(0, 1000000000) . '.' . $avatarExtension;
      move_uploaded_file($avatarTmp, "..\gsuploads\gsavatar\\" . $avatar);
    }
    
  }

  // Cover Upload
  $coverlocation = "../gsuploads/gscover/" . $row['cover'];

  if(isset($_FILES['cover']) && $_FILES['cover']['size'] == 0){
    $cover = $oldCover;
  } else {
    if(empty($cover)){
      $cover =  'GS' . '_' . rand(0, 1000000000) . '.' . $coverExtension;
      move_uploaded_file($coverTmp, "..\gsuploads\gscover\\" . $cover);
    }else{
      unlink($coverlocation);
      $cover =  'GS' . '_' . rand(0, 1000000000) . '.' . $coverExtension;
      move_uploaded_file($coverTmp, "..\gsuploads\gscover\\" . $cover);
    }
      
  }


  if (empty($formErrors)) {

    // Users DataBase
    $stmt = $db->prepare('UPDATE users SET fullname = ?, email = ?, `password` = ?, avatar = ?, cover = ?, gender = ?, birthdate = ? WHERE userid = ?');
    $stmt->execute(array($name, $email, $pass, $avatar, $cover, $gender, $dateOfBirth, $userid));
    $_FILES['avatar'] = '';
    $_FILES['cover'] = '';
    // Bio DataBase
    // لو المستخدم محطش بيانات فى البايو يبقي البيانات اللى هتتكتب هيتعملها Insert
    if (empty($Rows['user_id'])) {
      $stmt1 = $db->prepare("INSERT INTO bios(age, location, status, height, weight, hobby, drink, food, singer, movie, user_id) VALUES(:zage, :zlocation, :zstatus, :zheight, :zweight, :zhobby, :zdrink, :zfood, :zsinger, :zmovie, :zuserid) ");
      $stmt1->execute(array(
        'zage' => $age, 'zlocation' => $location, 'zstatus' => $status, 'zheight' => $height, 'zweight' =>  $weight, 'zhobby' => $hobby, 'zdrink' =>  $drink, 'zfood' => $food, 'zsinger' => $singer, 'zmovie' =>  $movie, 'zuserid' =>  $userid
      ));
    } else {
      //  غير كدة لو المستخدم حط بيانات قبل كدة ، يبقي هيتعملها تحديث Update
      $stmt1 = $db->prepare('UPDATE bios SET age = ?, location = ?, status = ?, height = ?, weight = ?, hobby = ?, drink = ?, food = ?, singer = ?, movie = ? WHERE user_id = ?');
      $stmt1->execute(array($age, $location, $status, $height, $weight, $hobby, $drink, $food, $singer, $movie, $userid));
    }

    // Extra Info DataBase
    if (empty($ExtraInfos['user_id'])) {
      $ExtraStmt = $db->prepare("INSERT INTO user_extra(badges, sound_music, `user_id`) VALUES(:zbadges, :zsoundmusic, :zuserid)");
      $ExtraStmt->execute(array('zsoundmusic' => $Music, 'zbadges' => $Badgeid, 'zuserid' => $userid));
    } else {
      $ExtraStmt = $db->prepare('UPDATE user_extra SET badges = ?, sound_music = ? WHERE user_id = ?');
      $ExtraStmt->execute(array($Badgeid, $Music, $userid));
    }
    echo "VALID";
  } else {
    foreach ($formErrors as $error) {
      echo $error;
    }
  }
} else {}
?>
