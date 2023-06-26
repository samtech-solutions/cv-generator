<?php
require './signup/config/constants.php';

$username_email = $_SESSION['signin-data']['username_email'] ?? null;

$password = $_SESSION['signin-data']['password'] ?? null;
unset($_SESSION['signin-data']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>curriculum vitae plus generator</title>
  <link href="css/jquery-ui.css" rel="stylesheet" />
  <!-------------------icon------------>
  <link rel="shortcut icon" type="image/ico" href="images/favicon.ico" />
  <link rel="stylesheet" href="./css/style.css" />
  <link href="css/style.css" rel="stylesheet" />
  <link href="css/styles2.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" media="all" />
  <link rel="stylesheet" type="text/css" href="fonts/css/all.css" media="all" />
  <script src="external/jquery/jquery.js"></script>
  <script src="js/jquery-ui.js"></script>

  <script src="jsPDF/dist/jspdf.min.js"></script>

  <style>
    #container {
      width: 100%;
      height: auto;
    }

    #exampleModalLabel,
    #exampleModalLongTitle,
    #exampleModalCenter {
      color: blue;
    }

    .container {
      border: none !important;
      background-color: white;
    }

    .wrapper {
      margin-top: 25px !important;
      background-color: #ffffff;
      height: 70px;
      padding: 0px 0px;
      display: flex;
      border-radius: 8px;

    }

    .modal-body p {
      text-align: left;
      color: purple;
    }

    .modal-body .fa-times-circle {
      margin-right: 20px;
      color: red;
      font-size: 25px;
    }

    .modal-body .fa-check-circle {
      margin-right: 20px;
      color: green;
      font-size: 25px;
    }

    .modal-body h4 {
      text-align: center;
      color: green !important;
    }

    .words {
      overflow: hidden;

    }

    span {
      display: block;
      height: 100%;
      padding-left: 10px;
      color: #0e6ffc;
      animation: spin_words 10s infinite;
    }

    @keyframes spin_words {
      0% {
        transform: translateY(-60%);
      }

      50% {
        transform: translateY(100%);
      }

      100% {
        transform: translateY(-170%);
      }

    }

    .footer {
      width: 100%;
      height: 30px;
      margin-left: 10px;
      background-color: black;
    }

    .plan {
      width: 400px;
      height: auto;
      background-color: white;
      margin: 20px;
    }

    img {
      width: 250px;
      height: 250px;
    }


    h6 {
      margin-left: 10px;
    }

    .buttons {
      display: flex;
      justify-content: space-between;
      flex-direction: rows;
      width: auto;
    }

    a {
      text-decoration: none;
      ;
    }

    .login {
      width: 80px;
      height: 40px;
      background-color: rgb(43, 201, 12);
      border-radius: 10px;
      border: none;
      color: white;
    }

    .more {
      position: relative;
      color: blue;
      border: none;
      display: inline-block;
      background-color: white;
      cursor: pointer;
      font-size: 16px;
    }

    .logo {
      margin-top: -30px;
      width: auto;
      height: 100px;
    }

    /*===============SIGN IN PAGE==========*/

    .form_control {
      display: flex;
      flex-direction: column;
      gap: 0.6rem;
    }

    .form_control.inline {
      flex-direction: row;
      align-items: center;
    }

    input,
    textarea,
    select {
      padding: 0.6rem 0.9rem;
      background-color: rgb(79, 78, 80);
      border-radius: .4rem;
      resize: none;
      color: white;
    }

    /*-----------------Viewport less than or equal to 520px----------------*/

    @media (max-width: 520px) {
      #container {
        width: 90%;
        height: auto;
        overflow: scroll;
      }

      .container {
        border: none !important;
      }

      .buttons {
        display: flex;
        justify-content: space-between;
        flex-direction: column;
        width: 90%;
      }

      img {
        width: 200px;
        height: 150px;
      }

      .plan {
        width: 90%;
        height: 320px;
        background-color: white;
        margin-left: 50px;
      }

      a {
        margin-left: 20px;
      }

      .logo {
        margin-top: -30px;
        width: auto;
        height: 100px;
      }

      .footer {
        width: 95%;
        height: 40px;
        margin-left: 15px;
        font-size: 13px;
        background-color: black;
      }

      .plan .btn {
        width: 100px !important;
      }
    }
  </style>
