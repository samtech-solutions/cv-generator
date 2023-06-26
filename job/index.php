<?php
include "../connection.php";

session_start();

$current_user_id = $_SESSION['user-id'];

$query = "SELECT * FROM jobexperience WHERE userid='$current_user_id'";

$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>cv+ resume</title>
  <link href="../css/jquery-ui.css" rel="stylesheet">
  <link href="../css/style.css" rel="stylesheet">
  <link href="../css2/css/styles2.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../fonts/css/all.css" media="all" />
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" media="all" />
  <script src="../external/jquery/jquery.js"></script>


</head>
<style>
  .center {
    margin-left: 100px;
  }
.table-responsive{
    height:160px;
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
    margin-top: 5px;
    width: auto;
    height: 80px;
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
    .btn{
        width:auto;
    }
  }
</style>

<body>

  <div class="container">
    <?php include '../header.php' ?>
    <progress id="progressBar" value="50" max="100" style="width:420px;height:15px;"></progress>
    <h6 id="status">Phase 5 of 10</h6>

    <hr>

    <div class="title">
      <div class="cente">

        <a href="index.php"><button class="btn  btn-xs" style="width:auto">Job Experience Information</button></a>
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
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Year From</th>
            <th>Year To</th>
            <th>Job Title</th>
            <th>Responsibility</th>
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
               <!-- get  id-->
               <td style="height:auto"><?php echo $id ?></td>
              <td style="height:auto"><?php echo $row['yearfrom']; ?></td>
              <td><?php echo $row['yearto']; ?></td>
              <td style="height:auto"><?php echo $row['jobtitle']; ?></td>
              <td><?php echo $row['responsibility']; ?></td>
              <!-- check for user status-->
              <?php if ($status == 'Paid') : ?>
                <td><a href="../functions/edit_job.php?id=<?php echo $id; ?>" style="color:blue !important">
                    <i class="fa fa-edit"></i>Edit</a></td>
                <td><a href="../functions/delete_job.php?id=<?php echo $id; ?>" onclick="return confirm('Are you sure you want to Delete this Data?');" style="color:red !important"><i class="fa fa-phone fa-trash"></i>Delete</a></td>
              <?php endif ?>

            </tr>
          <?php endwhile; ?>

          <!--end if notify when no data-->
        <?php else : ?>
          <div style="color:red"><?= "No data found" ?></div>
        <?php endif ?>

      </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa fa-briefcase" aria-hidden="true"></i>Job Experience Information</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <form action="jobexperience.php" method="POST">
            <div class="modal-body">
              <p style="color:red">***NOTE:Enter your Job Experience Information from the lowest level to the Highest Level.</p>
              <label> Year From :</label> <input id="yearfrom" name="yearfrom" class="form-control" placeholder="Enter start year(1990)" required>

              <br>
              <label>Year To :</label> <input id="yearto" name="yearto" class="form-control" placeholder="Enter end year(1998)" required>

              <br>
              <label> Job Title :</label> <input id="jobtitle" name="jobtitle" class="form-control" placeholder="Enter your Job Title(Teacher,Driver)" required>

              <br>
              <label>Responsibility :</label> <input id="responsibility" name="responsibility" class="form-control" placeholder="Enter your Responsibility(i.e Driving)" required>

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


    <div style="text-align:center">
      <a href="../skills/index.php"><button class="btn btn-success btn-xs"> <i class="fa fa-plane" aria-hidden="true"></i> Skills</button></a>
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