<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require './Exception.php';
require './PHPMailer.php';
require './SMTP.php';

$mail=new PHPMailer();
$mail->IsSMTP();    
$mail->Port = 587;
$mail->SMTPAuth = true;               

$to = 'vroeghmarc@gmail.com';
$sbody = 'test';
$subject = 'test';
$from = 'vroeghmarc@gmail.com';


$mail->Username="577590aa2ad61f";
$mail->Password = "a40fce0cc3e9ec";   //api key from sendgrid
$mail->Host="smtp.mailtrap.io";
$mail->SMTPSecure = 'tls';   
$mail->From = $from;
$mail->FromName = 'Marc';
$mail->AddAddress($to);  // Add a recipient
$mail->MsgHTML($sbody);
$mail->isHTML(true);
$mail->Body    = $sbody;
$mail->Subject = $subject;
if(!$mail->Send()) {
echo 'Message could not be sent.';
echo 'Mailer Error: ' . $mail->ErrorInfo;
exit;
}

$mail->ClearAddresses();
$mail->ClearAttachments();
?>