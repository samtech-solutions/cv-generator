<?php

include "../connection.php";
session_start();


if (isset($_POST['save'])) {
    $payment_plan = filter_var($_POST['free'], FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? null;
    $usertoken = 'trialtoken-' . rand(1000, 99999);
    $userstatus = "Trial";
    $package_type = 'Trial';
    $amount = 00;
    $life_duration = 14;
    if (!$payment_plan) {


        echo "<script> alert('Please choose a plan');
        window.location='../index1.php'
        </script>";
    
        
        
    } else {
        $query = "INSERT INTO payment (usertoken,userstatus,package_type,payment_plan,amount,life_duration) 
               VALUES ('$usertoken','$userstatus','$package_type','$payment_plan','$amount',$life_duration)";
        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

        if (mysqli_affected_rows($conn) > 0) {
            $_SESSION['user'] = $usertoken;
            echo "<script>window.location='loader0.php';</script>";
        } else {
            echo "<script>alert('DATA NOT SAVED!!!');
        ;</script>";
        }
    }
  
}
