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
  <link rel="stylesheet" type="text/css" href="../fonts/css/all.css" media="all" />
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" media="all" />
  <script src="external/jquery/jquery.js"></script>

</head>
<style>
  /*---------------------style for modal edit popup-------------------*/
  body {
    background-color: rgb(246, 239, 239);
    ;
  }

  .content {
    background-color: white;
    width: 100%;
  }

  .content label {
    width: 100%;
    text-align: left;
    margin-top: 5px;
    margin-left: 30px;
    color: brown;
    font-family: 'Poppins', san-serif;
  }

  .content input {
    border: none;
    margin: 5px;
    margin-left: 10px;
    padding: 4px;
    height: 40px;
    border-radius: 5px;
    padding-left: 10px;
    width: 90%;
    background-color: bisque;
  }

  button {
    width: 130px;
    height: 40px;
    margin-top: 10px;
    margin-bottom: 5px;
  }
</style>

<body>


  <?php
  include "../connection.php";

  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // echo $id;
    $query_edit = "SELECT * FROM education WHERE id='$id'";

    $result_edit = mysqli_query($conn, $query_edit) or die(mysqli_error($conn));
    $user_record = mysqli_fetch_assoc($result_edit);

    if (isset($_POST['update'])) {
      //get updated form data
      $id = ($_GET['id']);


      $yearfrom = filter_var($_POST['yearfrom'], FILTER_SANITIZE_NUMBER_INT);
      $yearto = filter_var($_POST['yearto'], FILTER_SANITIZE_NUMBER_INT);

      $educationlevel = ($_POST['educationlevel']);
      $achievement = ($_POST['achievement']);
      //check valid inputs
      if (!$yearfrom || !$yearto) {
        echo "<script>alert('Number value required for year from');
				location.href='../education/index.php';</script>";
      } else {
        $query_update = "UPDATE education SET yearfrom='$yearfrom',yearto='$yearto',
                          educationlevel='$educationlevel', achievement='$achievement' WHERE id='$id' ";
        $update_result = mysqli_query($conn, $query_update) or die(mysqli_error($conn));


        //echo "<script>alert('DATA SUCCESSFULLY SAVED!!!');
        //location.href='../education/index.php';</script>";
        echo "<script>window.location='update_loader.php';</script>";
      }
    }
  }
  ?>

  <!--Education Background Modal for edit button -->

  <div class="container" style="width:40%;text-align:left;margin-left:25%">
    <p style="color:blue;margin-top:20px;"> Update Education Background</p>

    <form action="" method="POST">


      <div class="content">

        <label> Year From :</label>
        <input id="yearfrom" name="yearfrom" value="<?= $user_record['yearfrom'] ?>" class="form-control" placeholder="Enter start year(1990)">

        <br>
        <label>Year To :</label>
        <input id="yearto" name="yearto" value="<?= $user_record['yearto'] ?>" class="form-control" placeholder="Enter end year(1998)">

        <br>
        <label> School/College/University :</label>
        <input id="educationlevel" name="educationlevel" value="<?= $user_record['educationlevel'] ?>" class="form-control" placeholder="Enter your education level(school,college,university)" required>

        <br>
        <label>Achievement :</label>
        <input id="achievement" name="achievement" value="<?= $user_record['achievement'] ?>" class="form-control" placeholder="Enter your achievment(i.e Pass,A)" required>

        <br>
        <div class="modal-footer">

          <button type="submit" name="update" id="update" class="btn btn-info">
            <i class="fa fa-refresh" aria-hidden="true"></i> Update </button>

        </div>
      </div>


    </form>
  </div>

  <!-- End of Education Background Modal for edit button -->

</body>

</html>