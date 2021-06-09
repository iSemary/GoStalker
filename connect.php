<?php
    $dsn = 'mysql:host=localhost;dbname=gostalker';
    $user = 'root';
    $pass = '';
    $optians = array(
      PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
    );

    try {

        $db = new PDO($dsn, $user, $pass, $optians);

        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $e) {
            echo 'Failed To Connect' . $e->getMessage();
            header('location: maintenance.php');
    }
?>