</head>

<body>
  <div id="container" style="background-color:rgb(246, 239, 239);width:100%">

    <h3 align="center"><img src="payment/images/cv-logo.jpg" class="logo"></h3>
    <p style="font-size:15px">CURRICULUM VITAE PLUS GENERATOR SYSTEM</p>

    <h4 style="margin-left:20px;margin-top:-15px;color:rgb(66, 228, 193)">Already have an account
      <button class="login" data-bs-toggle="modal" data-bs-target="#exampleModallogin" style="margin-left:20px;margin-bottom:0px;padding-bottom:10px">Login</button>
    </h4>
    <div class="buttons">
      <div class="plan">
        <!--<h4 style="text-align:center">Start Demo</h4>-->
        <a style="text-decoration: none; color: rgb(230, 206, 76)" href="#">
          <img src="payment/images/p1.png"></img>
         <!-- <h3 style="text-decoration:none">Available for <b>14</b> days</h3>-->
          <br>
          <br>
          <br>
          <h6>Monthly Plan <b>Free</b> </h6>
          <h6>Yearly Plan <b>Free</b> </h6>
          <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal0" style="margin-left:50px;margin-bottom:0px">Trial</button>
          <button class="more tooltip-test" title="Read More Information" data-bs-toggle="modal" data-bs-target="#exampleModalLong" style="margin-left:80px;margin-bottom:0px"><i class="fa fa-stream" aria-hidden="true"></i></button>

        </a>
      </div>
      <div class="plan">
       <!-- <h4 style="text-align:center">Starter Package Version</h4>-->
        <a style="text-decoration: none; color: rgb(56, 46, 192)" href="#">

          <img src="payment/images/p2.png"></img>

          <div class="wrapper">
            <p style="text-decoration:none">Payment Plans</p>
            
            <div class="words">
              <span>Monthly <b>100 KSH</b> or <b>1 USD</b> </span>
              <span>Yearly <b>1200 KSH</b> or <b>12 USD</b> </span>

            </div>
          </div>
          <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="margin-left:40px;margin-bottom:0px">Subscribe</button>
          <button class="more tooltip-test" title="Read More Information" data-bs-toggle="modal" data-bs-target="#exampleModalCenter" style="margin-left:80px;margin-bottom:0px"><i class="fa fa-stream" aria-hidden="true"></i></button>

        </a>
      </div>
      <div class="plan">
        <!--<h5 style="text-align:center">Professional Package Version</h5>-->
        <a style="text-decoration: none; color: rgb(202, 185, 34)" href="#">
          <img src="payment/images/p3.png"></img>
         <!-- <h3 style="text-decoration:none">Payment Plans</h3>-->
         <br>
          <br>
          <br>
          <h6>Yearly <b>3000 KSH</b> or <b>30 USD</b> </h6>
          <br>
          <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal1" style="margin-left:40px;margin-bottom:-20px">Subscribe</button>
          <button class="more tooltip-test" title="Read More Information" data-bs-toggle="modal" data-bs-target="#exampleModalmore2" style="margin-left:80px;margin-bottom:-20px"><i class="fa fa-stream" aria-hidden="true"></i></button>

        </a>
      </div>
    </div>
    <div class="footer">

      <?php include_once 'footer1.php' ?>

    </div>
  </div>

  <!-- Modal for login popup-->
  <div class="modal fade" id="exampleModallogin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Login</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <section class="form_section">
          <div class="container form_section-container">

            <form action="signup/signin-logic.php" method="POST">

              <div class="modal-body">

                <input style="width:100%; margin-bottom:10px" type="text" name="username_email" value="<?= $username_email ?>" placeholder="Enter Your Username" /><br>
                <input style="width:100%;" type="password" name="idno" value="<?= $password ?>" placeholder="Enter Your Password" />

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> <i class="fa fa-times" aria-hidden="true"></i> Cancel</button>
                <button type="submit" name="submit" id="submit" class="btn btn-info" data-toggle="modal" data-target="#exampleModal0"> <i class="fa fa-sign-in" aria-hidden="true"></i> Login </button>
              </div>

            </form>
          </div>
        </section>
      </div>
    </div>
  </div>
  <!-- end modal-->

  <!-- Modal for trial Version -->
  <div class="modal fade" id="exampleModal0" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Trial Version</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form action="payment/trial_package.php" method="POST">
          <div class="modal-body">
            <h4 style="color:red">Payment Plan</h4>
            <p>Please choose Free plan!!</p>

            <input type="radio" id="trial" name="free" value="Trial" required> <label for="trial"> Free(0Ksh/0Usd)</label>

            <br>

            <br>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> <i class="fa fa-times" aria-hidden="true"></i> Close</button>
            <button type="submit" name="save" id="save" class="btn btn-info" data-toggle="modal" data-target="#exampleModal0"> <i class="fa fa-save" aria-hidden="true"></i> Save </button>
          </div>

        </form>

      </div>
    </div>
  </div>
  <!-- end modal-->


  <!-- Modal for more button trial Version -->
  <div class="modal fade" id="exampleModalLong" tabindex="-1" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLongTitle">Trial Version More Info</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form action="payment/trial_package.php" method="POST">
          <div class="modal-body">

            <h6 style="color:purple">This is a trial version of the CV PLUS SYSTEM that gives our users the feel of our system.</h6>
            <h6 style="color:purple">It has limited access</h6>
            <h4 style="text-align:left">Services</h4>

            <p> <i class="fa fa-check-circle" aria-hidden="true"></i>No Payment</p>
            <p><i class="fa fa-check-circle" aria-hidden="true"></i> Create login account</p>
            <p> <i class="fa fa-check-circle" aria-hidden="true"></i> Add data to process CV</p>
            <p><i class="fa fa-check-circle" aria-hidden="true"></i> Generate Pdf</p>
            <p><i class="fa fa-check-circle" aria-hidden="true"></i> 2 Pdf Designs</p>
            <p><i class="fa fa-check-circle" aria-hidden="true"></i> Create a Job Application letter</p>
            <p><i class="fa fa-times-circle" aria-hidden="true"></i> Create User</p>
            <p><i class="fa fa-times-circle" aria-hidden="true"></i> Add Profile</p>
            <p><i class="fa fa-times-circle" aria-hidden="true"></i> Edit Data</p>
            <p><i class="fa fa-times-circle" aria-hidden="true"></i> Delete Data</p>

            <a href="index1.php" class="tooltip-test" title="Paid plan">Subcribe to Paid Plan</a></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> <i class="fa fa-times" aria-hidden="true"></i> Close</button>
          </div>

        </form>

      </div>
    </div>
  </div>
  <!-- end more button modal-->


  <!-- Modal for Starter Package Version -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Starter Package Version</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form action="payment/starter_package.php" method="POST">
          <div class="modal-body">
            <h4 style="color:red">Payment Plan</h4>
            <p>Please choose your plan!!</p>

            <input type="radio" id="monthly" name="starter" value="Monthly" required> <label for="monthly"> Monthly(100Ksh/1Usd)</label>

            <br>
            <br>
            <input type="radio" id="yearly" name="starter" value="Yearly" required> <label for="yearly"> Yearly(1200Ksh/12Usd)</label>

            <br>
            <br>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> <i class="fa fa-times" aria-hidden="true"></i> Close</button>
            <button type="submit" name="save" id="save" class="btn btn-info" data-toggle="modal" data-target="#exampleModal"> <i class="fa fa-save" aria-hidden="true"></i> Save </button>
          </div>

        </form>

      </div>
    </div>
  </div>
  <!-- end modal-->

  <!-- Modal for more button Starter Version -->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialong-centered role=" document">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLongTitle">Starter Version More Info</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form action="payment/trial_package.php" method="POST">
          <div class="modal-body">
            <h6 style="color:purple">This is a Starter Version of the CV PLUS SYSTEM that gives our users the full access to our System.</h6>
            <h6 style="color:purple">It has Unlimited access and one enjoy the full services</h6>
            <h4 style="text-align:left">Services</h4>

            <p> <i class="fa fa-check-circle" aria-hidden="true"></i>Paid Plan</p>
            <p><i class="fa fa-check-circle" aria-hidden="true"></i> Create login account</p>
            <p> <i class="fa fa-check-circle" aria-hidden="true"></i> Add data to process CV</p>
            <p><i class="fa fa-check-circle" aria-hidden="true"></i> Generate Pdf</p>
            <p><i class="fa fa-check-circle" aria-hidden="true"></i> 6 Pdf Designs</p>
            <p><i class="fa fa-check-circle" aria-hidden="true"></i> Create a Job Application letter</p>
            <p><i class="fa fa-check-circle" aria-hidden="true"></i> Create User</p>
            <p><i class="fa fa-check-circle" aria-hidden="true"></i> Add Profile</p>
            <p><i class="fa fa-check-circle" aria-hidden="true"></i> Edit Data</p>
            <p><i class="fa fa-check-circle" aria-hidden="true"></i> Delete Data</p>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> <i class="fa fa-times" aria-hidden="true"></i> Close</button>
          </div>

        </form>

      </div>
    </div>
  </div>
  <!-- end more button starter modal-->


  <!-- Modal for professional Package Version -->
  <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Proffessional Package Version</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form action="payment/proffessional_package.php" method="POST">
          <div class="modal-body">
            <h4 style="color:red">Payment Plan</h4>
            <p>Please choose your plan!!</p>

            <input type="radio" id="yearly" name="yearly" value="Yearly" required> <label for="yearly"> Yearly(3000Ksh/30Usd)</label>

            <br>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> <i class="fa fa-times" aria-hidden="true"></i> Close</button>
            <button type="submit" name="save" id="save" class="btn btn-info" data-toggle="modal" data-target="#exampleModal1"> <i class="fa fa-save" aria-hidden="true"></i> Save </button>
          </div>
        </form>

      </div>
    </div>
  </div>
  <!-- end modal-->

  <!-- Modal for more button professional Version -->
  <div class="modal fade" id="exampleModalmore2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Professional Version More Info</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form action="payment/trial_package.php" method="POST">
          <div class="modal-body">
            <h6 style="color:purple">This is a Professional Version of the CV PLUS SYSTEM that gives our users the full access to our System.</h6>
            <h6 style="color:purple">It has Unlimited access and one enjoy the full services</h6>
            <h4 style="text-align:left">Services</h4>

            <p> <i class="fa fa-check-circle" aria-hidden="true"></i>Paid Plan</p>
            <p><i class="fa fa-check-circle" aria-hidden="true"></i> Create login account</p>
            <p> <i class="fa fa-check-circle" aria-hidden="true"></i> Add data to process CV</p>
            <p><i class="fa fa-check-circle" aria-hidden="true"></i> Generate Pdf</p>
            <p><i class="fa fa-check-circle" aria-hidden="true"></i> 6 Pdf Designs</p>
            <p><i class="fa fa-check-circle" aria-hidden="true"></i> Create User</p>
            <p><i class="fa fa-check-circle" aria-hidden="true"></i> Create a Job Application letter</p>
            <p><i class="fa fa-check-circle" aria-hidden="true"></i> Add Profile</p>
            <p><i class="fa fa-check-circle" aria-hidden="true"></i> Edit Data</p>
            <p><i class="fa fa-check-circle" aria-hidden="true"></i> Delete Data</p>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> <i class="fa fa-times" aria-hidden="true"></i> Close</button>
          </div>

        </form>

      </div>
    </div>
  </div>
  <!-- end more button prefessional modal-->

  <script src="js/custom.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
</body>

</html>