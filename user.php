<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include "connection.php";
session_start();
if (isset($_POST['user'])) {

	$current_user_id = $_SESSION['userid'];

	//echo  $current_user_id;

	$firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	$middlename = filter_var($_POST['middlename'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	$lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	$idno = filter_var($_POST['idno'], FILTER_SANITIZE_NUMBER_INT);
	$yob = filter_var($_POST['yob'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
	$gender = filter_var($_POST['gender'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	$personalprofile = filter_var($_POST['personalprofile'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	$careerobjectives = filter_var($_POST['careerobjectives'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	$phone1 = filter_var($_POST['phone1'], FILTER_SANITIZE_NUMBER_INT);
	$phone2 = filter_var($_POST['phone2'], FILTER_SANITIZE_NUMBER_INT);
	$address1 = filter_var($_POST['address1'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	$address2 = filter_var($_POST['address2'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

	$avatar = 'profile1.png';
	$userstatus = "1";
	$code = rand(999999, 111111);
	$status = "notverified";

	if (!$email) {
		echo "<script>alert('Email Address Required');
				location.href='index.php';</script>";
	} elseif (strlen($idno) < 5) {
		echo "<script>alert('Id Number must be 5 numbers or more');
				location.href='index.php';</script>";
	} else {

		//fetch user from database
		$fetch_user_query = "SELECT * FROM tbl_cv WHERE email='$email' OR idno='$password' AND userstatus = '1'";
		$fetch_user_result = mysqli_query($conn, $fetch_user_query);


		if (mysqli_num_rows($fetch_user_result) > 0) {
			//check whether user is registered
			//convert the record into assoc array
			$user_record = mysqli_fetch_assoc($fetch_user_result);
			$_SESSION['password'] = $user_record['idno'];
			$_SESSION['email'] = $user_record['email'];
			$_SESSION['transactionid'] = $user_record['transactionid'];

			$db_password = $_SESSION['password'];
			$db_email = $_SESSION['email'];
			$db_transactionid = $_SESSION['transactionid'];

			if ($db_transactionid == "0") {
				echo "<script>alert('Email or Username Already exits');
				location.href='index.php';</script>";
				
			} else {

				// echo $db_transactionid;
				//count number of transaction id and check user subscription
				$fetch_user_subscription = "SELECT * FROM tbl_cv WHERE  transactionid =$db_transactionid";
				$fetch_user_subscription_result = mysqli_query($conn, $fetch_user_subscription);

				$row = mysqli_num_rows($fetch_user_subscription_result);
				//echo $row;
				//get transaction id userstatus and account type
				$fetch_user_account = "SELECT * FROM payment WHERE  id =$db_transactionid";
				$fetch_user_account_result = mysqli_query($conn, $fetch_user_account);
				if (mysqli_num_rows($fetch_user_account_result) > 0) {
					$user_account = mysqli_fetch_assoc($fetch_user_account_result);
					$account_type = $user_account['package_type'];
					//echo $account_type;
					$limit = '';

					if ($account_type == 'Starter' && $row >= 50) {
						$limit = 50;
						$balance = $limit - $row;
						echo "<script>alert('Maximum Limit Is $limit Account. Account left $balance, Choose a different Package');
									location.href='index1.php';</script>";
					} elseif ($account_type == 'Trial' && $row == 1) {
						$limit = 1;
						echo "<script>alert('Maximum Limit Is $limit Account.Choose a different Package');
									location.href='index1.php';</script>";
					} elseif ($account_type == 'professional' && $row >= 500) {
						$limit = 500;
						echo "<script>alert('Maximum Limit Is $limit Account.Choose a different Package');
									location.href='index1.php';</script>";
					} else {

						echo "<script>alert 'Invalid package type';</script>";
					}
				} else {

					echo "<script>window.location='index1.php';</script>";
				}
				echo "<script>window.location='userloader.php';</script>";
			}
		} else {

			$query = "INSERT INTO tbl_cv (transactionid,userstatus,firstname,middlename,lastname,idno,yob,email,gender,personalprofile,careerobjectives,phone1,phone2,address1,address2,avatar,code,status) 
					VALUES ('$current_user_id','$userstatus','$firstname','$middlename','$lastname','$idno','$yob','$email','$gender','$personalprofile','$careerobjectives','$phone1','$phone2','$address1','$address2','$avatar','$code','$status')";
			$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

			if ($result) {
				$first_name = $firstname;
				$subject = "Email Verification Code";
				$username = $email;

				$message = "Hi $first_name ,<br><br>
							Thank you for joining CV plus Generator system! <br><br>
							We have created an account for you,<br><br>
							login with the details listed below :<br> <br> 
				
							Username : <b> $username </b><br><br>
							Password : <b> $idno</b><br><br>
							
							Use the code below to confirm your Email address.<br><br>

							Your Verification code is <b> $code </b><br><br>
							
							Regards,<br>
							
							iSam Developers Team<br><br>";
				$sender = "From: isamdevelopers@gmail.com";

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
					$mail->Username   = $sender;             //SMTP username
					$mail->Password   = 'ovchjyrxinbkqffk';                     //SMTP password
					$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
					$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

					//Recipients
					$mail->setFrom('from@example.com', 'iSam Developers');
					$mail->addAddress($email);              //Add a recipient


					//Attachments
					$mail->addAttachment('images/cv-logo.jpg');                        //Add attachments
					//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');          //Optional name

					$message = $message;
					//Content
					$mail->isHTML(true);                                        //Set email format to HTML
					$mail->Subject = $subject;
					$mail->Body    = $message;
					$mail->AltBody = 'mail clients';

					$mail->send();
					//echo "<script>alert('Verfication code has been sent to $email')</script>";
					$info = "Verification code sent to your email";
					$_SESSION['info'] = $info;
					$_SESSION['email'] = $email;

					header('location: signup/loader1.php');
					exit();
				} catch (Exception $e) {
					//echo "Verification Code could not be sent. Mailer Error: {$mail->ErrorInfo}";
					$infomessage = "Verification Code could not be sent";
					$_SESSION['infomessage'] = $infomessage;
					$_SESSION['email'] = $email;

					header('location: signup/loader2.php');
					exit();
				}
			} else {
				echo "<script>alert('Failed while inserting data into database!');</script>";
			}
		}
	}
}
