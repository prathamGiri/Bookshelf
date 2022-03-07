<?php 
include 'back/connection.php';
include 'back/functions.php';

$row = array();
if (isset($_GET['id'])) {
    $id = test_input($_GET['id']);
    $sql = "SELECT 
                sb.bookId,
                sb.bookName,
                sb.bookAuthor,
                sb.img,
                sb.bookLanguage,
                sb.bookType,
                sb.numOfPages,
                sb.readDays,
                sb.rep,
                sb.discription,
                vb.bookCategory,
                vb.bookStatus
            FROM staticbookinfo AS sb
            JOIN variablebookinfo AS vb 
                ON sb.bookId = vb.bookId
            WHERE sb.bookId = '$id'
            ORDER BY bookId ASC";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookshelf</title>
    <link rel="stylesheet" href="../css/nav_style.css">
    <link rel="stylesheet" href="../css/shelf_style.css">
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
        <a href="about.php">About</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
          <i class="fa fa-bars"></i>
        </a>
    </div>
    <!-- main content -->   
    <?php if (isset($_SESSION['fail_order'])) { ?>
        <div class="msg"><p>Book Not Available!</p></div>
    <?php unset($_SESSION['fail_order']); } ?>
    
    <div class="main">
        <div class="wrapper">
            <div class="img">
                <img src=<?php echo "../images/books_img/".$row['img']; ?>>
            </div>
            <div class="info">
                <h2><?php echo $row['bookName']; ?></h2>
                <div class="info2">
                    <p>Author : <?php echo $row['bookAuthor']; ?></p>
                    <p>Language : <?php echo $row['bookLanguage']; ?></p>
                    <p>Number Of Pages : <?php echo $row['numOfPages']; ?></p>
                    <p>Book Length : <?php echo $row['readDays']; ?>days (4 hours a day)</p>
                </div>
                <div class="status">
                    <?php if($row['bookStatus']==1){ ?>
                        <h2 style="background-color:#04AA6D;"><?php echo "Available"; ?></h2>
                        <?php if ($row['bookCategory'] == 'Premium') { ?>
                            <a href="confirm.php?id=<?php echo $row['bookId']; ?>"><?php echo "Rent: RS.".$row['rep']; ?></a>
                        <?php }else{ ?>
                            <a href="confirm.php?id=<?php echo $row['bookId']; ?>"><?php echo "Rent: RS. 0.0" ?></a>
                        <?php } ?>
                    <?php }else{ ?>
                        <h2 style="background-color:#f4511e;"><?php echo "In Circulation"; ?></h2>
                    <?php }; ?>
                </div>
                <div class="catagories">
                    <?php
                        $cats = explode(",", $row['bookType']);
                        $catnum = count($cats);
                        for ($i=0; $i < $catnum; $i++) { 
                            ?>
                            <p><?php echo $cats[$i]; ?></p>
                    <?php    }
                    ?>
                </div>
            </div>
        </div>
        <div class="discription">
            <h3>Discription</h3>
            <p><?php echo $row['discription']; ?></p>
        </div>
    </div>
    <!-- ...........FOOTER SECTION STARTS HERE................. -->

    <footer>
        <div class="footer">
            <div class="address">
                <p>Bookshelf Online Libreary<br>Vandevi Nagar, <br>Karanja [lad], <br>Dist. Washim</p>
            </div>
            <div class="navbar-footer">
                <p>Menu</p>
                <div><a href="../index.php">Home</a></div>
                <div><a href="#">FAQ's</a></div>
                <div><a href="about.php">About</a></div>
                <div><a href="contact.php">Blog</a></div>
            </div>
        </div>
        <div class="copyright">
            <p>copyright &copy 2020 All Right Reserved.</p>
        </div>
    </footer>

        <!-- ......................FOOTER ENDS HERE.......................... -->

</body>
</html>
