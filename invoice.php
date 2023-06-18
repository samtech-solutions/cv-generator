<?php
include "connection.php";

session_start();

$current_user_id = $_SESSION["user-id"];
$new_trans_id = $_SESSION["newuser"];
$sql = "SELECT * FROM payment WHERE id='$new_trans_id '";
$res = mysqli_query($conn, $sql);

//echo $new_trans_id ;
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
  i{
	  margin-left:0px;
	   margin-right:10px;
  }
 .fa,.fas{
	  color:white;
	  font-size:20px;
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
    width: 140px;
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
    width: 140px;
    height:40px;
    margin-top:10px;
    margin-bottom:5px;
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
    <h3 align="center"><img src="payment/images/cv-logo.jpg" class="logo"></h3>

    <!-- personal details -->
    <h1 style="text-align:center;text-decoration:none;color:blue">Invoice</h1>
	 
		    <button class="btn btn-info "><a href="education/index.php" > <i class="fa fa-mail-reply-all" aria-hidden="true" ></i>  Back</a></button> 
                
            <button class="btn btn-info"><a href="invoice/print_invoice.php" > <i class="fa fa-print" aria-hidden="true"></i> Print </a></button>
           
		   <button  class="btn btn-info"><a href="invoice/pdf_invoice.php"> <i class="fas fa-file-pdf" aria-hidden="true"></i> Print Pdf </a></button>
           
		   <button  class="btn btn-info"><a href="invoice/excel_invoice.php"> <i class="fas fa-file-excel" aria-hidden="true"></i> Export Excel </a></button>
        

    <?php

    if (mysqli_num_rows($res) > 0) {

      while ($row = mysqli_fetch_assoc($res)) { ?>
        <form action="" method="POST">
          <div class="user_data">
            <label> Usertoken :</label>
            <input  value="<?php echo $row['usertoken']; ?>">
            <label> Userstatus :</label>
            <input  value="<?php echo $row['userstatus']; ?>" >
            <label> Package Type :</label>
            <input value="<?php echo $row['package_type']; ?>" >
            <label> Payment Plan :</label>
            <input value="<?php echo $row['payment_plan']; ?>" />
                       
            <label> Amount:</label>
            <input id="idno" name="idno" value="<?php echo $row['amount']; ?>" >
            <label> Payment Code :</label>
            <input value="<?php echo $row['mpesa_code']; ?>" >
            <label> Life duration :</label>
            <input value="<?php echo $row['life_duration']; ?>" >
            <label> Date Paid :</label>
            <input  value="<?php echo $row['date_paid']; ?>" >
           
            <br>
			<br>
			<br>
			
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