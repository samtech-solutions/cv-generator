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
        width: 250px;
        height: 150px;
       
    }

    .modal-body {
        text-align: left;
    }

    label {
        text-align: left !important;
        color: green;
    }

    .logo1 {
        margin-top: -30px;
        width: auto;
        height: 100px;
    }

    .img {
        width: 150px;
        height: 150px;
        margin-left: 6%;
    }

    /*-----------------Viewport less than or equal to 520px----------------*/

    @media (max-width: 520px) {
        .img {
            width: 120px;
            height: 120px;
            margin-left: 10%;

        }
    }
</style>


<body>
    <div id="container" style="background-color:white;width:100%;height:660px">
        <h3 align="center"><img src="images/dollar-payment-logo.jpg" class="logo"></h3>

        <br><br>
        <div class="img"><img src="images/mpesa-globalpay.jpg" class="logo"></div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="margin-left:40%;margin-top:-20%">Proceed To Payment</button>
       
        <div class="img"><img src="images/paypal.png" class="logo"></div>
        
        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="##exampleModal1" style="margin-left:40%;margin-top:-20%">COMING SOON</button>
        
    </div>


    <!-- Modal for Professional Package Version mpesa payment-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">TINYPESA STK PUSH</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="confirm_proffessinal_payment.php" method="POST">
                    <div class="modal-body">
                        <?php
                        while ($row = $result->fetch_assoc()) :
                            $_SESSION['userid'] = $row['id'];
                        ?>
                            <label for="username" class="name-label">Phone number</label>
                            <br>
                            <input type="text" id="number" name="number" pattern=".*[^ ]*." placeholder="Enter Your Phone Number">
                            <br>
                            <label for="amount" class="name-label">Amount</label>
                            <br>
                            <input type="number" id="amount" name="amount" value="<?= $row['amount'] ?>" readonly>

                        <?php endwhile; ?>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> <i class="fa fa-times" aria-hidden="true"></i> Close</button>
                        <button type="submit" name="pay" id="pay" class="btn btn-info" data-toggle="modal" data-target="#exampleModal"> <i class="fa fa-save" aria-hidden="true"></i> Make Payment</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
    <!-- end modal-->
  
   <!-- Modal for Starter Package Version paypal pay-->
    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">PAYPAL PAYMENT</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="" method="POST">
                    <div class="modal-body">
                        <?php
                        $current_user_id = $_SESSION['user'];
                        //echo $current_user_id;
                        $query1 = "SELECT * FROM payment WHERE usertoken='$current_user_id'";

                        $result1 = mysqli_query($conn, $query) or die(mysqli_error($conn));
                        while ($row1 = $result1->fetch_assoc()) :
                            $_SESSION['userid'] = $row1['id'];
                            $amount = $row1['amount'] / 100;
                            
                        ?>
                            <p style="color:blue">You have Choosen <b><?php echo $row1['payment_plan'] ?></b> plan</p>

                            <p style="color:blue">Amount to Pay <b><?= $row1['amount'] / 100 ?> USD </b> plan</p>

                            <input type="hidden" name='amount' id='amount' value="<?= $row1['amount'] / 100 ?>">
                            <br>
                            <div id="paypal-payment-button">
                            </div>

                        <?php endwhile; ?>


                    </div>


                </form>

            </div>
        </div>
    </div>
    <!-- end modal-->

    <script src="https://www.paypal.com/sdk/js?client-id=AbtGy1PN6NZHyX_NC4FwcwA6Qa1Bdhu3t3vCWxsQldhZpUisz5MV0uYyRwXwzGfY_vJhtJ3D9G13cnfx"></script>

    <script src="index.js"></script>
	
    <script src="js/custom.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
</body>

</html>