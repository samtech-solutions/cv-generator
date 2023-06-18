<?php
include "../connection.php";
session_start();

if (isset($_POST['update'])) {
    $current_user_id = $_SESSION["user-id"];
    //echo $current_user_id;

    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];

    $yob = $_POST['yob'];

   
    $phone1 = $_POST['phone1'];
    $phone2 = $_POST['phone2'];
    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'];

    //check valid updates

    $query_update = "UPDATE tbl_cv SET firstname='$firstname', middlename='$middlename',lastname='$lastname',yob='$yob'
                     ,phone1='$phone1', phone2='$phone2',address1='$address1', address2='$address2' WHERE userid='$current_user_id'";
    $update_result = mysqli_query($conn, $query_update) or die(mysqli_error($conn));

    //echo "<script>alert('DATA SUCCESSFULLY SAVED!!!');
    //location.href='../education/index.php';</script>";
    echo "<script>window.location='update_user_details_loader.php';</script>";
}
