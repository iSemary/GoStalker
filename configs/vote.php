<?php
if (!isset($_SESSION)) {
  session_start();
}
include '../connect.php';
include '../init.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $myUserid = $_SESSION['id'];
  $Hisusername = filter_var($_POST['userexi'], FILTER_SANITIZE_STRING);

  $username = $db->prepare('SELECT userid FROM users WHERE username=:username');
  $username->execute(array(':username' => $Hisusername));
  $rowuser = $username->fetch();
  $RowUserid = $rowuser['userid'];

  $VoteStmt = $db->prepare("SELECT * FROM votes WHERE to_id = ? AND from_id = ?");
  $VoteStmt->execute(array($RowUserid, $myUserid));
  $VoteRow = $VoteStmt->fetch();

  if (!$VoteRow) {
    if (isset($_POST['cute-optian'])) {
      $CuteO = '1';
    } else {
      $CuteO = '0';
    }
    if (isset($_POST['smart-optian'])) {
      $SmartO = '1';
    } else {
      $SmartO = '0';
    }
    if (isset($_POST['crazy-optian'])) {
      $CrazyO = '1';
    } else {
      $CrazyO = '0';
    }
    if (isset($_POST['kind-optian'])) {
      $KindO = '1';
    } else {
      $KindO = '0';
    }
    if (isset($_POST['hot-optian'])) {
      $HotO = '1';
    } else {
      $HotO = '0';
    }
    if (isset($_POST['weird-optian'])) {
      $WeirdO = '1';
    } else {
      $WeirdO = '0';
    }
    if (isset($_POST['love-optian'])) {
      $LoveO = '1';
    } else {
      $LoveO = '0';
    }
    if (isset($_POST['hate-optian'])) {
      $HateO = '1';
    } else {
      $HateO = '0';
    }
    if (isset($_POST['missed-optian'])) {
      $MissedO = '1';
    } else {
      $MissedO = '0';
    }
    if (isset($_POST['meet-optian'])) {
      $MeetO = '1';
    } else {
      $MeetO = '0';
    }
    if (isset($_POST['nervous-optian'])) {
      $NervousO = '1';
    } else {
      $NervousO = '0';
    }
    if (isset($_POST['boring-optian'])) {
      $BoringO = '1';
    } else {
      $BoringO = '0';
    }
    if (isset($_POST['brave-optian'])) {
      $BraveO = '1';
    } else {
      $BraveO = '0';
    }
    if (isset($_POST['talented-optian'])) {
      $TalentedO = '1';
    } else {
      $TalentedO = '0';
    }
    if (isset($_POST['dangerous-optian'])) {
      $DangerousO = '1';
    } else {
      $DangerousO = '0';
    }
    $VoteStmt = $db->prepare("INSERT INTO
              votes(to_id, from_id, smart, crazy, cute, kind, hot, weird, love, hate, missed, meet, dangerous, nervous, boring, brave, talented)
              VALUES (:zto_id, :zfrom_id, :zsmart, :zcrazy, :zcute, :zkind, :zhot, :zweird, :zlove, :zhate, :zmissed, :zmeet, :zdangerous,  :znervous, :zboring, :zbrave, :ztalented)");
    $VoteStmt->execute(array(':zto_id' => $RowUserid, ':zfrom_id' => $myUserid, ':zsmart' => $SmartO, ':zcrazy' => $CrazyO, ':zcute' => $CuteO, ':zkind' => $KindO, ':zhot' => $HotO, ':zweird' => $WeirdO, ':zlove' => $LoveO, ':zhate' => $HateO, ':zmissed' => $MissedO, ':zmeet' => $MeetO, ':zdangerous' => $DangerousO, ':znervous' => $NervousO, ':zboring' => $BoringO, ':zbrave' => $BraveO, ':ztalented' => $TalentedO));

    $NotfimessTypeV = '102';
    $NotifStmt = $db->prepare('INSERT INTO notifications(type, sender, receiver, notification_date) VALUES (:type, :userid, :toid, NOW())');
    $NotifStmt->execute(array(
      ':type'       => $NotfimessTypeV,
      ':userid'       => $myUserid,
      ':toid'       => $RowUserid
    ));
  } else {
    if (isset($_POST['smart-optian'])) {
      $SmartO = 1;
    } else {
      $SmartO = 0;
    }
    if (isset($_POST['crazy-optian'])) {
      $CrazyO = 1;
    } else {
      $CrazyO = 0;
    }
    if (isset($_POST['cute-optian'])) {
      $CuteO = 1;
    } else {
      $CuteO = 0;
    }
    if (isset($_POST['kind-optian'])) {
      $KindO = 1;
    } else {
      $KindO = 0;
    }
    if (isset($_POST['hot-optian'])) {
      $HotO = 1;
    } else {
      $HotO = 0;
    }
    if (isset($_POST['weird-optian'])) {
      $WeirdO = 1;
    } else {
      $WeirdO = 0;
    }
    if (isset($_POST['love-optian'])) {
      $LoveO = 1;
    } else {
      $LoveO = 0;
    }
    if (isset($_POST['hate-optian'])) {
      $HateO = 1;
    } else {
      $HateO = 0;
    }
    if (isset($_POST['missed-optian'])) {
      $MissedO = 1;
    } else {
      $MissedO = 0;
    }
    if (isset($_POST['meet-optian'])) {
      $MeetO = 1;
    } else {
      $MeetO = 0;
    }
    if (isset($_POST['nervous-optian'])) {
      $NervousO = 1;
    } else {
      $NervousO = 0;
    }
    if (isset($_POST['boring-optian'])) {
      $BoringO = 1;
    } else {
      $BoringO = 0;
    }
    if (isset($_POST['brave-optian'])) {
      $BraveO = 1;
    } else {
      $BraveO = 0;
    }
    if (isset($_POST['talented-optian'])) {
      $TalentedO = 1;
    } else {
      $TalentedO = 0;
    }
    if (isset($_POST['dangerous-optian'])) {
      $DangerousO = 1;
    } else {
      $DangerousO = 0;
    }
    $VoteStmt = $db->prepare('UPDATE votes SET smart = ?, crazy =  ?, cute = ?, kind = ?, hot = ?, weird = ?, love = ?, hate = ?, missed = ?, meet = ?, nervous = ?, boring = ?, brave = ?, talented = ?,  dangerous = ? WHERE to_id = ? AND from_id = ?');
    $VoteStmt->execute(array($SmartO, $CrazyO, $CuteO, $KindO, $HotO, $WeirdO, $LoveO, $HateO, $MissedO, $MeetO, $NervousO, $BoringO, $BraveO, $TalentedO, $DangerousO, $RowUserid, $myUserid));

    $NotfimessTypeV = '105';
    $NotifStmt = $db->prepare('INSERT INTO notifications(type, sender, receiver, notification_date) VALUES (:type, :userid, :toid, NOW())');
    $NotifStmt->execute(array(
      ':type'       => $NotfimessTypeV,
      ':userid'       => $myUserid,
      ':toid'       => $RowUserid
    ));
    echo "VALID";
  }
}
 