<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    //get form data
    $username_email = filter_var($_POST['username_email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_var($_POST['idno'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (!$username_email) {
        $_SESSION['signin'] = "Email Address Required";
    } elseif (!$password) {
        $_SESSION['signin'] = "Password Required";
    } else {

        //fetch user from database
        $fetch_user_query = "SELECT * FROM tbl_cv WHERE email='$username_email' AND idno='$password'";
        $fetch_user_result = mysqli_query($conn, $fetch_user_query);

        if (mysqli_num_rows($fetch_user_result) >0) {
            //convert the record into assoc array
            $user_record = mysqli_fetch_assoc($fetch_user_result);
            $db_password = $user_record['idno'];
            $transid = $user_record['transactionid'];
            //compare password
            if (password_verify($password, $db_password)) {
                //set session for access control

                $status = $user_record['status'];
                echo $status;
                if ($status == 'verified') {
                   
                    $_SESSION['user-id'] = $user_record['userid'];
                    $_SESSION['password'] = $password;
                    //log user in

                    //header('location: ' . ROOT_URL . '../education/index.php');

                    //echo "<script>window.location='../loader.php';</script>";
                    //echo $_SESSION['newuser'];
                    $_SESSION['newuser'] = $transid;
                } else {
                    $info = "You have not verified your Email";
                    $_SESSION['info'] = $info;
                    header('location: ../user-otp.php');
                }
            } else {
                //set session for access control
                
                $status = $user_record['status'];
                if ($status == 'verified') {
                    $_SESSION['user-id'] = $user_record['userid'];
                     $userid =$_SESSION['user-id'] ;
                    //log user in
                     //echo $_SESSION['newuser'];
                      $_SESSION['newuser'] = $transid;
                    //header('location: ' . ROOT_URL . '../education/index.php');
                       
                     //save user login time
					    //000000 means user active
					 $time_in = date("Y-m-d H:i:s");
					 $time_out ="1";
					 $query_time = "INSERT INTO logs (userid,time_in,time_out) 
					VALUES ('$userid','$time_in','$time_out')";
			          $result_time = mysqli_query($conn,  $query_time) or die(mysqli_error($conn));
                      
                      if ($result_time > 0) {
                        //echo $time_in;
                        $_SESSION['time_in'] =$time_in;
                        echo "<script>window.location='loader.php';</script>";
                      }else{
                        echo '';
                      }
                    
                    //$_SESSION['signin'] = "Please check your input data";
                } else {
                    $info = "You have not verified your Email";
                    $_SESSION['info'] = $info;
                    header('location: ../user-otp.php');
                }
            }
        } else {
            echo "<script>window.location='loader3.php';</script>";
        }
    }
    //if any problem
    if (isset($_SESSION['signin'])) {
        $_SESSION['signin-data'] = $_POST;
        header('location: ' . ROOT_URL . 'signin.php');
        die();
    }
} else {
    header('location: ' . ROOT_URL . 'signin.php');
    die();
}
