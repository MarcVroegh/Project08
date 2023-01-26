<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . "/Project08/db/db.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/Project08/functions/functions.php");
$con = new dbh();
$fun = new Functions();
$array2 = $fun->SelectFromLoginLog($_SESSION["hekkensluiterGebruikersnaam"]);
$mysql_timestamp = $array2['thistime'];
if(strtotime($mysql_timestamp) > strtotime("-15 minutes")) {
  if (isset($_SESSION["hekkensluiter"])){
    $fun->InsertIntoLoginLog($_SESSION["hekkensluiterNaam"], $_SESSION["hekkensluiterAchternaam"], $_SESSION["hekkensluiterGebruikersnaam"]);
  }
  else{
    header("Refresh:0; url=/Project08/pages/login.php");
  }
}
else{
  header("Refresh:0; url=/Project08/pages/login.php");
}
?>
<!DOCTYPE html>
<html>
<title>Actiepaneel aanpassen</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/project08/css/style.css">
<body>

<div class="sidebar" style="width:80px">
<a href="./uitlog.php">
         <img alt="log out" src="/Project08/images/loginb.png"
         width="30" height="27" style="position: absolute; bottom: 130px; left: 25px;">
</a>
<a href="./aanpassen.php">
         <img alt="back" src="/Project08/images/goback.png"
         width="30" height="30" style="position: absolute; bottom: 70px; left: 25px;">
</a>
</div>

<div style="margin-left:80px">

<div class="container" style="height:100px">
  <h1>Snelle acties</h1>
</div>

<div style="margin-top:100px">

<div class="con">
<div class="align">
<h1>Aanpassen medewerker</h1>

<form action="/project08/pages/aanpassen3.php" method="post" enctype="multipart/form-data">
  <input type="text" name="naam" placeholder="Naam"><br>
  <input type="text" name="achternaam" placeholder="Achternaam"><br>
  <input type="text" name="functie" placeholder="Functie"><br>
  <input type="text" name="rolid" placeholder="rol_id"><br>
  <input type="text" name="gebruikersnaam" placeholder="Gebruikersnaam"><br>
  <input type="text" name="wachtwoord" placeholder="Wachtwoord"><br>
  <input type="submit" value="submit" name="submit1">
  <p><?php if(isset($_SESSION["status31"])) { echo $_SESSION["status31"]; unset($_SESSION["status31"]); } ?></p>
</form>
</div>
</div>

</body>
</html>

<?php
///gedtineerde
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once($_SERVER['DOCUMENT_ROOT'] . "/Project08/db/db.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/Project08/functions/functions.php");

$con = new dbh();
$fun = new Functions();


if (isset($_POST['submit1'])){
    $naam=isset($_POST['naam']) ? addslashes($_POST['naam']) : "";
    $achternaam=isset($_POST['achternaam']) ? addslashes($_POST['achternaam']) : "";
    $functie=isset($_POST['functie']) ? addslashes($_POST['functie']) : "";
    $rolid=isset($_POST['rolid']) ? addslashes($_POST['rolid']) : "";
    $gebruikersnaam=isset($_POST['gebruikersnaam']) ? addslashes($_POST['gebruikersnaam']) : "";
    $gebruikersnaam2=$_SESSION["bsn32"];
    $wachtwoord = isset($_POST['wachtwoord']) ? addslashes($_POST['wachtwoord']) : "";

    $wachtwoord2 = password_hash($wachtwoord, PASSWORD_DEFAULT);
    $c = $fun->UpdateGebruiker($naam, $achternaam, $functie, $rolid, $gebruikersnaam, $wachtwoord2, $gebruikersnaam2);

    if($c == 1) {
        $_SESSION["status32"] = "Gelukt";
        header("Refresh:0; url=aanpassen.php");
    }
    else{
        $_SESSION["status32"] = "Niet gelukt";
        header("Refresh:0; url=aanpassen.php");
    }
}

?>