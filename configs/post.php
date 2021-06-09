<?php
if (!isset($_SESSION)) {
  session_start();
}
include '../connect.php';
include '../init.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $userid = $_SESSION['id'];
  $PostBody = filter_var($_POST['postbody'], FILTER_SANITIZE_STRING);
  $Postimg = $_FILES['postimg'];
  $PostimgName = $_FILES['postimg']['name'];
  $PostimgSize = $_FILES['postimg']['size'];
  $PostimgTmp = $_FILES['postimg']['tmp_name'];
  $PostimgType = $_FILES['postimg']['type'];
  $PostimgAllowedExtension = array("jpeg", "jpg", "png");
  $expPostimgName = explode('.', $PostimgName);
  $PostimgExtension = strtolower(end($expPostimgName));

  $formErrors = array();
  if (!empty($PostimgName) && !in_array($PostimgExtension, $PostimgAllowedExtension)) {
    $formErrors[] = '<h5>Sorry this file not an <strong>image !</strong></h5>';
  } elseif ($PostimgSize > 2621440) {
    $formErrors[] = '<h5>Sorry this file more than <strong>2.5 Mb.</strong></h5>';
  } elseif (strlen($PostBody) > 255 || strlen($PostBody) < 1) {
    $formErrors[] = '<h5>Posts must be more than 1 letters and less than 255 letters.</h5>';
  }
  if (empty($formErrors)) {
    if (empty($PostimgType)) {
      $Postimg = '';
    } else {
      $Postimg =  'GS' . '_' . rand(0, 1000000000) . $PostimgName;
      move_uploaded_file($PostimgTmp, "..\gsuploads\gspostsimg\\" . $Postimg);
    }
    $PostStmt = $db->prepare('INSERT INTO posts(body, post_date, user_id, stars, post_img) VALUES (:postbody, NOW(), :userid, 0, :postimg)');
    $PostStmt->execute(array(
      ':postbody'     => $PostBody,
      ':userid'       => $userid,
      ':postimg'      => $Postimg
    ));
    $_POST['postbody'] = '';
    $_FILES['postimg'] = '';
    echo "VALID";
  } else {
    foreach ($formErrors as $error) {
      echo  $error;
    }
  }
}

