<?php

  $servername ="localhost";
  $username ="root";
  $password = "";
  $dbname="cv+";
  
  $conn= mysqli_connect($servername,$username,$password,$dbname)or die(mysqli_error($conn));
    //echo ('connection');
  
    $firstname =$_POST['hidden_firstname'];
    $lastname =$_POST['hidden_lastname'];
    $gender =$_POST['gender'];
    $country=$_POST['country'];
     
    echo ($firstname);
    echo ($lastname);
    echo ($gender);
    echo ($country);


    $query="INSERT INTO tbl_cv (firstname,lastname,gender,country) 
               VALUES ('$firstname','$lastname','$gender','$country')";
     $result = mysqli_query($conn , $query) or die(mysqli_error($conn));

    if (mysqli_affected_rows($conn) > 0) { 
        echo "<script>alert(' YOUR CV HAS BEEN SUCCESSFULLY CREATED!!!');
        window.location.href='home.php';</script>";
   };
?>
