<?php
include 'back/connection.php';
include 'back/functions.php';

loggedinonly('../index.php');

if (!isset($_SESSION['user_id'])) {
    redirect('../index.php');
}

$userid = $_SESSION['user_id'];

$sql = "SELECT
            sc.customerName,
            sc.mobile,
            sc.email,
            sc.address,
            vc.customerStatus,
            vc.activeBookId
        FROM variablecustomerinfo AS vc
        JOIN staticcustomerinfo AS sc
            ON sc.customerId = vc.customerId
        WHERE vc.customerId = '$userid'";

$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res);

if (isset($_GET['returnbookid'])) {
    if ($_GET['type'] == 'return') {
        $returnbookid = test_input($_GET['returnbookid']);
        // add an order to order table
        $ordersql = "INSERT INTO orders (`customerId`, `retBookId`, `orderDateTime`, `orderStatus`)
                    VALUES ('$userid',  '$returnbookid', NOW(), 1)";
        mysqli_query($conn, $ordersql);
        mysqli_query($conn, "UPDATE variablecustomerinfo SET customerStatus=3 WHERE customerId='$userid'");
        redirect('profile.php');
    }elseif ($_GET['type'] == 'cancelret') {
        $orderid = test_input($_GET['corderid']);
        $bookid = test_input($_GET['cbookid']);
        mysqli_query($conn, "UPDATE orders SET orderStatus=6 WHERE orderId = '$orderid'");
        mysqli_query($conn, "UPDATE variablebookinfo SET bookStatus=1 WHERE bookId = '$bookid'");
        mysqli_query($conn, "UPDATE variablecustomerinfo SET customerStatus=1 WHERE customerId='$userid'");
    }
    
}

if (isset($_GET['bookid']) && isset($_GET['orderid'])) {
    $orderid = test_input($_GET['orderid']);
    $bookid = test_input($_GET['bookid']);
    $cancelorderres = mysqli_query($conn, "SELECT * FROM orders WHERE orderId = '$orderid'");
    $cancelorderrow = mysqli_fetch_assoc($cancelorderres);

    if ($cancelorderrow['orderStatus'] == 0) {
        mysqli_query($conn, "UPDATE variablebookinfo SET bookStatus=1 WHERE bookId = '$bookid'");
        mysqli_query($conn, "UPDATE variablecustomerinfo SET customerStatus=0 WHERE customerId='$userid'");
        
    }elseif ($cancelorderrow['orderStatus'] == 1) {
        mysqli_query($conn, "UPDATE variablecustomerinfo SET customerStatus=1 WHERE customerId='$userid'");
        
    }elseif ($cancelorderrow['orderStatus'] == 2) {
        mysqli_query($conn, "UPDATE variablebookinfo SET bookStatus=1 WHERE bookId = '$bookid'");
        mysqli_query($conn, "UPDATE variablecustomerinfo SET customerStatus=1 WHERE customerId='$userid'");
        
    }

    mysqli_query($conn, "UPDATE orders SET orderStatus=6 WHERE orderId = '$orderid'");
    $_SESSION['canceled'] = 'yes';
    redirect('profile.php');
}

$ordersql = "SELECT
                o.orderId,
                sb.bookName,
                sb.rep AS price,
                o.orderDateTime,
                o.bookId,
                o.orderStatus
            FROM orders AS o
            JOIN staticbookinfo AS sb
                ON sb.bookId = o.bookId
            WHERE o.customerId='$userid' 
            ORDER BY o.orderId DESC";
