<?php
if (!isset($_SESSION)) {
    session_start();
}
include '../connect.php';
include '../init.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userid = $_SESSION['id'];
    $Hisusername = filter_var($_POST['userexi'], FILTER_SANITIZE_STRING);

    $unBlock = $db->prepare("DELETE FROM block WHERE from_id = ? AND to_id = ?");
    $unBlock->execute(array($userid, $hisid));

    $HisBlockedName =  $db->prepare("SELECT fullname FROM users WHERE userid = ?");
    $HisBlockedName->execute(array($hisid));
    $HisName = $HisBlockedName->fetch();
    echo '<b>"' . $HisName['fullname'] . '"</b>' . ' Removed from block list, You can visit this user profile Now.';
}

