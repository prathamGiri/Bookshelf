<?php
//include required files
include('backend/session_check.php');

$sql = "SELECT * FROM staticcustomerinfo ORDER BY customerId ASC";
$res = mysqli_query($conn, $sql);
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
        <a href="customers.php" class="active">Customers</a>
        <a href="books.php">Books</a>
        <a href="backend/logout.php">Logout</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
          <i class="fa fa-bars"></i>
        </a>
    </div>
    <div>
        <table>
            <tr>
                <th>CustomerId</th>
                <th>Name</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Address</th>
            </tr>
            <?php
            if (mysqli_num_rows($res) > 0) {
                 while ($row = mysqli_fetch_assoc($res)) {     
            ?>
            <tr>
                <td><?php echo $row['customerId']; ?></td>
                <td><?php echo base64_decode($row['customerName']); ?></td>
                <td><?php echo base64_decode($row['mobile']); ?></td>
                <td><?php echo base64_decode($row['email']); ?></td>
                <td><?php echo base64_decode($row['address']); ?></td>
            </tr>
            <?php } } ?>
        </table>
    </div>
    <script src="admin-javascript/pop.js"></script>
</body>
</html>