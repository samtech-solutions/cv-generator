<?php
//connect to database
require 'signup/config/constants.php';

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (mysqli_errno($conn)) {
  die(mysqli_error($conn));
}


//if user click verification code submit button
if (isset($_POST['check'])) {
  $_SESSION['info'] = "";

  $otp_code = mysqli_real_escape_string($conn, $_POST['otp']);
  $check_code = "SELECT * FROM tbl_cv WHERE code = $otp_code";
  $code_res = mysqli_query($conn, $check_code);
  if (mysqli_num_rows($code_res) == 1) {
    $fetch_data = mysqli_fetch_assoc($code_res);
    $fetch_code = $fetch_data['code'];
    $email = $fetch_data['email'];
    $code = 0;
    $status = 'verified';
    $update_otp = "UPDATE tbl_cv SET code = $code, status = '$status' WHERE code = $fetch_code";
    $update_res = mysqli_query($conn, $update_otp);


    if ($update_res) {
      $_SESSION['email'] = $email;
      $db_password = $user_record['idno'];
      $transid = $user_record['transactionid'];
      header('location: signup/signin.php');
    } else {
      $failed = "Failed while updating code!";
      $_SESSION['failed'] = $failed;

      header('location: user-otp.php');
    }
  } else {
    $incorect = "You've entered incorrect code!";
    $_SESSION['incorect'] = $incorect;

    header('location: user-otp.php');
  }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Resume generator</title>
  <!--css style sheet-->

  <link rel="stylesheet" href="signup/css/style.css" />

  <!---------------------------Font awesome icons-------------------------->
  <link rel="stylesheet" type="text/css" href="signup/css/all.css" media="all" />
  <link rel="stylesheet" type="text/css" href="signup/fonts/css/all.css" media="all" />
</head>
<style>
  .footer {
    width: 100%;
    height: 30px;
    margin-left: 5px;
    margin-right: 2px;
    margin-bottom: -10px;
    background-color: black;
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
    .alert_message{
      font-size:6px !important;
    }
  }
</style>

<body>
  <div style="height:400px">
    <div>
      <h3 align="center"><img src="images/cv-logo.jpg" class="logo"></h3>

    </div>
    <section class="form_section" style="height:615px">
      <div class="container form_section-container">
        <h2 style="font-size:17px"> Code Verification </h2>
        <?php if (isset($_SESSION['info'])) : ?>
          <div class="alert_message error">
            <p>
              <?= $_SESSION['info'];
              unset($_SESSION['info']);
              ?>
            </p>
          </div>
        <?php elseif (isset($_SESSION['failed'])) : ?>
          <div class="alert_message error">
            <p>
              <?= $_SESSION['failed'];
              unset($_SESSION['failed']);
              ?>
            </p>
          </div>
        <?php elseif (isset($_SESSION['incorect'])) : ?>
          <div class="alert_message error">
            <p>
              <?= $_SESSION['incorect'];
              unset($_SESSION['incorect']);
              ?>
            </p>
          </div>
        <?php endif ?>

        <form action="" method="POST">
          <input type="text" name="otp" value="" placeholder="Enter verification code" />
          <div style="text-align:center">
            <button type="submit" name="check" class="btn"> Submit <i class="fa fa-sign-in" aria-hidden="true"></i></button>
          </div>
        </form>
      </div>
    </section>

    <div class="footer"><?php include_once 'footer.php' ?></div>
  </div>
</body>

</html>