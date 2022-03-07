<?php

include 'pages/back/connection.php';
include 'pages/back/functions.php';


if(isset($_COOKIE["user_info"]) && isset($_COOKIE["password"]) && isset($_COOKIE["user_id"])) {
    $_SESSION['login_status'] = "logged_in";
    $_SESSION['user_id'] = $_COOKIE["user_id"];
}

$sql = "SELECT 
            sb.bookId,
            sb.bookName,
            sb.bookAuthor,
            sb.bookType,
            sb.img,
            sb.rep,
            vb.bookCategory,
            vb.bookStatus
        FROM staticbookinfo AS sb
        JOIN variablebookinfo AS vb 
        ON sb.bookId = vb.bookId
        ORDER BY bookId ASC";
$res = mysqli_query($conn, $sql);
$res2 = mysqli_query($conn, $sql);
$res3 = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookshelf</title>
    <link rel="stylesheet" href="css/nav_style.css">
    <link rel="stylesheet" href="css/index_style.css">
    <link rel="stylesheet" href="css/lightslider.css">
    <script src="javascript/JQuery3.3.1.js"></script>
    <script src="javascript/lightslider.js"></script>
    <script src="javascript/slider.js"></script>
    <script src="javascript/fun.js"></script>
    <link rel="shortcut icon" href="img/book.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="logo">
        <h1>Bookshelf</h1>
    </div>
    <!-- navigation starts here -->
    <div class="topnav" id="myTopnav">
        <a href="index.php" class="active">Home</a>
        <a href="pages/contact.php">Contact</a>
        <a href="pages/about.php">About</a>
        <a href="pages/scoreboard.php">Scores</a>
        <?php
        if (isset($_SESSION['login_status'])) {
        ?>
            <a href="pages/profile.php">Profile</a>
        <?php
            } else{
        ?> 
            <a href="pages/login-form.php">Login/Register</a>
        <?php } ?>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
          <i class="fa fa-bars"></i>
        </a>
    </div>
    <!-- navigation ends here -->
    <?php if (isset($_SESSION['fresh_register'])) { ?>
    <div class="msg"><p>Registered Successfully!</p></div>
    <?php unset($_SESSION['fresh_register']); }elseif (isset($_SESSION['fresh_login'])) { ?>
    <div class="msg"><p>Logged In Successfully!</p></div>
    <?php unset($_SESSION['fresh_login']);  } ?>

    <div class="wrap">
        <div class="search">
            <input type="text" class="searchTerm" placeholder="Search books by name, writer, type...">
            <button type="submit" class="searchButton">
                <i class="fa fa-search"></i>
            </button>
        </div>
    </div>

    <section>
        
        <div>
            
            <div class="catagories">
                <a href="?cat=Adventure"><p>Adventure</p></a>
                <a href="?cat=Classic"><p>Classic</p></a>
                <a href="?cat=Mystery"><p>Mystery</p></a>
                <a href="?cat=Fantasy"><p>Fantasy</p></a>
                <a href="?cat=History"><p>History</p></a>
                <a href="?cat=Fiction"><p>Fiction</p></a>
                <a href="?cat=NonFiction"><p>NonFiction</p></a>
                <a href="?cat=Biography"><p>Biography</p></a>
                <a href="?cat=Autobiography"><p>Autobiography</p></a>
                <a href="?cat=Sci-Fiction"><p>Sci-Fiction</p></a>
                <a href="?cat=Horror"><p>Horror</p></a>
                <a href="?cat=Poetry"><p>Poetry</p></a>
                <a href="?cat=Self Help"><p>Self Help</p></a>
                <a href="?cat=Crime"><p>Crime</p></a>
                <a href="?cat=Show_All"><p style="background-color:red;">Show All</p></a>
            </div>
        </div>
        <div class="result">
            <?php 
                if (isset($_GET['cat'])) {
                    
                    if ($_GET['cat'] == 'Show_All') {
                        if (mysqli_num_rows($res3) > 0) {
                            while ($row3 = mysqli_fetch_assoc($res3)) {  
            ?>
                <a href="pages/shelf.php?id=<?php echo $row3['bookId']; ?>&type=showdetails">
                    <div class="individual">
                        <div class="individualimg">
                            <img src=<?php echo "images/books_img/".$row3['img']; ?>>
                        </div>
                        <div class="status">
                            <?php if ($row3['bookStatus']==1) {
                                echo "<p style='background-color:#3feb4b;'>Available</p>";
                            }else{
                                echo "<p style='background-color:red;'>Unavailable</p>";
                            } ?>
                        </div>
                        <div class="info">
                            <p><?php echo $row3['bookName']; ?></p>
                            <p>RS. 00</p>
                        </div>
                    </div>
                </a>
                <?php } } } else {
                    $cat = $_GET['cat'];
                    if (mysqli_num_rows($res3) > 0) {
                        $j = 0;
                        while ($row3 = mysqli_fetch_assoc($res3)) {
                            $cats = explode(",", $row3['bookType']);
                            $catnum = count($cats);
                            $i = 0;
                            for ($i; $i < $catnum; $i++) {
                                if ($cats[$i] == $cat) {
                ?>
                <a href="pages/shelf.php?id=<?php echo $row3['bookId']; ?>&type=showdetails">
                    <div class="individual">
                        <div class="individualimg">
                            <img src=<?php echo "images/books_img/".$row3['img']; ?>>
                        </div>
                        <div class="status">
                            <?php if ($row3['bookStatus']==1) {
                                echo "<p style='background-color:#3feb4b;'>Available</p>";
                            }else{
                                echo "<p style='background-color:red;'>Unavailable</p>";
                            } ?>
                        </div>
                        <div class="info">
                            <p><?php echo $row3['bookName']; ?></p>
                            <p>RS. 00</p>
                        </div>
                    </div>
                </a>
               <?php $j++; } else {
                   continue;
               } } } if ($j == 0) {
                   ?>
                   <h2>No Books Available Of That Category</h2>
                   <?php
               } } } } ?>
        </div>
    </section>


    <!-- main body starts here -->
    <section class="main">
            <!--showcase----------------------->
            <!--heading------------->
            <h1 class="showcase-heading">Free</h1>
            <br>
            
            <ul id="autoWidth" class="cs-hidden">
            <?php
                        if (mysqli_num_rows($res) > 0) {
                            while ($row = mysqli_fetch_assoc($res)) {  
                                if ($row['bookCategory'] == 'Free') {
                    ?>
                <!--box-1--------------------------->
                <li class="item-a">
                <!--showcase-box------------------->
                    <a href="pages/shelf.php?id=<?php echo $row['bookId']; ?>&type=showdetails">
                        <div class="showcase-box">
                            <img src=<?php echo "images/books_img/".$row['img']; ?>>
                            <div class="status">
                            <?php if ($row['bookStatus']==1) {
                                    echo "<p style='background-color:#3feb4b;'>Available</p>";
                                }else{
                                    echo "<p style='background-color:red;'>Unavailable</p>";
                                } ?>
                            </div>
                            <div class="info">
                                <p><?php echo $row['bookName']; ?></p>
                                <p>RS. 00</p>
                            </div>
                        </div>
                    </a>
                </li>
                <?php }else{
                    continue;
                } } } ?>
            </ul>
            <hr>
    </section>

    <!-- premium books -->
    <section class="main">
            <!--showcase----------------------->
            <!--heading------------->
            <h1 class="showcase-heading">All Available Books</h1>
            
            <br>
            
            <ul id="autoWidth2" class="cs-hidden">
            <?php
                        if (mysqli_num_rows($res2) > 0) {
                            while ($row = mysqli_fetch_assoc($res2)) {  
                                if ($row['bookCategory'] == 'Premium') {
                    ?>
                <!--box-1--------------------------->
                <li class="item-a">
                <!--showcase-box------------------->
                    <a href="pages/shelf.php?id=<?php echo $row['bookId']; ?>">
                        <div class="showcase-box">
                            <img src=<?php echo "images/books_img/".$row['img']; ?>>
                            <div class="status">
                            <?php if ($row['bookStatus']==1) {
                                    echo "<p style='background-color:#3feb4b;'>Available</p>";
                                }else{
                                    echo "<p style='background-color:red;'>Unavailable</p>";
                                } ?>
                            </div>
                            
                            <div class="info">
                                <p><?php echo $row['bookName']; ?></p>
                                <p><?php echo 'RS. '.$row['rep']; ?></p>
                            </div>
                        </div>
                    </a>
                </li>
                <?php }else{
                    continue;
                } } } ?>
            </ul>
            <div class="more"><a href="?cat=Show_All">Show More</a></div>
    </section>
                <!-- ...........FOOTER SECTION STARTS HERE................. -->

    <footer>
        <div class="footer">
            <div class="address">
                <p>Bookshelf Online Libreary<br>Vandevi Nagar, <br>Karanja [lad], <br>Dist. Washim</p>
            </div>
            <div class="navbar-footer">
                <p>Menu</p>
                <div><a href="index.php">Home</a></div>
                <div><a href="#">FAQ's</a></div>
                <div><a href="pages/about.php">About</a></div>
                <div><a href="pages/contact.php">Contact</a></div>
            </div>
        </div>
        <div class="copyright">
            <p>copyright &copy 2020 All Right Reserved.</p>
        </div>
    </footer>

            <!-- ......................FOOTER ENDS HERE.......................... -->
</body>
</html>