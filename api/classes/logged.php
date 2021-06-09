<?php
include 'connect.php';
if(!isset($_SESSION)){session_start();}
if (isset($_COOKIE['GS'])) {
    $CookieToken = $_COOKIE['GS'];
    $HashedCookieToken = sha1($CookieToken);
    $stmtTokenCheck = $db->prepare("SELECT * FROM login_token WHERE token = ?");
    $stmtTokenCheck->execute(array($HashedCookieToken));
    $stmtTokenCheckF = $stmtTokenCheck->fetch();
    $stmtTokenCheckC = $stmtTokenCheck->rowCount();
    if ($stmtTokenCheckC > 0) {
        $UserTokenid = $stmtTokenCheckF['user_id'];
        //Set the session
        $stmt = $db->prepare("SELECT userid, username FROM users WHERE userid = ?");
        $stmt->execute(array($UserTokenid));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();
        // Set the sessions
        $_SESSION['username'] = $row['username']; // Register session name
        $_SESSION['id'] = $row['userid']; // Register session id
    } else {
        session_unset();
        session_destroy();
        header('location: login');
    }
} else {
    header('location: login');
    // to the signup
}
?>