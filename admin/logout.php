<?php
session_start();
unset($_SESSION['submit_login']);
header('location:login.php');

?>