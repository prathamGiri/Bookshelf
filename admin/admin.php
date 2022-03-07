<?php 
//include required files
include('backend/session_check.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookshelf Admin Dashboard</title>
    <link rel="stylesheet" href="css/admin_style.css">
    <link rel="shortcut icon" href="../img/book.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="logo">
        <h1>Bookshelf Admin Dashboard</h1>
    </div>
    <div class="topnav" id="myTopnav">
        <a href="index.php">Orders</a>
        <a href="customers.php">Customers</a>
        <a href="books.php">Books</a>
        <a href="admin.php" class="active">Admin</a>
        <a href="backend/logout.php">Logout</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
          <i class="fa fa-bars"></i>
        </a>
    </div>
    <form action="backend/admin_add.php" method="post" id="newAdmin">
        <div class="container">
            <hr>

            <label><b>AdminName</b></label>
            <input type="text" placeholder="Enter AdminName" name="adminName" required>

            <label><b>Password</b></label>
            <input type="text" placeholder="Enter Password" name="password" required>

            <label><b>Mobile</b></label>
            <input type="text" placeholder="Enter Mobile" name="mobile" required>

            <label><b>Email</b></label>
            <input type="text" placeholder="Enter Email" name="email" required>
            <br>

            <button type="submit" class="registerbtn" name="submit">submit</button>
        </div>
    </form>