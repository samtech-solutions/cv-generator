<?php
require 'config/constants.php';

$username_email = $_SESSION['signin-data']['username_email'] ?? null;

$password = $_SESSION['signin-data']['password'] ?? null;
unset($_SESSION['signin-data']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Resume generator</title>
  <!--css style sheet-->

  <link rel="stylesheet" href="./css/style.css" />

  <!---------------------------Font awesome icons-------------------------->
  <link rel="stylesheet" type="text/css" href="./css/all.css" media="all" />
  <link rel="stylesheet" type="text/css" href="fonts/css/all.css" media="all" />
</head>
<style>
  body {
    background-color: rgb(246, 239, 239);
  }

  .container {
    width: 40%;
    height: 230px;
    margin-left: 30%;
    margin-top: 4%;
    background-color: white
  }

  form input {
    width: 60%;
    margin-left: 2%;
    padding: 10px;
    margin-top: 2%;
  }

  .container {
    width: 50%;
    height: 230px;
    margin-left: 30%;
    margin-top: 10%;
    background-color: white;
  }

  form input {
    width: 55%;
    margin-left: 2%;
    padding: 10px;
    margin-top: 2%;
  }

  .logo {
    margin-top: -65px;
    width: auto;
    height: 150px;
  }

  .img {
    width: 200px;
    height: 200px;
    margin-left: 36%;
    margin-top: -50px;
  }

  /*-----------------Viewport less than or equal to 520px----------------*/

  @media (max-width: 520px) {
    .img {
      width: 250px;
      height: 250px;
      margin-left: 22%;

    }
    .footer {
    width: 100% !important;
    height: 40px !important;
    margin-left: 0px;
    margin-right: 2px;
    margin-bottom: -10px;
    background-color: black;  
  }
    .footer_copyright {
    margin-left: -3% !important;
    font-size: 7px !important;
  }
  form input {
    width: 95%;
    margin-left: 2%;
    padding: 10px;
    margin-top: 2%;
  }
 
  }
</style>

<body>
  <div>
    <div>
      <h3 align="center"><img src="../payment/images/cv-logo.jpg" class="logo"></h3>

    </div>

    <div class="container">
      <h2 style="margin-left:2%"> Sign In </h2>
      <?php if (isset($_SESSION['signin'])) : ?>
        <div class="alert_message error">
          <p>
            <?= $_SESSION['signin'];
            unset($_SESSION['signin']);
            ?>
          </p>
        </div>
      <?php elseif (isset($_SESSION['signup-success'])) : ?>
        <div class="alert_message success ">
          <p>
            <?= $_SESSION['signup-success'];
            unset($_SESSION['signup-success']);
            ?>
          </p>
        </div>
      <?php elseif (isset($_SESSION['infomessage'])) : ?>
        <div class="alert_message error ">
          <p>
            <?= $_SESSION['infomessage'];
            unset($_SESSION['infomessage']);
            ?>
          </p>
        </div>

      <?php endif ?>

      <form action="signin-logic.php" method="POST">
        <input type="text" name="username_email" value="<?= $username_email ?>" placeholder="Enter Your Username" />
        <input type="password" name="idno" value="<?= $password ?>" placeholder="Enter Your Password" />
        <div style="text-align:center">
          <button type="submit" name="submit" class="btn"> Sign in <i class="fa fa-sign-in" aria-hidden="true"></i></button>
        </div>
      </form>
      <br>
      <br>
      <br>
    
    </div>
    <!--
    <div class="footer"><?php include_once '../footer.php' ?></div>-->



  </div>
</body>

</html>