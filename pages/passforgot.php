<?php
session_start();
?>
<!DOCTYPE html>
<html>
<title>Password reset</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/project08/css/style.css">
<body>

<div class="sidebar" style="width:80px">
<a href="/Project08/index.php">
         <img alt="back" src="/Project08/images/goback.png"
         width="30" height="30" style="position: absolute; bottom: 70px; left: 25px;"></a>
</div>

<div style="margin-left:80px">

<div class="container" style="height:100px">
  <h1>Snelle acties</h1>
</div>

<div style="margin-top:100px">

<div class="con">
<div class="align">
<br><br><br>
<h1>Wachtwoord vergeten?</h1>
<form action="passforgot.php" method="post" enctype="multipart/form-data">
  <input type="text" name="email" placeholder="Email adres"><br>
  <input type="submit" name="submit">
  <p><?php if(isset($_SESSION["status80"])) { echo $_SESSION["status80"]; unset($_SESSION["status80"]); } ?></p>
  <a href="./passrestore.php" style="color: white;">Wachtwoord herstel</a>
</form>
<br><br><br>
</div>
</div>


      
</body>
</html>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once($_SERVER['DOCUMENT_ROOT'] . "/Project08/db/db.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/Project08/functions/functions.php");

require $_SERVER['DOCUMENT_ROOT'] . '/Project08/phpmailer/src/Exception.php';
require $_SERVER['DOCUMENT_ROOT'] . '/Project08/phpmailer/src/PHPMailer.php';
require $_SERVER['DOCUMENT_ROOT'] . '/Project08/phpmailer/src/SMTP.php';

$con = new dbh();
$fun = new Functions();

if (isset($_POST['submit'])){
    $email=isset($_POST['email']) ? addslashes($_POST['email']) : "";
$check30 = $fun->CheckPasswordGebruikers($email);
if ($check30 == 1) {
$check20 = $fun->SelectFromGebruikers($email);
$gebruikersnaam = $check20['Gebruikersnaam'];

$randomcode = $fun->createRandomPassword();
$randomcodehash= password_hash($randomcode, PASSWORD_DEFAULT);

$check21 = $fun->UpdateIntoPasswordGebruikers($randomcodehash, $email);
if ($check21 = 1) {
    $mail=new PHPMailer();
    $mail->IsSMTP();    
    $mail->Port = 587;
    $mail->SMTPAuth = true;               
    
    $to = $email;
    $sbody = 'Your verification code: '. $randomcode. '<br> go to passrestore';
    $subject = 'Your verification code '. $gebruikersnaam;
    $from = 'hoornhek@gmail.com';
    
    
    $mail->Username=
    $mail->Password = 
    $mail->Host="smtp.mailtrap.io";
    $mail->SMTPSecure = 'tls';   
    $mail->From = $from;
    $mail->FromName = 'Hoornhek';
    $mail->AddAddress($to); 
    $mail->MsgHTML($sbody);
    $mail->isHTML(true);
    $mail->Body    = $sbody;
    $mail->Subject = $subject;
    if(!$mail->Send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
    exit;

    
    $mail->ClearAddresses();
    $mail->ClearAttachments();
}else{
    $_SESSION["status80"] = "Fout bij toevoegen, probeer opnieuw";
    header("Refresh:0; url=passforgot.php");
}
}else{
    $_SESSION["status80"] = "Geen email, wachtwoord herstel onmogelijk.";
    header("Refresh:0; url=passforgot.php");
}
}
?>
