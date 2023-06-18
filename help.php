<?php
$email = $_POST['email'];
$subject = "User enqury and help request";
$mess = $_POST['message'];

$message = "Email: <b> $email  </b><br><br>
            Message :  $mess <br><br>";

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

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
    $mail->Username   = 'isamdevelopers@gmail.com';             //SMTP username
    $mail->Password   = 'ovchjyrxinbkqffk';                     //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('from@example.com', 'Isam Developers');
    $mail->addAddress('isamdevelopers@gmail.com');              //Add a recipient
   

    //Attachments
   // $mail->addAttachment('profile.jpg');                        //Add attachments
   //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');          //Optional name

    //Content
    $mail->isHTML(true);                                        //Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $message;
    $mail->AltBody = 'User Feedback';

    $mail->send();
    echo 'Message has been sent';
    header('location: feedback_loader.php');
					exit();
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    
   // header('location: feedback_loader.php');
    exit();
}



?>