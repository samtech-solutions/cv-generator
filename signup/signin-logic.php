<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    //get form data
    $username_email = filter_var($_POST['username_email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_var($_POST['idno'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (!$username_email) {
        $_SESSION['signin'] = "Email Required";
    } elseif (!$password) {
        $_SESSION['signin'] = "Password Required";
    } else {
        //fetch user from database
        $fetch_user_query = "SELECT * FROM tbl_cv WHERE email='$username_email' AND idno='$password'";
        $fetch_user_result = mysqli_query($conn, $fetch_user_query);

        if (mysqli_num_rows($fetch_user_result) == 1) {
            //convert the record into assoc array
            $user_record = mysqli_fetch_assoc($fetch_user_result);
            $db_password = $user_record['idno'];
            //compare password
            if (password_verify($password, $db_password)) {
                //set session for access control
                $_SESSION['user-id'] = $user_record['userid'];
                //set session if user is admin
                if ($user_record['is_admin'] == 1) {
                    $_SESSION['user_is_admin'] = true;
                }
                //log user in
                //header('location: ' . ROOT_URL . '../education/index.php');
				echo "<script>window.location='../loader.php';</script>";	
            } else {
				$_SESSION['user-id'] = $user_record['userid'];
				//header('location: ' . ROOT_URL . '../education/index.php');
				echo "<script>window.location='loader.php';</script>";
                //$_SESSION['signin'] = "Please check your input data";
            }
        } else {
            $_SESSION['signin'] = "User not found";
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
