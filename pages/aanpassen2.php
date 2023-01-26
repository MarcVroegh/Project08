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
<h1>Aanpassen gedetineerde</h1>

<form action="/project08/pages/aanpassen2.php" method="post" enctype="multipart/form-data">
  <input type="text" name="naam" placeholder="Naam"><br>
  <input type="text" name="achternaam" placeholder="Achternaam"><br>
  <input type="text" name="huisadres" placeholder="Huisadres"><br>
  <input type="text" name="woonplaats" placeholder="Woonplaats"><br>
  <input type="text" name="zaaknummer" placeholder="Zaaknummer"><br>
  <input type="text" name="celnummer" placeholder="Celnummer"><br>
  <input type="text" name="datum" placeholder="Datum van arrestatie" onfocus="(this.type='date')"><br>
  <input type="text" name="datumuitbewaring" placeholder="Datum uit bewaring" onfocus="(this.type='date')"><br>
  <input type="text" name="redenhechtenis" placeholder="Reden van hechtenis"><br>
  <input type="text" name="aantekeningen" placeholder="Aantekeningen gedrag"><br>
  <input type="text" name="verslag" placeholder="Verslag"><br>
  <input type="text" name="bewijs" placeholder="Bewijs"><br>
  <input type="text" name="getuigen" placeholder="Getuigen"><br><br>
  <input type="file" name="file"><br><br><br>
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
    $huisadres=isset($_POST['huisadres']) ? addslashes($_POST['huisadres']) : "";
    $woonplaats=isset($_POST['woonplaats']) ? addslashes($_POST['woonplaats']) : "";
    $zaaknummer=isset($_POST['zaaknummer']) ? addslashes($_POST['zaaknummer']) : "";
    $bsn = $_SESSION['bsn30'];
    $celnummer=isset($_POST['celnummer']) ? addslashes($_POST['celnummer']) : "";
    $datum=isset($_POST['datum']) ? addslashes($_POST['datum']) : "";
    $datumuitbewaring=isset($_POST['datumuitbewaring']) ? addslashes($_POST['datumuitbewaring']) : "";
    $redenhechtenis =isset($_POST['redenhechtenis']) ? addslashes($_POST['redenhechtenis']) : "";
    $aant=isset($_POST['aantekeningen']) ? addslashes($_POST['aantekeningen']) : "";
    $verslag=isset($_POST['verslag']) ? addslashes($_POST['verslag']) : "";
    $bewijs=isset($_POST['bewijs']) ? addslashes($_POST['bewijs']) : "";
    $getuigen=isset($_POST['getuigen']) ? addslashes($_POST['getuigen']) : "";

    $g = $fun->UpdateIntoGedetineerdePG($naam, $achternaam, $huisadres, $woonplaats, $zaaknummer, $bsn, $celnummer, $datum, $datumuitbewaring, $redenhechtenis, $aant, $verslag, " ", $bewijs, $getuigen);

    if($g == 1) {
        $_SESSION["status30"] = "Gelukt";
        header("Refresh:0; url=aanpassen.php");
    }
    else{
        $_SESSION["status30"] = "Niet gelukt";
        header("Refresh:0; url=aanpassen.php");
    }
}

