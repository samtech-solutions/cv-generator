
<?php
session_start();
$current_user_id = $_SESSION["user-id"];
$new_trans_id = $_SESSION['newuser'];
//echo $new_trans_id ;
//echo $current_user_id ;
include "../connection.php";


if (isset($_POST['save'])) {
    $usertoken = 'renew-' . rand(1000, 99999);
    $userstatus = "0";
    $payment_plan = $_POST['starter'];
   
    
    if ($_POST['starter'] == "Monthly") {
         $package_type = 'Starter';
		$amount = 100;
        $life_duration = 30;
		
    } elseif($_POST['starter'] == "Yearlystarter") {
         $package_type = 'Yearlystarter';
		$amount = 1200;
        $life_duration = 365;
    }else {
        $package_type = 'Yearlyprofessional';
		$amount = 3000;
        $life_duration = 365;
    }
    
     if($payment_plan == ""){
        echo "<script> alert('Please choose a plan');
           window.location='../renew/index.php'
           </script>";
     }else{
        

        $query = "UPDATE payment  SET usertoken ='$usertoken',userstatus ='$userstatus',package_type ='$package_type',
        payment_plan='$payment_plan',amount='$amount',life_duration='$life_duration' WHERE id ='$new_trans_id' ";
        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
        
       
      $query2 = "UPDATE tbl_cv  SET userstatus ='1' WHERE transactionid = $new_trans_id";
      $result2 = mysqli_query($conn, $query2) or die(mysqli_error($conn));


        if (mysqli_affected_rows($conn) > 0) {
        //echo "<script>alert('DATA SUCCESSFULLY SAVED!!!');
        //location.href='index.php';</script>";

        $_SESSION['user'] = $usertoken;

        echo "<script>window.location='loader.php';</script>";
        } else {
        echo "<script>alert('DATA NOT SAVED!!!');
        ;</script>";
        }
     }   

    
}
