<?php
include "../connection.php";

session_start();

 if (isset($_POST['save'])) {
	$userid =$_SESSION['user-id'];

    $name =filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $phoneno =filter_var($_POST['phoneno'], FILTER_SANITIZE_NUMBER_INT);
	$position =filter_var($_POST['position'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $query="INSERT INTO referee(userid,name,phoneno,position) 
               VALUES ('$userid','$name','$phoneno','$position')";
    $result = mysqli_query($conn , $query) or die(mysqli_error($conn));

    if (mysqli_affected_rows($conn) > 0) { 
        //echo "<script>alert('DATA SUCCESSFULLY SAVED!!!');
        //location.href='../referee/index.php';</script>";
		echo "<script>window.location='loader.php';</script>";
   }else{
	    echo "<script>alert('DATA NOT SAVED!!!');
        ;</script>";
   }
 }
?>
