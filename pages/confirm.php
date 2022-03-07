<?php 
include 'back/connection.php';
include 'back/functions.php';

$bookrow = array();
if (isset($_GET['id'])) {
    $id = test_input($_GET['id']);
    $booksql = "SELECT 
                    sb.bookId,
                    sb.bookName,
                    sb.rep,
                    vb.bookCategory
                FROM staticbookinfo AS sb
                JOIN variablebookinfo AS vb
                    ON sb.bookId = vb.bookId
                WHERE sb.bookId='$id'";
    $bookres = mysqli_query($conn, $booksql);
    $bookrow = mysqli_fetch_assoc($bookres);

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
    <link rel="stylesheet" href="../css/confirm_style.css">
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
    <div>
        <?php 
            if (isset($_SESSION['login_status']) && isset($_SESSION['user_id'])) {
                $userid=$_SESSION['user_id'];
                $sql = "SELECT 
                            sc.customerName,
                            sc.mobile,
                            sc.address,
                            vc.customerStatus
                        FROM staticcustomerinfo  AS sc
                        JOIN variablecustomerinfo AS vc
                            ON sc.customerId = vc.customerId
                        WHERE sc.customerId='$userid'";
                $res = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($res);
        ?>
        <div class="loggedin">
            <div class="wrapper">
                <p>Book Name:<?php echo $bookrow['bookName']; ?></p>
                <?php if ($bookrow['bookCategory'] == 'Premium') { ?>
                    <p>Rental Price: Rs. <?php echo $bookrow['rep']; ?></p>
                <?php }else{ ?>
                    <p>Rental Price: Rs. 0.0</p>
                <?php } ?>
                <br>
                <form action="back/update.php?id=<?php echo $bookrow['bookId']; ?>" method="post">

                    <p>Name: <?php echo base64_decode($row['customerName']); ?></p>

                    <p>Mobile: <?php echo base64_decode($row['mobile']); ?></p>

                    <label><b>Address:</b></label>
                    <input type="text" placeholder="Address" name="address" value='<?php echo base64_decode($row['address']); ?>' required>

                    <?php if ($row['customerStatus'] == 0) { ?>
                    <button type="submit" class="registerbtn" name="submit">Confirm Order Now</button>
                    
                    <?php }elseif($row['customerStatus'] == 1 || $row['customerStatus'] == 3){ ?>
                    <button type="submit" class="registerbtn" name="submit">Return Previous Book And Confirm Order Now</button>

                    <?php }elseif($row['customerStatus'] == 2){ ?>
                    <p id="return">Can't Order Now</p>
                    <?php } ?>
                </form>
            </div>
        </div>
        <?php }else{
        ?>
        <div class="notloggedin">
            <div class="notwrapper">
                <div class="container">
                    <div class="link">
                        <a href="login-form.php">Register / Login</a>
                    </div>
                    <h3>To Order A Book</h3>
                </div>
                
            </div>
        </div>
        <?php } ?>
    </div>
<?php include 'footer.php' ?>