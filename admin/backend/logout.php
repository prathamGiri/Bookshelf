<?php
session_start();
include 'functions.php';
//unset a started session variable after use
unset($_SESSION['IS_LOGIN']);
redirect('../login.php');
?>