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
<form action="passrestore.php" method="post" enctype="multipart/form-data">
  <h1>Wachtwoord herstel</h1>
  <input type="text" name="username" placeholder="Gebruikersnaam"><br>
  <input type="text" name="pass" placeholder="Voer je verificatie code in of oude wachtwoord"><br>
  <input type="text" name="newpass" placeholder="Nieuwe wachtwoord"><br>
  <input type="submit" name="submit">
  <p><?php if(isset($_SESSION["status110"])) { echo $_SESSION["status110"]; unset($_SESSION["status110"]); } ?></p>
</form>
</div>
</div>


      
</body>
</html>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
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

if (isset($_POST['submit'])) {
    $gebruikersnaam=isset($_POST['username']) ? addslashes($_POST['username']) : "";
    $oldpassorverificationcode=isset($_POST['pass']) ? addslashes($_POST['pass']) : "";
    $newpass=isset($_POST['newpass']) ? addslashes($_POST['newpass']) : "";
    $check90 = $fun->SelectFromGebruikers2($gebruikersnaam);
    $checken = $fun->SelectFromGebruikers3($gebruikersnaam);
    if ($checken['verificationhash'] != '') { 
        if (password_verify($oldpassorverificationcode, $check90['verificationhash'])) {
            $newpass2= password_hash($newpass, PASSWORD_DEFAULT);
            $check91 = $fun->UpdateGebruiker2($newpass2, $check90['Gebruikersnaam']);
            if ($check91 == 1) {
                $fun->UpdateIntoPasswordGebruikers('', $check90['email']);
                   $_SESSION["status110"] = "Succesvol wachtwoord gereset";
                   header("Refresh:0; url=passrestore.php");
                }else{
                    $_SESSION["status110"] = "Fout bij het resetten";
                    header("Refresh:0; url=passrestore.php");
                }
            }
    }else{
        $ch = $fun->SelectFromGebruiker($gebruikersnaam);
        if ($ch == 1) {
            $gh = $fun->SelectUserHash($gebruikersnaam);
            if (password_verify($oldpassorverificationcode, $gh['Wachtwoord'])) {
               $newpass2= password_hash($newpass, PASSWORD_DEFAULT);
               $fg = $fun->UpdateGebruiker2($newpass2, $gebruikersnaam);
               if ($fg == 1) {
                $_SESSION["status110"] = "Succesvol veranderd";
                header("Refresh:0; url=passrestore.php");
               }else{
                $_SESSION["status110"] = "Fout opgetreden bij het veranderen";
                header("Refresh:0; url=passrestore.php");
               }
            }
            else{
                $_SESSION["status110"] = "Oude wachtwoord is fout";
                header("Refresh:0; url=passrestore.php");
            }
        }else{
            $_SESSION["status110"] = "Er bestaat geen gebruiker met deze gebruikersnaam";
            header("Refresh:0; url=passrestore.php");
        }
    }
}
?>
