<?php
include('connection/config.php');
if(!isset($_SESSION))
{
	session_start();
}
//$emailto=$_SESSION['email'];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


$mail = new PHPMailer(true);
$adds=$emailto;

// $_POST["f_id"];
// $_POST["dep_id"];
// $_POST["r_from"];
// $_POST["r_to"];

$sqlview="SELECT email from user where role_id='R01'";
 $result=mysqli_query($con,$sqlview) or die("@error in view part:".mysqli_error($con));

 while ($row=mysqli_fetch_array($result)) {
    $mail->AddCC ($row['email']);
}

try {
 
                  
    $mail->isSMTP();                                           
    $mail->Host       = 'smtp.gmail.com';                     
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = 'demoeusl@gmail.com';                    
    $mail->Password   = 'taniyhwtbhtkozin';                             
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
    $mail->Port       = 465;                                    

  
    $mail->setFrom($adds, 'Virtual Advanced Reservation System');
    $mail->addAddress ($emailto);
    //$mail->addAddress('hajeevans@esn.ac.lk');             
    

    $mail->isHTML(true);                                 
    //$mail->Subject = 'Here is the subject'.time();
	$mail->Subject = 'Your Reservation has been confirmed';
   // $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
   include('tbl2.php');
	 $mail->Body    = $aa;
    $mail->AltBody = 'You will get confirmation when Admin accept your request';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}