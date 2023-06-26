

<?php
require 'connection.php';
session_start();
$time =  $_SESSION['time_in'];

$user_id = $_SESSION["user-id"];

//save user login time

$time_out = date("Y-m-d H:i:s");

$query_time_out = "UPDATE logs SET time_out ='$time_out' WHERE time_in ='$time' && userid ='$user_id'";

$result_time_out = mysqli_query($conn,  $query_time_out) or die(mysqli_error($conn));
if ($result_time_out > 0) {

  echo "<script>window.location='logout.php';</script>";
} else {
  echo '';
}
?>