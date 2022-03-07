<?php
include 'connection.php';
include 'functions.php';

$bookrow = array();
$userid = $_SESSION['user_id'];
$bookid = '';


if (isset($_GET['id'])) {
    $bookid = test_input($_GET['id']);

    $booksql = "SELECT 
                    sb.bookName,
                    sb.rep,
                    vb.bookCategory,
                    vb.bookStatus
                FROM staticbookinfo AS sb
                JOIN variablebookinfo AS vb
                    ON sb.bookId = vb.bookId
                WHERE sb.bookId='$bookid'";
    $bookres = mysqli_query($conn, $booksql);
    $bookrow = mysqli_fetch_assoc($bookres);
}
$bookname = $bookrow['bookName'];
$bookcat = $bookrow['bookCategory'];

if ($bookcat == 'Premium') {
    $rep = $bookrow['rep'];
}else{
    $rep = 0;
}


    // cheack a last time if book is available
    if (isset($_POST['submit']) && $bookrow['bookStatus'] == 1) {
        // update book status from available to un available
        mysqli_query($conn, "UPDATE variablebookinfo SET bookStatus = 0 WHERE bookId='$bookid'");

        $address = base64_encode(mysqli_real_escape_string($conn, test_input($_POST['address'])));
        
        $sql = "SELECT 
                    sc.address,
                    vc.customerStatus,
                    vc.activeBookId
                FROM staticcustomerinfo AS sc
                JOIN variablecustomerinfo AS vc
                    ON sc.customerId = vc.customerId
                WHERE sc.customerId='$userid'";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($res);

        if ($address != $row['address']) {
            $updateuserinfo = "UPDATE staticcustomerinfo SET address='$address'
                                WHERE customerId='$userid'";
            mysqli_query($conn, $updateuserinfo);
        }

        if ($row['customerStatus'] == 0) {
            // update customer table
            $updatecustomerinfo = "UPDATE variablecustomerinfo SET customerStatus = 2 WHERE customerId='$userid'";
            mysqli_query($conn, $updatecustomerinfo);

            // add an order to order table
            $ordersql = "INSERT INTO orders (`customerId`, `bookId`, `orderDateTime`, `orderStatus`)
                        VALUES ('$userid', '$bookid', NOW(), 0)";
            
            mysqli_query($conn, $ordersql);

            $_SESSION['success_order'] = 'yes';

            redirect('../profile.php');
            
        }elseif ($row['customerStatus'] == 1 || $row['customerStatus'] == 3) {
            $activeBookId = $row['activeBookId'];


            // add an order to order table
            $ordersql = "INSERT INTO orders (`customerId`, `retBookId`, `bookId`, `orderDateTime`, `orderStatus`)
                        VALUES ('$userid', '$activeBookId', '$bookid', NOW(), 2)";
            mysqli_query($conn, $ordersql);

            // update customer table
            $updatecustomerinfo = "UPDATE variablecustomerinfo SET customerStatus = 2 WHERE customerId='$userid'";
            mysqli_query($conn, $updatecustomerinfo); 

            $_SESSION['success_order'] = 'yes';
            
            redirect('../profile.php');
        }
    }else{
        $_SESSION['fail_order'] = 'yes';
        redirect('../shelf.php?id='.$bookid);
    }
?>
