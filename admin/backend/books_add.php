<?php
include 'data_connect.php';
include 'functions.php';

if (isset($_POST['submit'])) {
    $BookName = test_input($_POST['BookName']);
    $Author = test_input($_POST['Author']);
    $Language = test_input($_POST['Language']);
    $bookType = test_input($_POST['bookCatagory']);
    $numOfPages = test_input($_POST['numOfPages']);
    $MRP = test_input($_POST['MRP']);
    $REP = test_input($_POST['REP']);  
    $img = test_input($_FILES['img']['name']);
    $ReadDays = test_input($_POST['ReadDays']);
    $discription = test_input($_POST['discription']);

    mysqli_query($conn, "INSERT INTO `staticbookinfo` (`bookName`, `bookAuthor`, `bookLanguage`, `bookType`, `numOfPages`, `mrp`, `rep`, `img`, `readDays`, `discription`) 
                            VALUES ('$BookName', '$Author', '$Language', '$bookType', '$numOfPages', $MRP, $REP, '$img',  $ReadDays, '$discription')");

    mysqli_query($conn, "INSERT INTO `variablebookinfo`(`bookCategory`, `bookStatus`) VALUES ('Premium', 1)");

    move_uploaded_file($_FILES['img']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/bookshelf/images/books_img/'.$img);
    
    redirect('../books.php');
}
?>