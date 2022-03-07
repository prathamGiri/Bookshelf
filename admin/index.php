<?php
include 'backend/session_check.php';

$sql = "SELECT 
            o.orderId,
            o.bookId,
            o.retBookId,
            sc.customerId,
            sc.customerName,
            sc.address,
            o.orderDateTime,
            o.orderStatus
        FROM orders AS o
        JOIN staticcustomerinfo AS sc
            ON sc.customerId = o.customerId
        ORDER BY orderId DESC";
$res = mysqli_query($conn, $sql);


if (isset($_GET['id']) && isset($_GET['type'])) {
    $type = test_input($_GET['type']);
    $id = test_input($_GET['id']);

    $sql2 = "SELECT *
             FROM orders
             WHERE orderId='$id'";
    $res2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($res2);

    $customerId = $row2['customerId'];
    $retBookId = $row2['retBookId'];
    $bookId = $row2['bookId'];

    switch ($type) {
        case 'changeto0':
            mysqli_query($conn, "UPDATE orders SET orderStatus=0 WHERE orderId='$id'");
            mysqli_query($conn, "UPDATE variablecustomerinfo SET customerStatus = 2 WHERE customerId='$customerId'");
            redirect('index.php');
            break;
        case 'changeto1':
            mysqli_query($conn, "UPDATE orders SET orderStatus=1 WHERE orderId='$id'");
            mysqli_query($conn, "UPDATE variablecustomerinfo SET customerStatus = 3 WHERE customerId='$customerId'");
            mysqli_query($conn, "UPDATE variablebookinfo SET bookStatus=0 WHERE bookId='$retBookId'");
            redirect('index.php');
            break;
        case 'changeto2':
            mysqli_query($conn, "UPDATE orders SET orderStatus=2 WHERE orderId='$id'");
            mysqli_query($conn, "UPDATE variablecustomerinfo SET customerStatus = 2 WHERE customerId='$customerId'");
            mysqli_query($conn, "UPDATE variablebookinfo SET bookStatus=0 WHERE bookId='$retBookId'");
            redirect('index.php');
            break; 
        case 'changeto3':
            mysqli_query($conn, "UPDATE orders SET orderStatus=3 WHERE orderId='$id'");
            mysqli_query($conn, "UPDATE variablecustomerinfo SET customerStatus = 1, activeBookId = '$bookId' WHERE customerId='$customerId'");
            redirect('index.php');
            break;
        case 'changeto4':
            mysqli_query($conn, "UPDATE orders SET orderStatus=4 WHERE orderId='$id'");
            mysqli_query($conn, "UPDATE variablecustomerinfo SET customerStatus = 0, activeBookId = 0 WHERE customerId='$customerId'");
            mysqli_query($conn, "UPDATE variablebookinfo SET bookStatus=1 WHERE bookId='$retBookId'");
            redirect('index.php');
            break;
        case 'changeto5':
            mysqli_query($conn, "UPDATE orders SET orderStatus=5 WHERE orderId='$id'");
            mysqli_query($conn, "UPDATE variablecustomerinfo SET customerStatus = 1, activeBookId = '$bookId' WHERE customerId='$customerId'");
            mysqli_query($conn, "UPDATE variablebookinfo SET bookStatus=1 WHERE bookId='$retBookId'");
            redirect('index.php');
            break;   
    }    
}
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
    <div class="topnav" id="myTopnav" class="sticky">
        <a href="index.php" class="active">Orders</a>
        <a href="customers.php">Customers</a>
        <a href="books.php">Books</a>
        <a href="admin.php">Admin</a>
        <a href="backend/logout.php">Logout</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
          <i class="fa fa-bars"></i>
        </a>
    </div>
    <div>
        <table>
            <tr>
                <th>OrderId</th>
                <th>CustomerName</th>
                <th>BookName</th>
                <th>retBookName</th>
                <th>DateTime</th>
                <th>Address</th>
                <th>Status</th>
                <th>Options</th>
            </tr>
            <?php
            if (mysqli_num_rows($res) > 0) {
                 while ($row = mysqli_fetch_assoc($res)) {
                    $orderid = $row['orderId'];
                     $bookid = $row['bookId'];
                     $retbookid = $row['retBookId'];
                    $tableinfosql = "SELECT sb.bookName FROM staticbookinfo AS sb WHERE bookId='$bookid'";
                    $tableinfores = mysqli_query($conn, $tableinfosql);
                    $tableinforow = mysqli_fetch_assoc($tableinfores);
                    $tableinfosql1 = "SELECT sb2.bookName FROM staticbookinfo AS sb2 WHERE bookId='$retbookid'";
                    $tableinfores1 = mysqli_query($conn, $tableinfosql1);
                    $tableinforow1 = mysqli_fetch_assoc($tableinfores1);
                    
            ?>
            <tr>
                <td><?php echo $orderid; ?></td>
                <td><?php echo base64_decode($row['customerName']); ?></td>
                <td><?php echo $tableinforow['bookName']; ?></td>
                <td><?php echo $tableinforow1['bookName']; ?></td>
                <td><?php echo $row['orderDateTime']; ?></td>
                <td><?php echo base64_decode($row['address']); ?></td>

                

                <!-- Normal Pending -->
                <td><?php if($row['orderStatus'] == 0){
                    echo "<p style='background-color:orange;color:white;'>Pending Normal</p>";
                    ?>
                </td>
                <td>
                    <a href="?id=<?php echo $row['orderId']; ?>&type=changeto3">Change</a>
                </td>
                <!-- Return Pending -->
                <?php }elseif ($row['orderStatus'] == 1){
                    echo "<p style='background-color:blue;color:white;'>Pending Return</p>";
                ?>
                </td>
                <td>
                    <a href="?id=<?php echo $row['orderId']; ?>&type=changeto4">Change</a>
                </td>
                <!-- Exchange Pending -->
                <?php }elseif ($row['orderStatus'] == 2){
                    echo "<p style='background-color:yellow;color:black;'>Pending Exchange</p>";
                ?>
                </td>
                <td>
                    <a href="?id=<?php echo $row['orderId']; ?>&type=changeto5">Change</a>
                </td>
                <!-- Normal Done -->
                <?php }elseif ($row['orderStatus'] == 3){
                    echo "<p style='background-color:green;color:white;'>Done Normal</p>";
                ?>
                </td>
                <td>
                    <a href="?id=<?php echo $row['orderId']; ?>&type=changeto0">Change</a>
                </td>
                <!-- Return Done -->
                <?php }elseif ($row['orderStatus'] == 4){
                    echo "<p style='background-color:green;color:white;'>Done Return</p>";
                ?>
                </td>
                <td>
                    <a href="?id=<?php echo $row['orderId']; ?>&type=changeto1">Change</a>
                </td>
                <!-- Exchange Done -->
                <?php }elseif ($row['orderStatus'] == 5){
                    echo "<p style='background-color:green;color:white;'>Done Exchange</p>";
                ?>
                </td>
                <td>
                    <a href="?id=<?php echo $row['orderId']; ?>&type=changeto2">Change</a>
                </td>
                <!-- if order is canceled -->
                <?php }elseif ($row['orderStatus'] == 6){
                    echo "<p style='background-color:red;color:white;'>Canceled Order</p>";
                ?>
                </td>
                <?php } } } ?>
                
            </tr>
        </table>
    </div>
    <script src="admin-javascript/pop.js"></script>
</body>
</html>