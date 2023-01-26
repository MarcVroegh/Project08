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
<title>Actiepaneel bezoekers</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/project08/css/style.css">
<body>

<div class="sidebar" style="width:80px">
<a href="./uitlog.php">
         <img alt="log out" src="/Project08/images/loginb.png"
         width="30" height="27" style="position: absolute; bottom: 130px; left: 25px;">
</a>
<a href="./HekkensluiterApplicatie.php">
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
<h1>Registratie bezoekers</h1>

<form action="/project07/pages/BezoekersPaneel.php" method="post" enctype="multipart/form-data">
  <input type="text" name="naam" placeholder="Naam"><br>
  <input type="text" name="achternaam" placeholder="Achternaam"><br>
  <input type="text" name="huisadres" placeholder="Huisadres"><br>
  <input type="text" name="woonplaats" placeholder="Woonplaats"><br>
  <input type="text" name="bsn" placeholder="BSN-nummer"><br><br><br>
  <input type="submit" value="submit" name="submit1">
  <p><?php if(isset($_SESSION["status10"])) { echo $_SESSION["status10"]; unset($_SESSION["status10"]); } ?></p>
</form>
</div>
</div>

<div class="con2">
<h1>Bezoek in/uit bezoekers</h1>

<form action="/project07/pages/BezoekersPaneel.php" method="post" enctype="multipart/form-data">
  <input type="text" name="bsn" placeholder="BSN-nummer"><br>
  <input type="date" name="datum"><br>
  <input type="text" name="tijdin" placeholder="Tijd in" onfocus="(this.type='time')"><br>
  <input type="text" name="tijduit" placeholder="Tijd uit" onfocus="(this.type='time')"><br>
  <input type="text" name="wie" placeholder="Wie bezocht? (BSN invullen graag)"><br><br><br>
  <input type="submit" value="submit" name="submit2">
  <p><?php if(isset($_SESSION["status11"])) { echo $_SESSION["status11"]; unset($_SESSION["status11"]); } ?></p>
</form>
</div>

   
</body>
</html>
<?php

if (isset($_POST['submit1'])){
    $naam=isset($_POST['naam']) ? addslashes($_POST['naam']) : "";
    $achternaam=isset($_POST['achternaam']) ? addslashes($_POST['achternaam']) : "";
    $huisadres=isset($_POST['huisadres']) ? addslashes($_POST['huisadres']) : "";
    $woonplaats=isset($_POST['woonplaats']) ? addslashes($_POST['woonplaats']) : "";
    $bsn=isset($_POST['bsn']) ? addslashes($_POST['bsn']) : "";
}

if (isset($_POST['submit1'])){
$check = $fun->CheckIfExistBezoekerPG($bsn);
if($check == 0) {
    $check2 = $fun->InsertIntoBezoekerPG($naam, $achternaam, $huisadres, $woonplaats, $bsn);
    if($check2 == 1) {
        $_SESSION["status10"] = "Bezoeker succesvol toegevoegd";
        header("Refresh:0; url=bezoeker.php");
    }
    else{
        $_SESSION["status10"] = "Er is een fout opgetreden bij het toevoegen van de bezoeker, probeer het later opnieuw";
        header("Refresh:0; url=bezoeker.php");
    }

}
else{
    $_SESSION["status10"] = "Er bestaat al een bezoeker met dit BSN-nummer";
    header("Refresh:0; url=bezoeker.php");
}
}
///
if (isset($_POST['submit2'])){
  $bsn=isset($_POST['bsn']) ? addslashes($_POST['bsn']) : "";
  $datum=isset($_POST['datum']) ? addslashes($_POST['datum']) : "";
  $tijdin=isset($_POST['tijdin']) ? addslashes($_POST['tijdin']) : "";
  $tijduit=isset($_POST['tijduit']) ? addslashes($_POST['tijduit']) : "";
  $wie=isset($_POST['wie']) ? addslashes($_POST['wie']) : "";
}
if (isset($_POST['submit2'])){
$check1 = $fun->CheckIfExistGedetineerde($wie);
$check = $fun->CheckIfExistBezoekerPG($bsn);
if($check == 1 && $check1 == 1) {
  $check2 = $fun->InsertIntoBezoekerGebouw($bsn, $datum, $tijdin, $tijduit, $wie);
  if($check2 == 1) {
      $_SESSION["status11"] = "Succesvol toegevoegd";
      header("Refresh:0; url=bezoeker.php");
  }
  else{
      $_SESSION["status11"] = "Fout bij toevoegen, probeer opnieuw";
      header("Refresh:0; url=bezoeker.php");
  }
}
else{
  $_SESSION["status11"] = "Deze bezoeker of gedetineerde is nog niet toegevoegd, dus kan er nog geen tijd voor ingevuld worden";
  header("Refresh:0; url=bezoeker.php");
}
}
?>