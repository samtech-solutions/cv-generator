<?php
include "../connection.php";
session_start();

 if (isset($_POST['save'])) {
	$userid =$_SESSION['user-id'];
    $yearfrom =$_POST['yearfrom'];
    $yearto =$_POST['yearto'];
	$jobtitle =$_POST['jobtitle'];
    $responsibility =$_POST['responsibility'];
  
    $query="INSERT INTO jobexperience(userid,yearfrom,yearto,jobtitle,responsibility) 
               VALUES ('$userid','$yearfrom','$yearto','$jobtitle','$responsibility')";
    $result = mysqli_query($conn , $query) or die(mysqli_error($conn));

    if (mysqli_affected_rows($conn) > 0) { 
        //echo "<script>alert('DATA SUCCESSFULLY SAVED!!!');
        //location.href='../job/index.php';</script>";
		echo "<script>window.location='loader.php';</script>";
   }else{
	    echo "<script>alert('DATA NOT SAVED!!!');
        ;</script>";
   }
 }
?>
