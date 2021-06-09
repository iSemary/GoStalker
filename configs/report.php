<?php
if (!isset($_SESSION)) {
  session_start();
}
include '../connect.php';
include '../init.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $myUserid = $_SESSION['id'];
  $Hisusername = filter_var($_POST['userexi'], FILTER_SANITIZE_STRING);

  $username = $db->prepare('SELECT userid,username FROM users WHERE username=:username');
  $username->execute(array(':username' => $Hisusername));
  $rowuser = $username->fetch();
  $RowUserid = $rowuser['userid'];

  $ReportReason = filter_var($_POST['re'], FILTER_SANITIZE_NUMBER_INT);
  $ReportStmt = $db->prepare("INSERT INTO reports(from_id, to_id, reason, report_date) VALUES(:zme, :zhim, :zvalue, NOW())");
  $ReportStmt->execute(array(':zme' => $myUserid, ':zhim' => $RowUserid, ':zvalue' => $ReportReason));
  echo "VALID";
}
 