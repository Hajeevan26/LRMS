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
// $_POST["res_id"];
// $_POST["f_id"];
$d_id=$_POST["dep_id"];
// $_POST["r_from"];
// $_POST["r_to"];
// $d_email;
$sqlview="SELECT d_email from tbl_department where d_id='$d_id'";
 $result=mysqli_query($con,$sqlview) or die("@error in view part:".mysqli_error($con));

//  while ($row=mysqli_fetch_array($result)) {
//     $mail->AddCC ($row['email']);
// }
$row=mysqli_fetch_array($result);
$mail->AddCC ($row['d_email']);
try {           
    $mail->isSMTP();                                           
    $mail->Host       = 'smtp.gmail.com';                     
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = 'demoeusl@gmail.com';                    
    $mail->Password   = 'taniyhwtbhtkozin';                             
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
    $mail->Port       = 465;       
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    
    $mail->setFrom($adds, 'Virtual Advanced Reservation System');
    $mail->addAddress ($emailto);
    //$mail->addAddress('hajeevans@esn.ac.lk');             
    $mail->isHTML(true);                                 
    //$mail->Subject = 'Here is the subject'.time();
	$mail->Subject = 'Your Reservation was successfully submited';
   // $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
   include('tbl.php');
	 $mail->Body    = $aa;
    $mail->AltBody = 'You will get confirmation when Admin accept your request';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}