$orderres = mysqli_query($conn, $ordersql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="../css/nav_style.css">
    <link rel="stylesheet" href="../css/profile-style.css">
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
        <a href="profile.php" class="active">Profile</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
          <i class="fa fa-bars"></i>
        </a>
    </div>
    <!-- navigation ends here -->
    <?php if (isset($_SESSION['success_order'])) { ?>
        <div class="msg"><p>Order Successful!</p></div>
    <?php unset($_SESSION['success_order']); }elseif (isset($_SESSION['canceled'])) { ?>
        <div class="msg"><p style="background-color: red;">Order Canceled!</p></div>
    <?php unset($_SESSION['canceled']); }elseif (isset($_SESSION['changed_details'])) { ?>
        <div class="msg"><p>Changed Details!</p></div>
    <?php unset($_SESSION['changed_details']);} ?>
    <!-- main content -->
    <div class="main">
        <div class="mainwrapper">
            <div class="infowrapper">
                <div class="logout">
                    <a href="back/logout.php">Logout</a>
                </div>
                <ul>
                    <li>Name:<?php echo base64_decode($row['customerName']); ?></li>
                    <li>Mobile:<?php echo base64_decode($row['mobile']); ?></li>
                    <li>Email:<?php echo base64_decode($row['email']); ?></li>
                    <li>Address:<?php echo base64_decode($row['address']); ?></li>
                    <li><a href="change_details.php">Change Details</a></li>
                </ul>
            </div>
            <div class="currentwrapper">
                <h2>Active Order</h2>
                <div class="currentcontainer">
                <?php
                if ($row['activeBookId'] == 0) { ?>
                    <h3>NO ACTIVE ORDER</h3>
                <?php }else{ 

                $activebookinfo = "SELECT
                                        vc.activeBookId,
                                        sb.bookName,
                                        sb.bookAuthor,
                                        sb.rep AS price,
                                        sb.img
                                    FROM variablecustomerinfo AS vc
                                    JOIN staticbookinfo AS sb
                                        ON sb.bookId = vc.activeBookId
                                    WHERE vc.customerId = '$userid'";
                $activebookres = mysqli_query($conn, $activebookinfo);
                $activebookrow = mysqli_fetch_assoc($activebookres);
                $bookcheck = $activebookrow['activeBookId'];
                ?>
                    <div class="currentimg">
                        <img src=<?php echo "../images/books_img/".$activebookrow['img']; ?>>
                    </div>
                    <div class="currentinfo">
                        <p>Name:<?php echo $activebookrow['bookName']; ?></p>
                        <p>Author:<?php echo $activebookrow['bookAuthor']; ?></p>
                        
                        <div class="return">
                        <?php 
                        $bookchecksql = "SELECT *
                                        FROM orders AS o
                                        WHERE (o.orderStatus = 1 OR o.orderStatus = 2) AND o.retBookId = '$bookcheck'";
                        $bookcheckres = mysqli_query($conn, $bookchecksql);
                        if (mysqli_num_rows($bookcheckres) > 0) { 
                            $bookcheckrow = mysqli_fetch_assoc($bookcheckres);
                            $checkorderid = $bookcheckrow['orderId'];?>
                            <a href="?returnbookid=<?php echo $activebookrow['activeBookId']; ?>&type=cancelret&corderid=<?php echo $checkorderid; ?>&cbookid=<?php echo $bookcheckrow['bookId']; ?>" style="background-color:red;color:white;">Cancel Return</a>
                
                        <?php }else{ ?>
                            <a href="?returnbookid=<?php echo $activebookrow['activeBookId']; ?>&type=return">Return</a>
                        <?php } ?>
                        </div>
                    </div>
                <?php } ?>
                </div>
            </div>
        </div>
        <div class="historywrapper">
                <div>
                    <h2>Your Orders</h2>
                </div>
                <div class="table">
                    <table>
                        <tr>
                            <th width="30px">Sr. No.</th>
                            <th>Book Name</th>
                            <th>Rs.</th>
                            <th>Date</th>
                            <th>Order Status</th>
                        </tr>
                        <?php
                            if (mysqli_num_rows($orderres) > 0) {
                                $i = 1;
                                while ($orderrow = mysqli_fetch_assoc($orderres)) { 
                                    if($i < 6){
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $orderrow['bookName']; ?></td>
                            <td><?php echo $orderrow['price']; ?></td>
                            <td><?php echo $orderrow['orderDateTime']; ?></td>
                            <?php if ($orderrow['orderStatus'] == 0) { ?>
                                <td><?php echo "Ordering"; ?><a href="?bookid=<?php echo $orderrow['bookId']; ?>&orderid=<?php echo $orderrow['orderId']; ?>">Cancel</a></td>
                            <?php }elseif($orderrow['orderStatus'] == 2){ ?>
                                <td><?php echo "Exchanging"; ?><a href="?bookid=<?php echo $orderrow['bookId']; ?>&orderid=<?php echo $orderrow['orderId']; ?>">Cancel</a></td>
                            <?php }elseif($orderrow['orderStatus'] == 3 || $orderrow['orderStatus'] == 5){ ?>
                                <td><?php echo "Done"; ?></td>
                            <?php }elseif($orderrow['orderStatus'] == 6){ ?>
                                <td><?php echo "Cancelled"; ?></td>
                            <?php } $i++?>
                        </tr>
                        <?php } } }else{ ?>
                            <td colspan="6">NO ORDERS YET</td>
                        <?php } ?>
                    </table>
                </div>
        </div>
        
        
    </div>
<?php include 'footer.php'; ?>
