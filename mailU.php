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
//variables 
$adds=$emailto;
//$d_id=$_POST["dep_id"];
//$cc=$cc;
$setfromName="Virtual Advanced Reservation System";
//$subject=$subject;
//$AltBody="You will get confirmation when Admin accept your request";
//$emailHtmlcontent="tbl.php";
   // $sqlview="SELECT d_email from tbl_department where d_id='$d_id'";
    // $result=mysqli_query($con,$sqlview) or die("@error in view part:".mysqli_error($con));

//  while ($row=mysqli_fetch_array($result)) {
//     $mail->AddCC ($row['email']);
// }
     //$row=mysqli_fetch_array($result);

$mail->AddCC ($cc);
try {           
    $mail->isSMTP();                                           
    $mail->Host       = 'smtp.gmail.com';                     
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = 'demoeusl@gmail.com';                    
    $mail->Password   = 'taniyhwtbhtkozin';                             
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
    $mail->Port       = 465;       
  
    $mail->setFrom($adds, $setfromName);
    $mail->addAddress ($adds);
    //$mail->addAddress('hajeevans@esn.ac.lk');             
    $mail->isHTML(true);                                 
    //$mail->Subject = 'Here is the subject'.time();
	$mail->Subject = $subject;
   // $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
   include($emailHtmlcontent);
	 $mail->Body    = $aa;
    $mail->AltBody = $AltBody;

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}