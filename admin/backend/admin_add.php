<?php 
//include required files
include('backend/session_check.php');

if (isset($_POST['submit'])) {
    $adminName = base64_encode(mysqli_real_escape_string($conn, test_input($_POST['adminName'])));
    $password = md5(mysqli_real_escape_string($conn, test_input($_POST['password'])));
    $mobile = mysqli_real_escape_string($conn, test_input($_POST['mobile']));
    $email = base64_encode(mysqli_real_escape_string($conn, test_input($_POST['email'])));

    $sql = "INSERT INTO `admin_info` (`AdminName`, `AdmPass`, `Mobile`, `Email`)
            VALUES ('$adminName', '$password', '$mobile', '$email')";
    mysqli_query($conn, $sql);
    redirect('../index.php');
}

?>