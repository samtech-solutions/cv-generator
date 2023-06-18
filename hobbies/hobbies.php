<?php
include "../connection.php";
session_start();
 if (isset($_POST['save'])) {
	$userid =$_SESSION['user-id'];

    $name= filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  
    $query="INSERT INTO hobbies(userid,name) 
               VALUES ('$userid','$name')";
    $result = mysqli_query($conn , $query) or die(mysqli_error($conn));

    if (mysqli_affected_rows($conn) > 0) { 
        //echo "<script>alert('DATA SUCCESSFULLY SAVED!!!');
       // location.href='../hobbies/index.php';</script>";
		echo "<script>window.location='loader.php';</script>";
   }else{
	    echo "<script>alert('DATA NOT SAVED!!!');
        ;</script>";
   }
 }
?>
