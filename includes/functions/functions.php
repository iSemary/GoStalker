<?php
/*
** Check Items Functin V1.0
** $select = the item to select Ex: name / username / email
** $from = the table to select from Ex: users / bios / ...
** $value = the value of select Ex: Abdelrahman / Etc / ...
*/
    function checkItem($select, $from, $value) {

      global $db;

      $stmtCheck = $db->prepare("SELECT $select FROM $from WHERE $select = ?");

      $stmtCheck->execute(array($value));

      $count = $stmtCheck->rowCount();

      return $count;
    }
?>
