<?php
include 'connection.php';
include 'functions.php';

loggedinonly('../index.php');

$userid = $_SESSION['user_id'];
if (isset($_POST['submit'])) {
    $name = base64_encode(mysqli_real_escape_string($conn, test_input($_POST['username'])));
    $mobile = base64_encode(mysqli_real_escape_string($conn, test_input($_POST['mobile'])));
    $address = base64_encode(mysqli_real_escape_string($conn, test_input($_POST['address'])));

    $updateuserinfo = "UPDATE staticcustomerinfo 
                    SET address='$address', customerName = '$name', mobile = '$mobile'
                    WHERE customerId='$userid'";
            mysqli_query($conn, $updateuserinfo);

    $_SESSION['changed_details'] = 'yes';
    redirect('../profile.php');

}
?>