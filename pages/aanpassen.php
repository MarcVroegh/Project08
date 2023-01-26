<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . "/Project08/db/db.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/Project08/functions/functions.php");
$con = new dbh();
$fun = new Functions();
$result = $fun->SelectRechten5($_SESSION["hekkensluiterFunctie"]);
if ($result['aanpassen'] == 1) {
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
}else{
  header("Refresh:0; url=/Project08/pages/BeheermoduleApplicatie.php");
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
<a href="./BeheermoduleApplicatie.php">
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
<h1>Aanpassen gedetineerde</h1>

<form action="/project08/pages/aanpassen.php" method="post" enctype="multipart/form-data">
  <input type="text" name="bsn" placeholder="BSN gedetineerde"><br>
  <input type="submit" value="submit" name="submit">
  <p><?php if(isset($_SESSION["status30"])) { echo $_SESSION["status30"]; unset($_SESSION["status30"]); } ?></p>
</form>
</div>
</div>
<div class="con2">
<h1>Aanpassen medewerker</h1>

<form action="/project08/pages/aanpassen.php" method="post" enctype="multipart/form-data">
  <input type="text" name="gebruiker" placeholder="Gebruikersnaam medewerker"><br>
  <input type="submit" value="submit" name="submit3">
  <p><?php if(isset($_SESSION["status32"])) { echo $_SESSION["status32"]; unset($_SESSION["status"]); } ?></p>
</form>
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


if (isset($_POST['submit'])){
    $bsn=isset($_POST['bsn']) ? addslashes($_POST['bsn']) : "";
   
}
if (isset($_POST['submit'])){
$check = $fun->CheckIfExistGedetineerde($bsn);
if($check == 1) {
    header("Refresh:0; url=aanpassen2.php");
}
else{
    $_SESSION["status30"] = "Gedetineerde bestaat niet";
    $_SESSION["bsn30"] = $bsn;
    header("Refresh:0; url=aanpassen.php");
}
}

///gebruiker
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once($_SERVER['DOCUMENT_ROOT'] . "/Project08/db/db.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/Project08/functions/functions.php");

$con = new dbh();
$fun = new Functions();


if (isset($_POST['submit3'])){
    $gebruiker=isset($_POST['gebruiker']) ? addslashes($_POST['gebruiker']) : "";
   
}
if (isset($_POST['submit3'])){
$check20 = $fun->SelectFromGebruiker($gebruiker);
if($check20 == 1) {
    header("Refresh:0; url=aanpassen3.php");
    $_SESSION["bsn32"] = $gebruiker;
}
else{
    $_SESSION["status32"] = "Medewerker bestaat niet";
    header("Refresh:0; url=aanpassen.php");
}
}
?>