<?php
//start a session
//session used to use a variable in multiple pages
session_start();
//include required files
include 'backend/data_connect.php';
include 'backend/functions.php';
$msg='';
//if user pressed submit, extract the value from the form
//isset used to see if variable is set to a value or not
if (isset($_POST['submit'])) {
    $user = base64_encode(mysqli_real_escape_string($conn, test_input($_POST['adminname'])));
    $pass = md5(mysqli_real_escape_string($conn, test_input($_POST['pass'])));

    $sql = "SELECT * FROM admin_info WHERE AdminName='$user' and AdmPass='$pass'";
    //run the sql query with mysqli_query function
    //and store the value in $res
    $res = mysqli_query($conn, $sql);
    //if entered values are available in database redirect to index.php
    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        //create a session variable to use in different pages
        $_SESSION['IS_LOGIN'] = 'yes';
        redirect('index.php');
    }else{
        //if wrong details entered
        $msg = "Please enter valid details";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/login_css.css">
    <link rel="shortcut icon" href="../img/book.png">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <title>Sign in</title>
</head>
      
<body>
    <div class="main">
        <p class="sign" align="center">Sign in</p>
        <form class="form1" method="post">
            <input class="un " type="text" align="center" placeholder="Username" name="adminname" required>
            <input class="pass" type="password" align="center" placeholder="Password" name="pass" required>
            <input type="submit" class="submit" name="submit">
            <p align="center"><?php echo $msg;?></p>
        </form>
        <p class="forgot" align="center"><a href="#">Forgot Password?</p>
    </div>
           
</body>
</html>