<?php
if (!isset($_SESSION)) {
  session_start();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  include '../connect.php';
  include '../init.php';
  include('classes/Mail.php');

  // Get variables from the form
  $username     = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
  $email        = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
  $name         = filter_var($_POST['fullname'], FILTER_SANITIZE_STRING);
  $pass         = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
  $hashedPass   = sha1($pass);
  $gender       = filter_var($_POST['gender'], FILTER_SANITIZE_STRING);
  // Define the birthdate
  $dobArr = array(filter_var($_POST['year'], FILTER_SANITIZE_NUMBER_INT), filter_var($_POST['month'], FILTER_SANITIZE_NUMBER_INT), filter_var($_POST['day'], FILTER_SANITIZE_NUMBER_INT));
  $dateOfBirth = implode('-', $dobArr);

  $Language    = filter_var($_POST['language'], FILTER_SANITIZE_STRING);

  $forbiddenNames  = array("settings", "setting", "gostalker", "chat", "messages", "init", "login", "signup", "forget-password", "logout", "myprofile", "search", "stalkers", "userprofile", "dashboard", "connect", "confirm-email", "conditions", "blocked-users", "anonymousmessages", "404", "change-email", "change-password", "home", "sendmessages", "notification", "votes");

  // validate the form
  $formErrors = array();
  if (strlen($name) < 2) {
    $formErrors[] = '<h5>Full Name cant be less than 2 letters.</h5><br>';
  }
  if (strlen($name) > 30) {
    $formErrors[] = '<h5>Full Name cant be more than 30 letters.</h5><br>';
  }
  if (strlen($username) < 3) {
    $formErrors[] = '<h5>Username cant be less than 3 letters.</h5><br>';
  }
  if (strlen($username) > 40) {
    $formErrors[] = '<h5>Username cant be more than 40 letters.</h5><br>';
  }
  if (strlen($pass) < 8) {
    $formErrors[] = '<h5>Password cant be less than  8 letters.</h5><br>';
  }
  if (empty($name)) {
    $formErrors[] = '<h5>Full Name cant be empty.</h5><br>';
  }
  if (empty($username)) {
    $formErrors[] = '<h5>Username cant be empty.</h5><br>';
  }
  if (in_array(strtolower($username), $forbiddenNames)) {
    $formErrors[] = '<h5>Please Write valid character in Username.</h5><br>';
  }
  if (preg_match("/[^\w-.]/", $username)) {
    $formErrors[] = '<h5>Please Write valid character in Username.</h5><br>';
  }
  if (empty($email)) {
    $formErrors[] = '<h5>Email cant be empty.</h5><br>';
  }
  if (!filter_var($email, FILTER_VALidATE_EMAIL)) {
    $formErrors[] = '<h5>Invalid email format !<br>ex: user@example.com</h5><br>';
  }
  if (empty($gender)) {
    $formErrors[] = '<h5>Gender cant be empty.</h5><br>';
  }
  if (empty($Language)) {
    $formErrors[] = '<h5>Language cant be empty.</h5><br>';
  }
  if (empty($dobArr)) {
    $formErrors[] = '<h5>Birthdate cant be empty.</h5><br>';
  }
  if (empty($pass)) {
    $formErrors[] = '<h5>Password cant be empty.</h5><br>';
  }
  if (strlen($pass) < 8) {
    $formErrors[] = "<h5>Password can't be less than  8 letters.</h5><br>";
  }
  $check1 = checkItem("username", "users", $username);
  if ($check1 == 1) {
    $formErrors[] =  "<h5>This Username is Exist.</h5><br>";
  }
  $check2 = checkItem("email", "users", $email);
  if ($check2 == 1) {
    $formErrors[] =  "<h5>This Email is Exist.</h5><br>";
  }
  foreach ($formErrors as $error) {
    echo  $error;
  }

  // check if there's no error process the update
  if (empty($formErrors)) {
    // Insert the database with this info
    $stmt = $db->prepare("INSERT INTO
                users(fullname, username, email, password, gender, birthdate, language)
                VALUES(:zname, :zuser, :zemail, :zpass, :zgender, :zbirthdate, :zlanguage) ");
    $stmt->execute(array(
      'zname'      => $name,
      'zuser'      => $username,
      'zemail'      => $email,
      'zpass'      => $hashedPass,
      'zgender'    => $gender,
      'zbirthdate' => $dateOfBirth,
      'zlanguage' => $Language
    ));
    /*
               Token CONFIRMATION CODE
               */
    $cstrong = true;
    $ConfirmCode = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));

    $stmtToken = $db->prepare('INSERT INTO confirm_email(email, code) VALUES (:zemail, :zcode)');
    $stmtToken->execute(array(
      ':zemail'   =>  $email,
      ':zcode'   =>  sha1($ConfirmCode)
    ));
    /*
               Send Mail with token link
               */
    Mail::setFrom('Welcome to GoStalker!', 'You are successfully registered, Confirm Your Email :<br>Click the link below to verify your account.<br>http://localhost/GoStalker/confirm-email.php?confirmcode=' . $ConfirmCode . '<br>Thank you for joining and making GoStalker part of your life. If you have any problem, help or idea just contact us: Mail: GoStalkerInc@gmail.com', $email);
    /*
                 ((Login after signup))
               */
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashedPass = sha1($password);
    // Check if the user exist in database
    $stmt = $db->prepare("SELECT userid, username, email, password FROM users WHERE username = ? AND password = ?");
    $stmt->execute(array($username, $hashedPass));
    $row = $stmt->fetch();
    $count = $stmt->rowCount();
    // if count > 0 this mean the database contain record about this username
    if ($count > 0) {
      $_SESSION['username'] = $username; // Register session name
      $_SESSION['id'] = $row['userid']; // Register session id

      // Login token uses for forget password - change email - etc
      $cstrong = true;
      $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
      $stmtToken = $db->prepare("INSERT INTO login_token(token, user_id) VALUES (:ztoken, :zuser_id)");
      $stmtToken->execute(array(
        ':ztoken'   =>  sha1($token),
        ':zuser_id' =>  $_SESSION['id']
      ));

      setcookie("GS", $token, time() + 60 * 60 * 24 * 7, '/', null, null, true);
      setcookie("GS_", '1', time() + 60 * 60 * 24 * 7, '/', null, null, true);

      exit();
    } else {
      echo 'Incorrect Username or Password.';
    }
  }
} else { }

