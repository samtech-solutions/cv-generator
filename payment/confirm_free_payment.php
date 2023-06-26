<?php

include "../connection.php";
session_start();

if (isset($_POST['confirm'])) {

    $current_user_id = $_SESSION['userid'];

    //echo $current_user_id;

    $userstatus = "Free";

    $confirmmation_code = "FREETRIAL";

    $date_paid = date("Y-m-d H:i:s");

    if ($confirmmation_code == "") {
        echo "<script> alert('Please Enter a Valid Mpesa Confirmation Code');
           window.location='free_payment.php'
           </script>";
    } else {
       
        $query = "UPDATE payment  SET userstatus ='Free', mpesa_code='$confirmmation_code', date_paid = '$date_paid' WHERE id = $current_user_id";
        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
       
        if (mysqli_affected_rows($conn) > 0) {
            //echo "<script>alert('DATA SUCCESSFULLY SAVED!!!');
            //location.href='index.php';</script>";
            echo "<script>window.location='loader01.php';</script>";
        } else {
            echo "<script>alert('DATA NOT SAVED!!!');
            ;</script>";
        }
    }
}
