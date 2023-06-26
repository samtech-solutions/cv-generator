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
        $query_edit = "SELECT * FROM hobbies WHERE id='$id'";

        $result_edit = mysqli_query($conn, $query_edit) or die(mysqli_error($conn));
        $user_record = mysqli_fetch_assoc($result_edit);

        if (isset($_POST['update'])) {
            //get updated form data
            $id = ($_GET['id']);

            $hobby = ($_POST['name']);



            //check valid inputs
            if (!$hobby) {
                echo "<script>alert('Please enter valid information');
				location.href='../hobbies/index.php';</script>";
            } else {
                $query_update = "UPDATE hobbies SET name='$hobby' WHERE id='$id' ";
                $update_result = mysqli_query($conn, $query_update) or die(mysqli_error($conn));


                //echo "<script>alert('DATA SUCCESSFULLY SAVED!!!');
                //location.href='../hobbies/index.php';</script>";
                echo "<script>window.location='update_hobby_loader.php';</script>";
            }
        }
    }
    ?>

    <!--Education Background Modal for edit button -->

    <div class="container" style="width:40%;text-align:left;margin-left:25%">
        <p style="color:blue;margin-top:20px;"> Update Hobby</p>

        <form action="" method="POST">


            <div class="content">


                <label> Hobby :</label> <input id="name" name="name" value="<?= $user_record['name'] ?>" class="form-control" placeholder="Enter your Hobby" required>

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