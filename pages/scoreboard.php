<?php

include 'back/connection.php';
include 'back/functions.php';

$sql = "SELECT so.customerId,
                so.wordsNum,
                so.booksNum,
                sc.customerName
        FROM scores AS so
        JOIN staticcustomerinfo AS sc
            ON sc.customerId = so.customerId
        ORDER BY so.wordsNum desc";

$res = mysqli_query($conn, $sql);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scoreboard</title>
    <link rel="stylesheet" href="../css/nav_style.css">
    <link rel="stylesheet" href="../css/scoreboard-style.css">
    <script src="../javascript/fun.js"></script>
    <link rel="shortcut icon" href="../img/book.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="logo">
        <h1>Bookshelf</h1>
    </div>
    <!-- navigation starts here -->
    <div class="topnav" id="myTopnav">
        <a href="../index.php">Home</a>
        <a href="contact.php">Contact</a>
        <a href="about.php">About</a>
        <a href="scoreboard.php" class="active">Scores</a>
        <a href="profile.php">Profile</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
          <i class="fa fa-bars"></i>
        </a>
    </div>

    <div class="main">
        <div class="wrapper">
                <table>
                    <tr>
                        <th>Rank</th>
                        <th>Name</th>
                        <th>Number of Words Read</th>
                        <th>Number of Books Read</th>
                    </tr>
                    <?php if (mysqli_num_rows($res) > 0) {
                        $i = 1;
                        while ($row = mysqli_fetch_assoc($res)) { 
                            if ($i <= 20) { ?> 
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo base64_decode($row['customerName']); ?></td>
                        <td><?php echo $row['wordsNum']; ?></td>
                        <td><?php echo $row['booksNum']; ?></td>
                    </tr>
                    <?php }else {
                        break;
                    } $i++; } }else { ?>
                        <td colspan="4">NO DATA AVAILABLE</td>
                    <?php } ?>
                </table>
        </div>
    </div>


<?php include 'footer.php'; ?>