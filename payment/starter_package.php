<?php

include "../connection.php";
session_start();

if (isset($_POST['save'])) {
    $usertoken = 'startoken-' . rand(1000, 99999);
    $userstatus = "New";

    $payment_plan = $_POST['starter'];
    $package_type = 'Starter';

    if ($_POST['starter'] == "Monthly") {
        $amount = 100;
        $life_duration = 30;
    } else {
        $amount = 1200;
        $life_duration = 365;
    }
     if($payment_plan == ""){
        echo "<script> alert('Please choose a plan');
           window.location='../index1.php'
           </script>";
     }else{
        

        $query = "INSERT INTO payment (usertoken,userstatus,package_type,payment_plan,amount,life_duration) 
        VALUES ('$usertoken','$userstatus','$package_type','$payment_plan','$amount',$life_duration)";
        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
        
       

        if (mysqli_affected_rows($conn) > 0) {
        //echo "<script>alert('DATA SUCCESSFULLY SAVED!!!');
        //location.href='index.php';</script>";

        $_SESSION['user'] = $usertoken;

        echo "<script>window.location='loader.php';</script>";
        } else {
        echo "<script>alert('DATA NOT SAVED!!!');
        ;</script>";
        }
     }   

    
}
