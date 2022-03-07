<?php
include 'back/connection.php';
include 'back/functions.php';

loggedinonly('../index.php');

$userid = $_SESSION['user_id'];

$sql = "SELECT * FROM staticcustomerinfo WHERE customerId='$userid'";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookshelf Login</title>
    <link rel="stylesheet" href="../css/change_details.css">
    
    
    <link rel="shortcut icon" href="../img/book.png">
</head>
<body>
    <div class="logo">
        <h1>Bookshelf</h1>
    </div>
    <div class="form">
        <form action="back/change_det.php" method="post">
            <label><b>Name:</b></label>
            <input type="text" placeholder="Enter Name" name="username" value='<?php echo base64_decode($row['customerName']); ?>' required>

            <label><b>Mobile:</b></label>
            <input type="text" placeholder="Enter Mobile" name="mobile" value='<?php echo base64_decode($row['mobile']); ?>' maxlength="10" required>

            <label><b>Address:</b></label>
            <input type="text" placeholder="Address" name="address" value='<?php echo base64_decode($row['address']); ?>' required>

            <button type="submit" class="registerbtn" name="submit">Change Details</button>
        </form>
    </div>
</body>
</html>