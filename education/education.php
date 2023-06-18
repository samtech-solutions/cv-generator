<?php

include "../connection.php";
session_start();

if (isset($_POST['save'])) {

    $userid = $_SESSION['user-id'];

    $yearfrom = filter_var($_POST['yearfrom'], FILTER_SANITIZE_NUMBER_INT);
    $yearto = filter_var($_POST['yearto'], FILTER_SANITIZE_NUMBER_INT);
    
    $educationlevel = filter_var($_POST['educationlevel'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $achievement = filter_var($_POST['achievement'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);


    if (strlen($yearfrom) < 4 || (strlen($yearto) < 4)) {
        echo "<script>alert('Number value required for year from');
				location.href='index.php';</script>";
    } elseif (!$educationlevel) {
        echo "<script>alert('Education Level required');
				location.href='index.php';</script>";
    } else {


        $query = "INSERT INTO education(userid,yearfrom,yearto,educationlevel,achievement) 
                    VALUES ('$userid','$yearfrom','$yearto','$educationlevel','$achievement')";
        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

        if (mysqli_affected_rows($conn) > 0) {
            //echo "<script>alert('DATA SUCCESSFULLY SAVED!!!');
            //location.href='index.php';</script>";
            echo "<script>window.location='loader.php';</script>";
        } else {
            echo "<script>alert('DATA NOT SAVED!!!');
                ;</script>";
        }
    }
}
