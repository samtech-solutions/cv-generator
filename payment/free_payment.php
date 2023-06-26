<?php
include "../connection.php";

session_start();

$current_user_id = $_SESSION['user'];
//echo $current_user_id;
$query = "SELECT * FROM payment WHERE usertoken='$current_user_id'";

$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>cv plus resume generator</title>
    <link href="css/jquery-ui.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
    <link href="css/styles2.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" media="all" />
    <link rel="stylesheet" type="text/css" href="../fonts/css/all.css" media="all" />
    <script src="external/jquery/jquery.js"></script>
    <script src="js/jquery-ui.js"></script>

    <script src="jsPDF/dist/jspdf.min.js"></script>

</head>
<style>
    .logo {
        margin-top: -30px;
        width: auto;
        height: 150px;
    }

    .logo1 {
        margin-top: -30px;
        width: auto;
        height: 100px;
    }

    .img {
        width: 250px;
        height: 250px;
        margin-left: 36%;
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
    <div id="container" style="background-color:rgb(246, 239, 239);width:100%;height:660px">
        <h3 align="center"><img src="images/cv-logo.jpg" class="logo"></h3>

        <br><br>
        <div class="img"><img src="images/mpesa-globalpay.jpg" class="logo"></div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="margin-left:40%;margin-top:-25%">Proceed To Payment</button>
    </div>


    <!-- Modal for Starter Package Version -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Trial Package Version</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="confirm_free_payment.php" method="POST">
                    <div class="modal-body">
                        <?php
                        while ($row = $result->fetch_assoc()) :
                            $_SESSION['userid'] = $row['id'];
                        ?>
                            <p style="color:blue">You have Choosen <b><?php echo $row['payment_plan'] ?></b> plan</p>
                            <br>
                            <h3 align="center"><img src="images/mpesa.jpg" class="logo1"></h3>
                            <!--<p>Go to Mpesa Menu</p>
                            <p>Go to Lipa na Mpesa</p>
                            <p>Go to PayBill </p>
                            <p>Enter Business no. <b>714 777</b></p>
                            <p>Enter Account no. <b>0716660942</b></p>-->
                            <h3>Amount to Pay <b><?php echo $row['amount'] ?> </b> Ksh</h3>

                        <?php endwhile; ?>

                        <label style="color:blue"><b>Enter Mpesa Confirmation Code : </b></label>
                        <input type="text" id="code" value="FREETRIAL" name="code" sytle="text-transform:uppercase" disabled>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> <i class="fa fa-times" aria-hidden="true"></i> Close</button>
                        <button type="submit" name="confirm" id="confirm" class="btn btn-info" data-toggle="modal" data-target="#exampleModal"> <i class="fa fa-save" aria-hidden="true"></i> Confirm Payment</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
    <!-- end modal-->

    <script src="js/custom.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
</body>

</html>