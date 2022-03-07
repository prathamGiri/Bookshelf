<?php 
session_start();

function redirect($link){
    //using javascript
    ?>
    <script>
        window.location.href='<?php echo $link ?>'
    </script>
    <?php
    //after redirection kill the script
    die();  
}

function loggedinonly($location)
{
    if (!isset($_SESSION['login_status'])) {
        redirect($location);
    }
}

function loggedoutonly($location)
{
    if (isset($_SESSION['login_status'])) {
        redirect($location);
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

?>
