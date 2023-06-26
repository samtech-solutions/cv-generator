<?php
include "../connection.php";

session_start();

$current_user_id = $_SESSION['user-id'];

$sql = "SELECT * FROM documents WHERE userid='$current_user_id' ORDER BY id DESC";
$images = "";


$res = mysqli_query($conn, $sql);

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
  .document {
    text-align: left;
    background: white;
    margin-top: 0px;
    padding-left: 20px;
    padding-bottom: -100px;
  }

  .alb {
    padding: 20px;
    width: 400px;
    height: 200px;
    padding-bottom: 5px;

  }

  .alb img {
    padding: 10px;
    width: 150px;
    height: 150px;
  }

  h3 {
    position: relative;
    font-size: 15px;
    color: blue;
    text-align: left;
    margin: 5px;
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
    <progress id="progressBar" value="90" max="100" style="width:420px;height:15px;"></progress>
    <h6 id="status">Phase 9 of 10</h6>

    <hr>

    <div class="title">
      <div class="center">
        <a href="index.php"><button id="header" class="btn btn-xs" style="width:auto">Document Details</button></a>
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
     
      <div class="document">
        <?php if (mysqli_num_rows($res) > 0) : ?>
          <table class="table">
            <thead>
              <tr>
                <th>#</th>

                <th>Document Name</th>
                <th>Document</th>
                <th>Generate</th>
                <!-- print action after user status confirmed-->
                <?php if ($status == 'Paid') : ?>
                  <th>Action</th>
                <?php endif ?>
              </tr>
            </thead>
            <!-- notify when no data-->


            <?php
            while ($row = $res->fetch_assoc()) :
            ?>
              <?php $id = $row["id"] ?>
              <tr>

                <!-- get  id-->
                <td style="height:auto"><?php echo $id ?></td>
                <td>
                  <h3><?php echo $row['name'] ?></h3>
                </td>
                <td><img style="height:60px;width:60px" src="uploads/<?= $row['image_url'] ?>"></td>
                <td><a href="pdf.php?id=<?= $row['userid'] ?>" onclick="return confirm('Are you sure you want to Generate/Download this PDF?');"> <i class="fa fa-file-pdf" aria-hidden="true" style="color:green"></i> PRINT PDF</a></td>
                <!-- check for user status-->
                <?php if ($status == 'Paid') : ?>

                  <td><a href="../functions/delete_document.php?id=<?php echo $id; ?>" onclick="return confirm('Are you sure you want to delete this data?');" style="color:red !important"><i class="fa fa-phone fa-trash"></i>Delete</a></td>
                <?php endif ?>

              </tr>
            <?php endwhile; ?>
            <!--end if notify when no data-->
          <?php else : ?>
            <div style="color:red"><?= "No data found" ?></div>
          <?php endif ?>
          </table>

      </div>
      <br>
      <p style="font-size:13px;color:red">CREATE PDF OF YOUR DOCUMENTS BEFORE PREVIEW AND NOTE THE NAME OF YOUR FILES('i.e 100.resume.pdf')</p>
      <hr>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa fa-file-image" aria-hidden="true"></i>Upload Your Documents</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <form action="upload.php" method="post" enctype="multipart/form-data">
            <div class="modal-body">

              <label>Document Name : </label><br>
              <select type="text" id="name" name="name" class="form-control" placeholder="Choose a document to Upload" required>

                <option value="ID Front side">ID Front side</option>
                <option value="ID Back side">ID Back side</option>
                <option value="Good Conduct">Good Conduct</option>
                <option value="Recomendation Letter">Recomendation Letter</option>
                <option value="Primary Leaving Cert">Primary Leaving Cert</option>
                <option value="Secondary Leaving Cert">Secondary Leaving Cert</option>
                <option value="College Cert">College Cert</option>
                <option value="Other Cert">Other Cert</option>
                <option value="Driving Licence">Driving Licence</option>
              </select><br>
              <p style="font-size:12px;color:red">**NOTE: Upload Scanned Documents.</p>
              <input type="file" name="my_image" class="form-control"><br>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> <i class="fa fa-times" aria-hidden="true"></i> Close</button>
              <button type="submit" name="submit" id="submit" class="btn btn-info" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-upload" aria-hidden="true"></i> Upload</button>
            </div>
          </form>

        </div>
      </div>

    </div>
    <div style="text-align:center">

      <a href="../preview/index.php"><button class="btn btn-success btn-xs" style="text-align:center"> <i class="fa fa-eye" aria-hidden="true"></i> Preview</button></a>
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