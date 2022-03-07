<?php
include 'back/connection.php';
include 'back/functions.php';

loggedoutonly('../index.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookshelf Login</title>
    <link rel="stylesheet" href="../css/nav_style.css">
    <link rel="stylesheet" href="../css/login-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <script src="../javascript/login.js"></script>
    <link rel="shortcut icon" href="../img/book.png">
</head>
<body>
    <div class="logo">
        <h2>Bookshelf</h2>
    </div>
    <?php
    if (isset($_GET['type'])) {
      if ($_GET['type'] == 'emailalreadyexist') {
        ?>
        <div id="msg">
          <p>Email Already Exists, Register With Another Email.</p>
        </div>
        <?php
      }elseif ($_GET['type'] == 'wrongcredential') {
        ?>
        <div id="msg">
          <p>Email or Password Is Wrong, Please Confirm While Entering.</p>
        </div>
        <?php
      }
    }
    ?>
    <div class="form">
      <ul class="tab-group">
        <li class="tab active" id="signuptab"><a>Sign Up</a></li>
        <li class="tab" id="logintab"><a>Log In</a></li>
      </ul>
      
      <div class="tab-content">
        <div id="signup">   
          <h1>Sign Up for Free</h1>
          
          <form action="back/register.php" method="post">
          
          <div class="top-row">
            <div class="field-wrap">
              <input type="text" required autocomplete="off" name="fname" placeholder="First Name*" maxlength="15">
            </div>
        
            <div class="field-wrap">
              
              <input type="text"required autocomplete="off" name="lname" placeholder="Last Name*" maxlength="15">
            </div>
          </div>

          <div class="field-wrap">
            
            <input type="email" required autocomplete="off" name="email" placeholder="Email*">
          </div>

          <div class="field-wrap">
            
            <input type="text" required autocomplete="off" name="mobile"  placeholder="Mobile*" maxlength="10">
          </div>
          
          <div class="field-wrap" id="password">
            <input type="password" required autocomplete="off" name="pass_reg" id="password_input" placeholder="Set Password*">
            <span><i class="far fa-eye" id="togglePassword"></i></span>
          </div>
          
          <button type="submit" class="button button-block" name="register-btn">Get Started</button>
          
          </form>

        </div>
        
        <div id="login">   
          <h1>Welcome Back!</h1>
          
          <form action="back/login.php" method="post">
          
            <div class="field-wrap">
            
            <input type="email"required autocomplete="off" name="login_email"  placeholder="Email Address*">
          </div>
          
          <div class="field-wrap">
            
            <input type="password"required autocomplete="off" name="login_password" placeholder="Password*">
          </div>
          
          <p class="forgot"><a href="#">Forgot Password?</a></p>
          
          <button class="button button-block" name="login">Log In</button>
          
          </form>

        </div>
        
      </div><!-- tab-content -->
      
    </div> <!-- /form -->

</body>
</html>