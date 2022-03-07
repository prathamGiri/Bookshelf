<?php
include 'connection.php';
include 'functions.php';


if (isset($_POST['login'])) {
    $login_email = base64_encode(mysqli_real_escape_string($conn, test_input($_POST['login_email'])));
    $login_password = md5(mysqli_real_escape_string($conn, test_input($_POST['login_password'])));

    $sql = "SELECT * FROM staticcustomerinfo WHERE email='$login_email' and password='$login_password'";
    $res = mysqli_query($conn, $sql);

    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        $id = $row['customerId'];

        $expireTime = strtotime('+1 years');
        setcookie("user_info", $login_email, $expireTime, "/");
        setcookie("user_id", $id, $expireTime, "/");
        setcookie("password", $login_password, $expireTime, "/");
        $_SESSION['fresh_login'] = 'yes';
        
        
        
        redirect('../../index.php');
        
    }else{
        redirect('../login-form.php?type=wrongcredential');
    }
}else{
    redirect('../login-form.php');
}