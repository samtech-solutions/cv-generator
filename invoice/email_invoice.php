<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include "../connection.php";
session_start();

				$first_name = 'sammy';
				$subject = "YOUR PAYMENT INVOICE";
				$username = 'sammymaina3137@gmail.com';

				$message = "Hi $first_name ,<br><br>
							Thank you for joining CV plus Generator system! <br><br>
							We have created an account for you,<br><br>
							login with the details listed below :<br> <br> 
				
							Username : <b> $username </b><br><br>
							Password : <b> </b><br><br>
							
							Use the code below to confirm your Email address.<br><br>

							Your Verification code is <b>  </b><br><br>
							
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
					
					echo "<script>alert('Invoice Receipt has been sent to $username')</script>";
					

					header('location: loader1.php');
					exit();
				} catch (Exception $e) {
					
					echo "Invoice Receipt could not be sent. Mailer Error: {$mail->ErrorInfo}";
					

					//header('location: loader2.php');
					//exit();
				}
			
