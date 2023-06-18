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
        $query_edit = "SELECT * FROM jobexperience WHERE id='$id'";

        $result_edit = mysqli_query($conn, $query_edit) or die(mysqli_error($conn));
        $user_record = mysqli_fetch_assoc($result_edit);

        if (isset($_POST['update'])) {
            //get updated form data
            $id = ($_GET['id']);


            $yearfrom = filter_var($_POST['yearfrom'], FILTER_SANITIZE_NUMBER_INT);
            $yearto = filter_var($_POST['yearto'], FILTER_SANITIZE_NUMBER_INT);

            $jobtitle = ($_POST['jobtitle']);
            $responsibility = ($_POST['responsibility']);
            //check valid inputs
            if (!$yearfrom || !$yearto) {
                echo "<script>alert('Number value required for year from');
				location.href='../job/index.php';</script>";
            } else {
                $query_update = "UPDATE jobexperience SET yearfrom='$yearfrom',yearto='$yearto',
                          jobtitle='$jobtitle', responsibility ='$responsibility ' WHERE id='$id' ";
                $update_result = mysqli_query($conn, $query_update) or die(mysqli_error($conn));


                //echo "<script>alert('DATA SUCCESSFULLY SAVED!!!');
                //location.href='../education/index.php';</script>";
                echo "<script>window.location='update_job_loader.php';</script>";
            }
        }
    }
    ?>

    <!--Education Background Modal for edit button -->

    <div class="container" style="width:40%;text-align:left;margin-left:25%">
        <p style="color:blue;margin-top:20px;"> Update Job Experience</p>

        <form action="" method="POST">


            <div class="content">


                <label> Year From :</label> <input id="yearfrom" value="<?= $user_record['yearfrom'] ?>" name="yearfrom" class="form-control" placeholder="Enter start year(1990)" required>

                <br>
                <label>Year To :</label> <input id="yearto" value="<?= $user_record['yearto'] ?>" name="yearto" class="form-control" placeholder="Enter end year(1998)" required>

                <br>
                <label> Job Title :</label> <input id="jobtitle" value="<?= $user_record['jobtitle'] ?>" name="jobtitle" class="form-control" placeholder="Enter your Job Title(Teacher,Driver)" required>

                <br>
                <label>Responsibility :</label> <input id="responsibility" value="<?= $user_record['responsibility'] ?>" name="responsibility" class="form-control" placeholder="Enter your Responsibility(i.e Driving)" required>

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