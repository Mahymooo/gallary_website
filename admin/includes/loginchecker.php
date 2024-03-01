<?php
session_start();
  if(!isset($_SESSION['submit_login']) or $_SESSION['submit_login'] !=true){
    header('location:login.php');
    die();
  }
  ?>