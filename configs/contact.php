<?php
if(!isset($_SESSION)) {session_start();}
include '../connect.php';
include '../init.php';
require 'classes/mail.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $Contactname = filter_var($_POST['contact-name'], FILTER_SANITIZE_STRING);
  $Contactemail = filter_var($_POST['contact-email'], FILTER_SANITIZE_EMAIL);
  $Contactcell = filter_var($_POST['contact-cell'], FILTER_SANITIZE_NUMBER_INT);
  $Contactsubject = filter_var($_POST['contact-subject'], FILTER_SANITIZE_STRING);
  $Contactmessage = filter_var($_POST['contact-message'], FILTER_SANITIZE_STRING);
  $formErrors = array();
  if (strlen($Contactname) < 3) {
      $formErrors[] = "Full name can't be less than 3 characters.";
  }
  if (strlen($Contactname) >= 20) {
    $formErrors[] = "Full name can't be more than 20 characters.";
  }
  if (strlen($Contactmessage) <= 10) {
    $formErrors[] = "Message can't be less than 10 characters.";
  }
  if (strlen($Contactmessage) >= 500) {
    $formErrors[] = "Message can't be more than 500 characters.";
  }
  if (strlen($Contactsubject) <= 2) {
    $formErrors[] = "Subject can't be less than 2 characters.";
  }
  if (strlen($Contactsubject) >= 10) {
    $formErrors[] = "Subject can't be more than 10 characters.";
  }
  $goMail = 'GoStalkerInc@gmail.com';
  $headers = 'From:' . $Contactemail . '\r\n';
  foreach($formErrors as $error) {
    echo $error;
  }
  if (empty($formErrors)) {

    Mail::setFrom($Contactsubject,'Name: '. $Contactname .'<br> Email: '. $Contactemail .'<br> Phone: ' . $Contactcell .'<br> Message: '. $Contactmessage, $goMail);

  $Contactname  = '';
  $Contactemail = '';
  $Contactcell = '';
  $Contactsubject = '';
  $Contactmessage = '';
  }
  echo "VALID";
}

    ?>
