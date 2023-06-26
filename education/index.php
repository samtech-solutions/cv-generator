<?php
include "../connection.php";

session_start();
$time_in = $_SESSION['time_in'];
$current_user_id = $_SESSION["user-id"];
$new_trans_id = $_SESSION["newuser"];
$user_id = 0;
//echo $current_user_id;
//echo $new_trans_id;
//echo $time_in;
$query = "SELECT * FROM education WHERE userid='$current_user_id'";

$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>cv plus generator</title>
  <!-------------------icon------------>
  <link rel="shortcut icon" type="image/ico" href="../images/favicon.ico" />
  <link href="../css/jquery-ui.css" rel="stylesheet">
  <link href="../css/style.css" rel="stylesheet">
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <link href="../css2/css/styles2.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../fonts/css/all.css" media="all" />
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" media="all" />
  <script src="../external/jquery/jquery.js"></script>


</head>
<style>
  #profile {
    display: flex;
    flex-direction: column;

  }
.table-responsive{
    height:160px;
}
  a {
    position: block;
  }

  .profile {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    margin-top: 5px;
    margin-right: 20px;
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
    animation: marquee 40s linear infinite;
  }

  @keyframes marquee {
    0% {
      transform: translate(20%, 0);
      color: yellow;
    }

    20% {
      transform: translate(-70%, 0);
      color: red;
    }

    50% {
      transform: translate(40%, 0);
      color: red;
    }

    70% {
      transform: translate(-70%, 0);
      color: blue;
    }

    100% {
      transform: translate(0%, 0);
      color: red;
    }
  }

  .error {
    color: white;
    width: 100%;
    background-color: darkred;
    text-align: center
  }
  
  .footer {
    width: 100%;
    height: 30px;
    margin-left: 0px;
    margin-right: -10px;
    margin-bottom: -10px;
    background-color: black;
  }

  /*-----------------Viewport less than or equal to 520px----------------*/

  @media (max-width: 520px) {
    .img {
      width: 250px;
      height: 250px;
      margin-left: 22%;

    }
    button{
        width:auto;
    }
  }
</style>

