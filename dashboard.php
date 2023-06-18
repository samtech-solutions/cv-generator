<?php
include "connection.php";

session_start();

$current_user_id = $_SESSION["user-id"];
$new_trans_id = $_SESSION["newuser"];
$sql = "SELECT * FROM tbl_cv WHERE userid='$current_user_id'";
$res = mysqli_query($conn, $sql);
$sql = "SELECT * FROM tbl_cv WHERE userid='$current_user_id'";
$res = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>cv plus generator</title>
  <link href="css/jquery-ui.css" rel="stylesheet">
  <link href="css/styles.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css2/css/styles2.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="fonts/css/all.css" media="all" />
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" media="all" />
  <script src="external/jquery/jquery.js"></script>


</head>
<style>
  body {
    background-color: rgb(246, 239, 239);
  }

  .center {
    margin-left: 100px;
  }

  .document {
    text-align: left;
    background: white;
    margin-top: 0px;
    padding-top: 10px;
    padding-left: 1px;
    padding-bottom: -100px;
  }

  h3 {
    position: relative;
    font-size: 15px;
    color: blue;
    text-align: left;
    margin: 5px;
    text-decoration: none;
  }

  b {
    color: black;
    font-size: 17px;
  }

  th {
    color: black;
  }

  td {
    color: blue;
  }

  table {
    border: none;
  }

  h2 {
    text-decoration: none !important;
    color: green;
  }

  .logo {
    margin-top: -30px;
    width: auto;
    height: 80px;
  }

  #profile {
    display: flex;
    flex-direction: column;

  }

  .profile {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    margin-top: 15px;
    margin-right: 50px;
    display: flex;
    flex-direction: column;
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

  .error {
    color: white;
    width: 100%;
    background-color: darkred;
    text-align: center
  }

  .user_data {
    background-color: white;
    width: 100%;
    display:grid;
    grid-template-columns:repeat(4,1fr);
  }

  .user_data label {
    width:100%;
    text-align:left;
    margin-top:25px;
    margin-left:30px;
    color:brown;
    font-family: 'Poppins', san-serif;
  }

  .user_data input {
    border: none;
    margin:5px;
    margin-left: -40px;
    padding:4px;
    height: 50px;
    border-radius: 5px;
    padding-left:10px;
    width:100%;
    background-color:bisque;
  }

  button {
    width: 130px;
    height:40px;
    margin-top:10px;
    margin-bottom:5px;
  }

  .footer {
    width: 100%;
    height: 30px;
    font-size: 12px;
    margin-left: 0px;
    margin-right: -10px;
    margin-bottom: -10px;
    background-color: black;
  }

  .footer_copyright small {
    margin-left: 0px;
  }

  /*-----------------Viewport less than or equal to 520px----------------*/

  @media (max-width: 520px) {

    .profile {
      width: 80px;
      height: 80px;
      border-radius: 50%;

    }

    .container {
      width: 400px !important;
      background-color: rgb(246, 239, 239) !important;
    }

    .user_data {
    width: 100%;
    display:grid;
    grid-template-columns:repeat(2,1fr);
  }

  .user_data label {
    width: 100%;
    margin-left:10px;
    margin-top: -5px;
    padding-top:20px;
  }

  .user_data input {
    border: none;
    width:100%;
    height: 30px;
    border-radius: 5px;
    margin-left: -20px;
    padding-left: 10px;
    font-size:15px;
  }
  button {
    width: 120px;
  }
    .footer {
      width: 100%;
      height: 35px;
      font-size: 12px;
      margin-left: 0px;
      margin-right: -10px;
      margin-bottom: -10px;
      background-color: black;
    }

    .footer_copyright small {
      margin-left: -10px;
    }
  }
</style>

<body>
  <div class="container">
    <?php include_once 'header1.php' ?>

    <!-- personal details -->
    <h1 style="text-align:center;text-decoration:none;color:blue">My Profile</h1>

    <?php

    if (mysqli_num_rows($res) > 0) {

      while ($row = mysqli_fetch_assoc($res)) { ?>
        <form action="functions/update_user_details.php" method="POST">
          <div class="user_data">
            <label> First Name :</label>
            <input id="firstname" name="firstname" value="<?php echo $row['firstname']; ?>" placeholder="Enter Your First Name">
            <label> Middle Name :</label>
            <input id="middlename" name="middlename" value="<?php echo $row['middlename']; ?>" placeholder="Enter Your Middle Name">
            
			<!--<label> Personal Profile :</label>
            <input id="personalprofile" name="personalprofile" value="<?php echo $row['personalprofile']; ?>" placeholder="Enter Your Personal Profile">
            <label> Career Objectives :</label>
            <input id="careerobjectives" name="careerobjectives" value="<?php echo $row['careerobjectives']; ?>" placeholder="Enter Your Career Objectives">-->
           
			
			<label> Last Name :</label>
            <input id="lastname" name="lastname" value="<?php echo $row['lastname']; ?>" placeholder="Enter Your Last Name">
            <label> Gender :</label>
            <input type="text" id="gender" name="gender" value="<?php echo $row['gender']; ?>" placeholder="Choose gender" disabled />
                       
            <label> Id No :</label>
            <input id="idno" name="idno" value="<?php echo $row['idno']; ?>" placeholder="Enter Your Id" disabled>
            <label> Year of Birth :</label>
            <input id="yob" name="yob" value="<?php echo $row['yob']; ?>" placeholder="Enter Your First Name">
            <label> Email :</label>
            <input id="email" name="email" style="font-size:16px" value="<?php echo $row['email']; ?>" placeholder="Enter Your Middle Name" disabled>
            <label> Phone1 :</label>
            <input id="phone1" name="phone1" value="<?php echo $row['phone1']; ?>" placeholder="Enter Your Last Name">
            <label> Phone2 :</label>
            <input id="phone2" name="phone2" value="<?php echo $row['phone2']; ?>" placeholder="Enter Your Gender">

            <label> Address1 :</label>
            <input id="address1" name="address1" value="<?php echo $row['address1']; ?>" placeholder="Enter Your Gender">
            <label> Address2 :</label>
            <input id="address2" name="address2" value="<?php echo $row['address2']; ?>" placeholder="Enter Your Last Name">
            
			
		   <br>
			<br>
            <button type="submit" name="update" id="update" class="btn btn-info" data-toggle="modal"> <i class="fa fa-refresh" aria-hidden="true"></i> Update</button>
          </div>
          <div class="footer"><?php include_once "footer.php" ?></div>
        </form>


    <?php  }
    }
    ?>
  </div>


  </div>



  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>

</body>

</html>