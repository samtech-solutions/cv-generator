<?php

include "../connection.php";
session_start();

 if (isset($_POST['save'])) {
	 
	$userid =$_SESSION['user-id'];
	
    $yearfrom =$_POST['yearfrom'];
    $yearto =$_POST['yearto'];
	$educationlevel =$_POST['educationlevel'];
    $achievement =$_POST['achievement'];
  
    $query="INSERT INTO education(userid,yearfrom,yearto,educationlevel,achievement) 
               VALUES ('$userid','$yearfrom','$yearto','$educationlevel','$achievement')";
    $result = mysqli_query($conn , $query) or die(mysqli_error($conn));

    if (mysqli_affected_rows($conn) > 0) { 
        //echo "<script>alert('DATA SUCCESSFULLY SAVED!!!');
        //location.href='index.php';</script>";
		echo "<script>window.location='loader.php';</script>";
   }else{
	    echo "<script>alert('DATA NOT SAVED!!!');
        ;</script>";
   }
 }
?>