<body>
  <div class="container">
    <?php

    include "../connection.php";

    $duration = "";

    //$current_user_id = $_SESSION['userid'];

    $new_trans_id = $_SESSION['newuser'];

   // echo $new_trans_id;

    $res = mysqli_query($conn, "SELECT * FROM payment WHERE id ='$new_trans_id' ");

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

      //echo "<a href='../index1.php'  style='color:green;font-size:15px;margin-left:40%;text-decoration:none'>MAKE PAYMENT</a>";

      $query1 = "UPDATE payment  SET userstatus ='Expired' WHERE id = $new_trans_id";
      $result1 = mysqli_query($conn, $query1) or die(mysqli_error($conn));


      $query2 = "UPDATE tbl_cv  SET userstatus ='0' WHERE transactionid = $new_trans_id";
      $result2 = mysqli_query($conn, $query2) or die(mysqli_error($conn));

      echo "<script> alert('Your Account Expired {$days_expired->days} days ago, Make a new Payment to Enjoy our services ');
          window.location='../renew/index.php'
           </script>";
    } else {
      $days_left = date_diff($due, $today);

      //echo "<div class='life'>Your Account is Active for another {$days_left->days} days.</div>";
      echo ' ';
    }
    ?>

    <?php include '../header.php' ?>

    <progress id="progressBar" value="40" max="100" style="width:420px;height:15px;"></progress>
    <h6 id="status" style="color:red">Phase 4 of 10</h6>


    <hr>

    <div class="title">
      <div class="center">
        <a href="index.php"><button id="header" class="btn  btn-xs" style="width:200px">Education Background</button></a>
      </div>
      <br>
    </div>
 <!-- Button trigger modal -->
            <div style="text-align:right">
              <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fa fa-phone fa-plus"></i> Add
              </button>
            </div>
    <div class="table-responsive" id="user_data">
      <?php
      $new_trans_id = $_SESSION['newuser'];
      //echo $new_trans_id;
      $res11 = mysqli_query($conn, "SELECT * FROM payment WHERE id ='$new_trans_id'");

      while ($row11 = mysqli_fetch_array($res11)) {

        $status = $row11['userstatus'];
        $type = $row11['package_type'];
      }
      //echo $status;
      

      ?>
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Year From</th>
            <th>Year To</th>
            <th>Education Level</th>
            <th>Achievement</th>
            <!-- print action after user status confirmed-->
            <?php if ($status == 'Paid') : ?>
              <th>Action</th>
            <?php endif ?>

           


          </tr>
        </thead>
        <!-- notify when no data-->
        <?php if (mysqli_num_rows($result) > 0) : ?>
          <?php

          while ($row = $result->fetch_assoc()) :
          ?>
            <?php $id = $row["id"] ?>
            <tr>


              <!--get auto increment id-->
              <td style="height:auto"><?php echo $id ?></td>
              <td style="height:auto"><?php echo $row["yearfrom"]; ?></td>
              <td><?php echo $row["yearto"]; ?></td>
              <td style="height:auto"><?php echo $row["educationlevel"]; ?></td>
              <td><?php echo $row["achievement"]; ?></td>

              <!-- check for user status-->
              <?php if ($status == 'Paid') : ?>
                <td><a href="../functions/edit_education.php?id=<?php echo $id; ?>" style="color:blue !important">
                    <i class="fa fa-edit"></i>Edit</a></td>
                <td><a href="../functions/delete_education.php?id=<?php echo $id; ?>"onclick="return confirm('Are you sure you want to delete this Data?');" style="color:red !important"><i class="fa fa-phone fa-trash"></i>Delete</a></td>
              <?php endif ?>

            </tr>

          <?php endwhile; ?>
          <!--end if notify when no data-->
        <?php else : ?>
          <div style="color:red"><?= "No data found" ?></div>
        <?php endif ?>


      </table>

    </div>

    <!--Education Background Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa fa-graduation-cap" aria-hidden="true"></i> Education Background</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <form action="education.php" method="POST">
            <div class="modal-body">
              <p style="color:red">***NOTE:Enter your Education Background from the lowest level to the Highest Level.</p>
              <label> Year From :</label> <input id="yearfrom" name="yearfrom" class="form-control" placeholder="Enter start year(1990)" required>

              <br>
              <label>Year To :</label> <input id="yearto" name="yearto" class="form-control" placeholder="Enter end year(1998)" required>

              <br>
              <label> School/College/University :</label> <input id="educationlevel" name="educationlevel" class="form-control" placeholder="Enter your education level(school,college,university)" required>

              <br>
              <label>Achievement :</label> <input id="achievement" name="achievement" class="form-control" placeholder="Enter your achievment(i.e Pass,A)" required>

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
    <!-- End Education Background Modal -->

   


    <div style="text-align:center">


      <a href="../job/index.php"><button class="btn btn-success btn-xs" style="width:auto"> <i class="fa fa-briefcase" aria-hidden="true"></i> Job Experience</button></a>
    </div>


    <div class="footer"><?php include_once "../footer.php" ?></div>
  </div>

  <?php
  $new_trans_id = $_SESSION['newuser'];
  //echo $new_trans_id;
  $status = '';
  $type = '';

  $res1 = mysqli_query($conn, "SELECT * FROM payment WHERE id ='$new_trans_id'");

  while ($row1 = mysqli_fetch_array($res1)) {

    $status = $row1['userstatus'];
    $type = $row1['package_type'];
  }
  //echo $status;
  //echo $type;
  //echo $new_trans_id;
  if ($status == 'Free') {
    include "../advert.php";
  } else {
    include "../no_advert.php";
  }

  ?>


  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>

</body>

</html>