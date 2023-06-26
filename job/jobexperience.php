<?php
include "../connection.php";
session_start();

 if (isset($_POST['save'])) {
	$userid =$_SESSION['user-id'];
    

    $yearfrom = filter_var($_POST['yearfrom'], FILTER_SANITIZE_NUMBER_INT);
    $yearto = filter_var($_POST['yearto'], FILTER_SANITIZE_NUMBER_INT);
    
	$jobtitle =filter_var($_POST['jobtitle'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $responsibility =filter_var($_POST['responsibility'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  
    
    if (strlen($yearfrom) < 4 || (strlen($yearto) < 4)) {
        echo "<script>alert('Number value required for year from');
				location.href='index.php';</script>";
    } elseif (!$jobtitle) {
        echo "<script>alert('Job Title required');
				location.href='index.php';</script>";
    } else {

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

}
?>
