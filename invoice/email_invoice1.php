<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include "../connection.php";
session_start();

	$current_user_id = $_SESSION['userid'];
    $new_trans_id = $_SESSION["newuser"];
	//echo  $current_user_id;
	$query = "SELECT * FROM payment WHERE id='$new_trans_id'";
	
	echo $new_trans_id ; 
	
	$data = mysqli_query($conn, $query) or die(mysqli_error($conn));

	$row = mysqli_fetch_assoc($data);
	
    $query1 = "SELECT * FROM tbl_cv WHERE userid=20";
	
	//echo $new_trans_id ; 
	
	$data1 = mysqli_query($conn, $query1) or die(mysqli_error($conn));

	$row1 = mysqli_fetch_assoc($data1);
   
				
$Usertoken= $row['usertoken'];
$Userstatus= $row['userstatus'];
$Package_Type= $row['package_type'];
$Payment_Plan= $row['payment_plan'];
$Amount= $row['amount'];
$Payment_Code= $row['mpesa_code'];
$Life_duration= $row['life_duration'];
$Date_Paid= $row['date_paid'];

$subject = "YOUR PAYMENT INVOICE";
$username = $row1['email'];
echo $username ;
$first_name =$row1['firstname'];

$message = "Hi $first_name ,<br><br>
			Thank you for joining CV plus Generator system! <br><br>
			Here is your invoice receipt,<br><br>
			
			Receipt No : $Usertoken<br> <br> 
			
			Userstatus :  $Userstatus <br><br>
			
			Package Type : $Package_Type<br><br>
			
			Payment Plan : $Payment_Plan<br> <br> 
			
			Amount :  $Amount <br><br>
			
			Payment Code : $Payment_Code<br><br>
			
			Life duration :  $Life_duration <br><br>
			
			Date Paid : $Date_Paid<br><br>
			
			
			Regards,<br>
			
			iSam Developers Team<br><br>";
			
$sender = "From: isamdevelopers@gmail.com";
echo $message;
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
	//Server settings
	//$mail->SMTPDebug = SMTP::DEBUG_SERVER;                    //Enable verbose debug output
	$mail->isSMTP();                                            //Send using SMTP
	$mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
	$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
	$mail->Username   = $sender;                                //SMTP username
	$mail->Password   = 'ovchjyrxinbkqffk';                     //SMTP password
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
	$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

	//Recipients
	$mail->setFrom('from@example.com', 'iSam Developers');
	$mail->addAddress($username);              //Add a recipient


	//Attachments
	$mail->addAttachment('../images/cv-logo.jpg');                        //Add attachments
	//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');          //Optional name

	$message = $message;
	//Content
	$mail->isHTML(true);                                        //Set email format to HTML
	$mail->Subject = $subject;
	$mail->Body    = $message;
	$mail->AltBody = 'mail clients';

	$mail->send();
	echo "Invoice  sent to your email";
	
	
	header('location: loader1.php');
	exit();
} catch (Exception $e) {
	echo "Invoice could not be sent. Mailer Error: {$mail->ErrorInfo}";
	$infomessage = "Invoice could not be sent";
	
	//header('location: loader2.php');
	//exit();
}


