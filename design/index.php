<?php
include "../connection.php";
session_start();

$current_user_id = $_SESSION['user-id'];

$sql = "SELECT * FROM tbl_cv WHERE userid='$current_user_id'";

$res = mysqli_query($conn, $sql);


$new_trans_id = $_SESSION['newuser'];
//echo $new_trans_id;
$status = '';
$type = '';

$res1 = mysqli_query($conn, "SELECT * FROM payment WHERE id ='$new_trans_id'");

while ($row1 = mysqli_fetch_array($res1)) {

  $status = $row1['userstatus'];
  $type = $row1['package_type'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>cv+ resume</title>
  <link href="../css/jquery-ui.css" rel="stylesheet">
  <link href="../css/style.css" rel="stylesheet">
  <link href="../css/styles2.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../fonts/css/all.css" media="all" />
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" media="all" />
  <script src="../external/jquery/jquery.js"></script>


</head>
<style>
  .button {
    margin: 10px 10px 10px 10px;
  }
.table-responsive{
    height:320px;
}
  .button {
    margin: 2px 2px 2px 2px;
  }

  h2 {
    text-decoration: none !important;
    color: green;
  }

  .footer {
    width: 102%;
    height: 30px;
    margin-left: -10px;
    margin-right: -10px;
    margin-bottom: -10px;
    background-color: black;
  }

  .logo {
    margin-top: -3px;
    width: auto;
    height: 80px;
  }

  a {
    list-style: none;
    text-decoration: none;
    color: green;
  }

  .img {
    width: 250px;
    height: 250px;
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
  }
</style>

<body>

  <div class="container">
    <?php include '../header.php' ?>
    <hr>
    <div class="title">
      <div class="center" style="text-align:center">
        <a href="index.php"><button id="header" class="btn btn-success btn-xs" style="width:auto"> <i class="fa fa-id-card" aria-hidden="true"></i> Choose a Design</button></a>
      </div>
      <br>
    </div>

    <div class="table-responsive" id="user_data">


      <div align="center">
        <form action="pdf_gen.php" method="post">

          <button type="submit" name="pdf" style="border:none" class="button" onclick="return confirm('ARE YOU SURE YOU WANT TO GENERATE YOUR CV?');">
            <image style="width:250px;height:300px" type="image" name="pdf" src="../images/design1.pdf" id="pdf" class="image"></image>
          </button>

          <button type="submit" name="pdf3" style="border:none" class="button" onclick="return confirm('ARE YOU SURE YOU WANT TO GENERATE YOUR CV?');">
            <image style="width:250px;height:300px" type="image" name="pdf3" src="../images/design3.pdf" id="pdf3" class="image"></image>
          </button>


          <!-- check for user status WHO HAVE PAID-->
          <?php if ($status == 'Paid') : ?>

            <button type="submit" name="pdf2" style="border:none" class="button" onclick="return confirm('ARE YOU SURE YOU WANT TO GENERATE YOUR CV?');">
              <image style="width:250px;height:300px" type="image" name="pdf2" src="../images/design2.pdf" id="pdf2" class="image"></image>
            </button>

            <button type="submit" name="pdf4" style="border:none" class="button" onclick="return confirm('ARE YOU SURE YOU WANT TO GENERATE YOUR CV?');">
              <image style="width:250px;height:300px" type="image" name="pdf4" src="../images/design4.pdf" id="pdf4" class="image"></image>
            </button>

            <button type="submit" name="pdf5" style="border:none" class="button" onclick="return confirm('ARE YOU SURE YOU WANT TO GENERATE YOUR CV?');">
              <image style="width:250px;height:300px" type="image" name="pdf5" src="../images/design5.pdf" id="pdf5" class="image"></image>
            </button>

            <button type="submit" name="pdf2" style="border:none" class="button" onclick="return confirm('ARE YOU SURE YOU WANT TO GENERATE YOUR CV?');">
              <image style="width:250px;height:300px" type="image" name="pdf2" src="../images/design2.pdf" id="pdf2" class="image"></image>
            </button>
        
        </form>
        <?php endif ?>
      </div>
      <hr>



      <div class="center" style="text-align:center">
        <a href="../application_letter/application.html"><button id="header" class="btn btn-success btn-xs" style="width:auto"> <i class="fa fa-envelope" aria-hidden="true"></i> Application Letter</button></a>
      </div>
      <br>
      <div align="center">
        <a href="../application_letter/application.html" target="_blank"><img src="../images/design2.pdf" height="250px" width="250px" class="image" /></a>
      </div>
      <hr>
      <p style="color:blue">**Alert: Your CV has been created successfully. Go to downloads and locate for
        Resume.pdf</p>
   
    </div>
    <div class="footer"><?php include_once "../footer.php" ?></div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>

</body>

</html>