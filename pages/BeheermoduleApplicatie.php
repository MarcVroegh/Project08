<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . "/Project08/db/db.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/Project08/functions/functions.php");
$con = new dbh();
$fun = new Functions();
$result5 = $fun->SelectRechten5($_SESSION["hekkensluiterFunctie"]);
$result6 = $fun->SelectRechten6($_SESSION["hekkensluiterFunctie"]);
$result7 = $fun->SelectRechten7($_SESSION["hekkensluiterFunctie"]);
$result4 = $fun->SelectRechten4($_SESSION["hekkensluiterFunctie"]);
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

date_default_timezone_set("Europe/Amsterdam");
if (date('H') < 24) {
  $pre2pm = "Goedeavond";
}
if (date('H') < 17) {
  $pre2pm = "Goedemiddag";
}
if (date('H') < 12) {
  $pre2pm = "Goedemorgen";
}
if (date('H') < 7) {
  $pre2pm = "Goedenacht";
}
?>
<!DOCTYPE html>
<html>
<title>Beheermodule</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,300,400,700">
<link rel="stylesheet" href="/project08/css/style.css">
<body>

<div class="sidebar" style="width:80px">
<a href="./uitlog.php">
         <img alt="log out" src="/Project08/images/loginb.png"
         width="30" height="27" style="position: absolute; bottom: 130px; left: 25px;">
</a>
<a href="/Project08/index.php">
         <img alt="back" src="/Project08/images/goback.png"
         width="30" height="30" style="position: absolute; bottom: 70px; left: 25px;">
</a>
</div>

<div style="margin-left:80px">

<div class="container" style="height:100px">
  <h1>Beheermodule</h1>
</div>

<div style="margin-top:100px">

<div class="con">
    <h1><?php echo $pre2pm;?> <?php echo $_SESSION["hekkensluiterNaam"] ?>,</h1><br>
    <a href="./aanpassen.php"><input type="submit" id="button1" <?php if($result5['aanpassen'] == 0) { echo "value=' '";  }else{ echo "value='Aanpassen'"; }  ?>/></a>
    <a href="./aanmaken.php"><input type="submit" id="button2" <?php if($result6['aanmaken'] == 0) { echo "value=' '";  }else{ echo "value='Aanmaken'"; }  ?>/></a>
    <a href="./toewijzen.php"><input type="submit" id="button2" <?php if($result7['rechtentoewijzen'] == 0) { echo "value=' '";  }else{ echo "value='Rechten toewijzen'"; }  ?>/></a>
    <br>
    <a href="./Hekkensluiterinstellingen.php"><input type="submit" id="button2" <?php if($result4['instellingen'] == 0) { echo "value=' '";  }else{ echo "value='Instellingen'"; }  ?>/></a>
    <a href="./uitlog.php"><input type="submit" id="button1" value="Uitloggen"/></a>
    <a href="./HekkensluiterApplicatie.php"><input type="submit" id="button2" value="Hekkensluiter"/></a>
    <br><br>
</div>

      
</body>
</html>
