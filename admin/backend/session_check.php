<?php
//start a session
//session used to use a variable in multiple pages
session_start();
//include required files
include 'data_connect.php';
include 'functions.php';

if (!isset($_SESSION['IS_LOGIN'])) {
    redirect('login.php');
}
?>