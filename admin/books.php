<?php
//include required files
include('backend/session_check.php');
$sql = "SELECT 
            sb.bookId,
            sb.bookName,
            sb.bookAuthor,
            sb.img,
            sb.rep,
            vb.bookCategory,
            vb.bookStatus
        FROM staticbookinfo AS sb
        JOIN variablebookinfo AS vb 
        ON sb.bookId = vb.bookId
        ORDER BY bookId ASC";
$res = mysqli_query($conn, $sql);

if (isset($_GET['id']) && isset($_GET['type'])) {
    $type = test_input($_GET['type']);
    $id = test_input($_GET['id']);
    if ($type=='changetopremium') {
        mysqli_query($conn, "UPDATE variablebookinfo SET bookCategory = 'Premium' WHERE bookId='$id'");
        redirect('books.php');
    }elseif ($type=='changetofree') {
        mysqli_query($conn, "UPDATE variablebookinfo SET bookCategory = 'Free' WHERE bookId='$id'");
        redirect('books.php');
    }elseif ($type=='changetoavailable') {
        mysqli_query($conn, "UPDATE variablebookinfo SET bookStatus = 1 WHERE bookId='$id'");
        redirect('books.php');
    }elseif ($type=='changetounavailable') {
        mysqli_query($conn, "UPDATE variablebookinfo SET bookStatus = 0 WHERE bookId='$id'");
        redirect('books.php');
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
    <div class="topnav" id="myTopnav">
        <a href="index.php">Orders</a>
        <a href="customers.php">Customers</a>
        <a href="books.php" class="active">Books</a>
        <a href="backend/logout.php">Logout</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
          <i class="fa fa-bars"></i>
        </a>
    </div>
    <div class="s1">
        <input type="button" value="Add" id="addButton">
        <input type="button" value="List" id="listButton">
    </div>

    <form action="backend/books_add.php" method="post" id="newBook" enctype="multipart/form-data">
        <div class="container">
            <hr>

            <label><b>BookName</b></label>
            <input type="text" placeholder="Enter BookName" name="BookName" required>

            <label><b>Author</b></label>
            <input type="text" placeholder="Enter Author" name="Author" required>

            <label><b>Language</b></label>
            <input type="text" placeholder="Language" name="Language" required>

            <label><b>Catagory</b></label>
            <input type="text" placeholder="Enter Catagory" name="bookCatagory" required>

            <label><b>Number Of Pages</b></label>
            <input type="text" placeholder="Enter numPages" name="numOfPages" required>

            <label><b>MRP</b></label>
            <input type="text" placeholder="Enter MRP" name="MRP" required>
 
            <label><b>REP</b></label>
            <input type="text" placeholder="Enter REP" name="REP" required>

            <label><b>IMAGE</b></label>
            <input type="file" name="img" required>
            <br>
            <br>

            <label><b>ReadDays</b></label>
            <input type="text" placeholder="Enter ReadDays" name="ReadDays" required>

            <label><b>Discription</b></label>
            <input type="text" placeholder="Enter Discription" name="discription" required>

            <button type="submit" class="registerbtn" name="submit">submit</button>
        </div>
    </form>
        <div id="table">
            <table>
                <tr>
                    <th>BookId</th>
                    <th>BookName</th>
                    <th>Author</th>
                    <th>Image</th>
                    <th>REP</th>
                    <th>Status</th>
                    <th>Category</th>
                </tr>
                <?php
                    if (mysqli_num_rows($res) > 0) {
                        while ($row = mysqli_fetch_assoc($res)) {     
                    ?>
                    <tr>
                        <td><?php echo $row['bookId']; ?></td>
                        <td><?php echo $row['bookName']; ?></td>
                        <td><?php echo $row['bookAuthor']; ?></td>
                        <td><img style='width:90px;height:90px;' src="<?php echo '../images/books_img/'.$row['img'] ?>"></img></td>
                        <td><?php echo $row['rep']; ?></td>

                        <td><?php if($row['bookStatus'] == 0){
                            echo "<p style='background-color:red;color:white;'>Unavailable</p>";
                            ?>
                            <a href="?id=<?php echo $row['bookId']; ?>&type=changetoavailable">Change</a>
                            <?php }else{
                                echo "<p style='background-color:green;color:white;'>Available</p>";
                            ?>
                            <a href="?id=<?php echo $row['bookId']; ?>&type=changetounavailable">Change</a>
                            <?php }; ?>
                        </td>
                        
                        <td><?php if($row['bookCategory'] == 'Premium'){
                                echo "<p style='background-color:blue;color:white;'>Premium</p>";
                                ?>
                                <a href="?id=<?php echo $row['bookId']; ?>&type=changetofree">Change</a>
                            <?php }else{
                                echo "<p style='background-color:yellow;color:black;'>Free</p>";
                            ?>
                                <a href="?id=<?php echo $row['bookId']; ?>&type=changetopremium">Change</a>
                            <?php }; ?>
                        </td>
                    </tr>
                    <?php } } ?>
            </table>
        </div>
    <script src="admin-javascript/pop.js"></script>
</body>
</html>