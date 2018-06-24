<?
  error_reporting(E_ALL);
  ini_set("display_errors", 1);
?>

<?php
  session_start();
  ob_start();

  if(!isset ($_SESSION['id'])) {
    if (isset ($_COOKIE['id']) && isset ($_COOKIE['nickname'])) {
      $id = $row['id'];
      $_SESSION['id'] = $id;

    }
  }
 ?>
