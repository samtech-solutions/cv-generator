<?php

include "connection.php";

 if (isset($_POST['user'])) {
    $firstname =$_POST['firstname'];
	$middlename =$_POST['middlename'];
    $lastname =$_POST['lastname'];
	$idno =$_POST['idno'];
	$yob =$_POST['yob'];
	$email =$_POST['email'];
	$gender =$_POST['gender'];
	$personalprofile =$_POST['personalprofile'];
	$careerobjectives =$_POST['careerobjectives'];
	$phone1 =$_POST['phone1'];
	$phone2 =$_POST['phone2'];
	$address1 =$_POST['address1'];
	$address2 =$_POST['address2'];
  
    $query="INSERT INTO tbl_cv (firstname,middlename,lastname,idno,yob,email,gender,personalprofile,careerobjectives,phone1,phone2,address1,address2) 
               VALUES ('$firstname','$middlename','$lastname','$idno','$yob','$email','$gender','$personalprofile','$careerobjectives','$phone1','$phone2','$address1','$address2')";
    $result = mysqli_query($conn , $query) or die(mysqli_error($conn));

    if (mysqli_affected_rows($conn) > 0) { 
        echo "<script>alert('DATA SUCCESSFULLY SAVED!!!');
        location.href='signup/signin.php';</script>";
   }else{
	    echo "<script>alert('DATA NOT SAVED!!!');
        ;</script>";
   }
 }
?>
