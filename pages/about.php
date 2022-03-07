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
    <link rel="stylesheet" href="../css/about_style.css">
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
        <a href="contact.php">Contact</a>
        <a href="about.php" class="active">About</a>
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

    <!-- info goes here -->
    <div class="main">
        <div class="img">
            <img src="../img/book.png">
        </div>
        <div class="about">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus consequat dapibus nisi, et efficitur quam. Fusce et mi feugiat, vehicula sem vel, lobortis metus. Curabitur cursus augue in sapien accumsan, id rutrum velit feugiat. Suspendisse porttitor ante a sem dignissim pulvinar. Pellentesque diam ligula, laoreet eu nibh non, aliquam vehicula est. Suspendisse potenti. Nam nec nibh et enim sagittis rhoncus. Proin sed nibh luctus nibh aliquam scelerisque. Sed nec arcu ut nibh egestas finibus. Aenean congue, nisi at volutpat euismod, dolor libero vestibulum libero, eu blandit augue nunc cursus velit.
    
                Nunc molestie consectetur ante eget fermentum. Ut lobortis purus ipsum, vel facilisis lacus commodo sit amet. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Donec porta molestie lacus, sit amet auctor leo venenatis eget. Nam in lacus ultricies, maximus arcu a, viverra lorem. Sed nec ex nec sem viverra vestibulum. In tempor molestie tortor, in semper diam cursus eu. Phasellus sit amet accumsan ante, sit amet mattis augue. Nulla et auctor est, a molestie dolor. Nam sed vehicula ex. Ut bibendum lacus diam, et placerat nisl maximus non.
                
                Cras sit amet quam vitae arcu ullamcorper condimentum. Morbi vulputate ornare luctus. Morbi commodo eget mauris vel ornare. Duis dolor nulla, euismod at augue eget, consequat imperdiet libero. Sed dignissim rutrum nisi et elementum. Sed vel felis vel massa consequat imperdiet. Donec quis dapibus eros. Mauris mattis viverra eros in suscipit. Praesent nec scelerisque sem.
                
                Mauris ullamcorper felis justo, luctus vehicula sem faucibus sit amet. Suspendisse nunc mi, accumsan id lacinia et, molestie rhoncus erat. Etiam nec felis sed lorem tristique tincidunt. Praesent nec eros commodo, posuere odio vel, posuere eros. Morbi tincidunt quam leo, nec placerat tellus pretium ac. Sed nec semper lacus. Phasellus ultrices quis nisi sed maximus. Nunc fringilla enim sed sapien maximus, eget interdum metus commodo. Curabitur a sem felis. Nam odio nibh, iaculis at eros sit amet, pretium efficitur velit.
                
                Nam metus quam, rhoncus et ipsum ultrices, auctor accumsan velit. Sed pharetra erat tortor, ac consectetur massa tempus a. Nulla at nibh porta, rhoncus turpis in, pellentesque nisl. Proin blandit posuere malesuada. Proin ut lorem dignissim, dictum dolor vel, bibendum tellus. Nulla vel dignissim ante. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque posuere ullamcorper mollis. Curabitur tincidunt in turpis at bibendum. Duis mattis tempor nunc. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
        </div>
    </div>
    <!-- navigation ends here -->

<?php include 'footer.php' ?>
