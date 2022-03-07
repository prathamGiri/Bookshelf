<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookshelf</title>
    <link rel="stylesheet" href="../css/nav_style.css">
    <link rel="stylesheet" href="../css/contact-style.css">
    <script src="../javascript/fun.js"></script>
    <link rel="shortcut icon" href="../img/book.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="logo">
        <h1>Bookshelf</h1>
    </div>
    <!-- navigation starts here -->
    <div class="topnav" id="myTopnav">
        <a href="../index.php">Home</a>
        <a href="contact.php" class="active">Contact</a>
        <a href="about.php">About</a>
        <a href="scoreboard.php">Scores</a>
        <?php
        if (isset($_SESSION['login_status'])) {
            if ($_SESSION['login_status'] == 'logged_in') {
        ?>
            <a href="profile.php">Profile</a>
        <?php
            } } else{
        ?> 
            <a href="login-form.php">Login/Register</a>
        <?php }  ?>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
          <i class="fa fa-bars"></i>
        </a>
    </div>

    <!-- main content -->

    <div class="main">
        <div class="wrapper">
            <div class="img">
                <img src="../img/icon-large.png">
            </div>
            <div class="info">
                <p>Pratham Santosh Giri</p>
                <p>7448074761</p>
                <p>pratham.giri02@gmail.com</p>
            </div>
        </div>
    </div>
<?php include 'footer.php' ?>
