<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>cv plus resume generator</title>
  <link href="css/jquery-ui.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link href="css/styles2.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" media="all" />
  <link rel="stylesheet" type="text/css" href="fonts/css/all.css" media="all" />
  <script src="external/jquery/jquery.js"></script>
  <script src="js/jquery-ui.js"></script>

  <script src="jsPDF/dist/jspdf.min.js"></script>

</head>
<style>
  #container{
    height:500px !important;
    width:98% !important;
}
#details,#mobile_phn{
    height:200px !important;
    overflow-y:scroll;
}
  .footer {
    width: 100%;
    height: 30px;
    margin-left: 0px;
    margin-right: 30px;
    margin-bottom: -10px;
    background-color: black;
  }

  .logo {
    margin-top: 0px;
    width: auto;
    height: 80px;
  }

  .img {
    width: 250px;
    height: 250px;
    margin-left: 36%;
    margin-top: -50px;
  }

  .life {
    width: auto;
    color: red;
    position: absolute;
    display: inline-block;
    margin: auto auto;
    white-space: nowrap;
    overflow: hidden;
    padding-left: 100%;
    font-family: 'Poppins', san-serif;
    line-height: 320px;
    font-size: 18px;
    animation: marquee 10s linear infinite;
  }

  @keyframes marquee {
    0% {
      transform: translate(0, 0);
    }

    100% {
      transform: translate(-100%, 0);
    }
  }

  /*-----------------Viewport less than or equal to 520px----------------*/

  @media (max-width: 520px) {
   .t_input,.tb_input{
       height:35px;
   }
   .tb_input1{
       height:70px;
   }
   #details,#mobile_phn{
    margin-left:-30px;
    height:200px !important;
    overflow-y:scroll;
}
    .img {
      width: 250px;
      height: 250px;
      margin-left: 22%;
    }

    .footer {
      width: 100%;
      height: 30px;
      margin-left: 0px;
      margin-right: 0px;
      margin-bottom: 0px;
      background-color: black;
    }

    form#user_form {
      width: 330px !important;
    }
  }
</style>

<body>

  <div id="container" style="width:100%">

    <?php

    session_start();

    include "connection.php";

    $duration = "";

    $current_user_id = $_SESSION['userid'];

    //echo $current_user_id;

    $res = mysqli_query($conn, "SELECT * FROM payment WHERE id ='$current_user_id'");

    while ($row = mysqli_fetch_array($res)) {

      $duration = $row['life_duration'];

      $start_time = $row['date_paid'];
    }
    $_SESSION['duration'] = $duration;

    $_SESSION['start_time'] = $start_time;

    //calculating expiry date

    $end_time =  "{$start_time} + {$duration} days";

    $_SESSION['end_time'] = $end_time;

    //creating objects

    $origin = date_create($start_time);

    $due = date_create($end_time);

    $explore = date_diff($origin, $due);

    /*highlight_string("<?php" . var_export($explore, true) . ";?>");*/

    $today = new DateTime();

    if ($due < $today) {
      $days_expired = date_diff($due, $today);
      echo "<div class='life'>Your Account Expired {$days_expired->days} days ago </div>";

      $query1 = "UPDATE payment  SET userstatus ='Expired' WHERE id = $current_user_id";
      $result1 = mysqli_query($conn, $query1) or die(mysqli_error($conn));

      $query2 = "UPDATE tbl_cv  SET userstatus ='0' WHERE transactionid = $current_user_id";
      $result2 = mysqli_query($conn, $query1) or die(mysqli_error($conn));

      echo "<script> alert('Your Account Expired {$days_expired->days} days ago, Make a new Payment to Enjoy our services ');
      window.location='renew/index.php'
       </script>";
    } else {
      $days_left = date_diff($due, $today);

      // echo "<div class='life'>Your Account is Active for another {$days_left->days} days.</div>";
      echo ' 
        <form id="user_form" action="user.php" enctype="multipart/form-data" method="POST">
        <h3 align="center"><img src="payment/images/cv-logo.jpg" class="logo"></h3>
      <progress id="progressBar" value="0" max="100" style="width:420px;height:15px;"></progress>
      <h6 id="status">Stage 1 of 10</h6>
      <hr>
      <div class="title">
        <h4 align="center" id="header">Personal Profile</h4>
        <p id="sub_header">Enter your personal information:</p>
      </div>

      <div id="user_data" class="form-group">
        <div id="myTable">
          <label><b>First Name :</b></label>
          <input type="text" id="firstname" name="firstname" class="t_input" placeholder="Enter first Name" required />

          <label><b>Middle Name :</b></label>
          <input type="text" id="middlename" name="middlename" class="t_input" placeholder="Enter Middle Name" required />

          <label><b>Last Name :</b></label>
          <input type="text" id="lastname" name="lastname" class="t_input" placeholder="Enter Last Name" required />

          <label><b>Id Number :</b></label>
          <input type="text" id="idno" name="idno" class="t_input" placeholder="Enter your Identification number" required />
                 
          </div>
        <br>
        <p align="center"><button class="btn btn-success btn-xs" id="next" onclick="processPhase1()"> Next <i class="fa fa-angle-double-right" aria-hidden="true"></i></button></p>
      </div>

      <div id="phase2" class="form-group">
        <div id="details">
          <label><b>Birth Year :</b></label><br>
          <input type="text" id="yob" name="yob" class="tb_input" placeholder="Enter Year  of birth" required />
          <label><b>Email :</b></label><br>
          <input type="email" id="email" name="email" class="tb_input" placeholder="Enter email" required />
          <label><b>Gender :</b></label><br>
          <select type="text" id="gender" name="gender" class="tb_input" placeholder="Choose gender" required>
            <option value=""></option>
            <option value="Male" name="male">Male</option>
            <option value="Female" name="female">Female</option>
            <option value="Other" name="other">Other</option>
          </select><br>

          <label><b>Personal Profile :</b></label><br>
          <textarea type="text" id="personalprofile" name="personalprofile" class="tb_input1" placeholder="Type Your Personal Profile" required></textarea><br>

          <label><b>Career Objectives :</b></label><br>
          <textarea type="text" id="careerobjectives" name="careerobjectives" class="tb_input1" placeholder="Type Your Career Objectives" required></textarea><br>

        </div>
        <br>
        <p align="center"><button onclick="processPhase2()" class="btn btn-success"> Next <i class="fa fa-arrow-right" aria-hidden="true"></i> </button></p>
      </div>
      <div id="phase3" class="form-group" class="form-control">
        <div id="mobile_phn">

          <label><b>Mobile Phone No:</b></label><br>
          <input type="text" id="phone1" name="phone1" class="tb_input" placeholder="Enter your Mobile Phone [0765 567 654]" pattern="[0-9]{4}[0-9]{3}[0-9]{3}" required /><br>
          <label><b> Home Phone No :</b></label><br>
          <input type="text" id="phone2" name="phone2" class="tb_input" placeholder="Enter your home mobile [0765 567 654]" pattern="[0-9]{4}[0-9]{3}[0-9]{3}" required /><br>
          <label><b>Address1 :</b></label><br>
          <textarea type="text" id="address1" name="address1" class="tb_input1" placeholder="Enter your Address one" required></textarea><br>
          <label><b>Address2 :</b></label><br>
          <textarea type="text" id="address2" name="address2" class="tb_input1" placeholder="Enter your Address two" required></textarea><br>

        </div>
        <br>
        <p align="center"><button type="submit" name="user" id="user" class="btn btn-success btn-xs"> <i class="fa fa-save" aria-hidden="true"></i> Save</button></p>
        
      </div>
    ';
    }
    ?>

    <div class="footer"><?php include_once "footer1.php" ?></div>
  </div>

  <?php
  $user_id = $_SESSION['userid'];

  $status = '';
  $type = '';

  $res1 = mysqli_query($conn, "SELECT * FROM payment WHERE id ='$user_id'");

  while ($row1 = mysqli_fetch_array($res1)) {

    $status = $row1['userstatus'];
    $type = $row1['package_type'];
  }

  if ($status == 'Free') {
    include "advert1.php";
  } else {
    include "no_advert.php";
  }

  ?>
  </form>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
</body>

</html>

<script>
  var firstname, middlename, lastname, idno, yob, email, gender, personalprofile, careerobjectives,
    phone1, phone2, address1, address2;

  function _(x) {
    return document.getElementById(x);
  }

  function processPhase1() {
    firstname = _("firstname").value;
    middlename = _("middlename").value;
    lastname = _("lastname").value;
    idno = _("idno").value;
    if (firstname != '' && middlename != '' && lastname != '' && idno != '') {
      _("user_data").style.display = "none";
      _("phase2").style.display = "block";
      _("progressBar").value = 10;
      _("status").innerHTML = "Phase 2 of 10";
      _("header").innerHTML = "Personal Information : ";
      _("sub_header").innerHTML = "Continue Entering details here:";
      _("next").style.display = "none";
      _("user_data").style.display = "none";

    } else {
      alert("Please Fill all fields");
      _("next").style.display = "none";
      _("next").style.display = "block";
    }
  }

  function processPhase2() {
    yob = _("yob").value;
    email = _("email").value;
    gender = _("gender").value;
    personalprofile = _("personalprofile").value;
    careerobjectives = _("careerobjectives").value;

    if (gender.length > 0 && yob != '' && email != '' && personalprofile != '' && careerobjectives != '') {
      _("phase2").style.display = "none";
      _("phase3").style.display = "block";
      _("progressBar").value = 20;
      _("status").innerHTML = "Phase 3 of 10";
      _("header").innerHTML = "Contact Details :";
      _("sub_header").innerHTML = "Enter mobile and address details here:";

    } else {
      alert("Please Fill all data");
    }
  }

  function processPhase3() {
    phone1 = _("phone1").value;
    phone2 = _("phone2").value;
    address1 = _("address1").value;
    address2 = _("address2").value;
    if (phone1.length > 0 && phone2.length > 0 && address1 != '' && address2 != '') {
      _("phase3").style.display = "none";
      _("phase4").style.display = "block";
      _("progressBar").value = 30;
      _("status").innerHTML = "Phase 4 of 10";
      _("header").innerHTML = "Education Background :";
      _("sub_header").innerHTML = "Enter Educational details here....";

    } else {
      alert("Please choose your Address");
    }
  }
</script>